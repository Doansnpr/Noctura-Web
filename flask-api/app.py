from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import numpy as np

app = Flask(__name__)
CORS(app)

# Load model & encoders
model     = joblib.load('model/noctura_xgboost.pkl')
le_target = joblib.load('model/noctura_le_target.pkl')
le_gender = joblib.load('model/noctura_le_gender.pkl')
le_occ    = joblib.load('model/noctura_le_occupation.pkl')
le_bmi    = joblib.load('model/noctura_le_bmi.pkl')

# ← FIX: hardcode mapping karena le_target menyimpan integer (0,1,2)
LABEL_MAP = {0: 'Healthy', 1: 'Insomnia', 2: 'Sleep Apnea'}

print('✅ Noctura XGBoost Model loaded!')
print(f'   Gender classes    : {le_gender.classes_.tolist()}')
print(f'   Occupation classes: {le_occ.classes_.tolist()}')
print(f'   BMI classes       : {le_bmi.classes_.tolist()}')

# ============================================
# ROUTES
# ============================================

@app.route('/', methods=['GET'])
def index():
    return jsonify({
        'app'    : 'Noctura API',
        'model'  : 'XGBoost',
        'status' : 'running',
        'version': '1.0.0'
    })

@app.route('/health', methods=['GET'])
def health():
    return jsonify({'status': 'ok', 'model': 'XGBoost'})

@app.route('/options', methods=['GET'])
def options():
    return jsonify({
        'genders'       : le_gender.classes_.tolist(),
        'occupations'   : le_occ.classes_.tolist(),
        'bmi_categories': le_bmi.classes_.tolist(),
    })

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json(force=True)

        if not data:
            return jsonify({
                'status' : 'error',
                'message': 'Request body kosong atau bukan JSON'
            }), 400

        # ── Validasi field wajib ──────────────────────────────────────
        required = [
            'gender', 'age', 'occupation', 'sleep_duration',
            'quality_of_sleep', 'physical_activity_level',
            'stress_level', 'bmi_category', 'heart_rate',
            'daily_steps', 'systolic', 'diastolic'
        ]
        missing = [f for f in required if f not in data]
        if missing:
            return jsonify({
                'status' : 'error',
                'message': f'Field tidak ditemukan: {missing}'
            }), 400

        # ── Encode kategorikal ────────────────────────────────────────
        try:
            gender_enc = int(le_gender.transform([str(data['gender'])])[0])
        except ValueError:
            return jsonify({
                'status' : 'error',
                'message': f"Gender '{data['gender']}' tidak dikenali. Pilihan: {le_gender.classes_.tolist()}"
            }), 400

        try:
            occ_enc = int(le_occ.transform([str(data['occupation'])])[0])
        except ValueError:
            return jsonify({
                'status' : 'error',
                'message': f"Occupation '{data['occupation']}' tidak dikenali. Pilihan: {le_occ.classes_.tolist()}"
            }), 400

        try:
            bmi_enc = int(le_bmi.transform([str(data['bmi_category'])])[0])
        except ValueError:
            return jsonify({
                'status' : 'error',
                'message': f"BMI Category '{data['bmi_category']}' tidak dikenali. Pilihan: {le_bmi.classes_.tolist()}"
            }), 400

        # ── Susun fitur sesuai urutan training ───────────────────────
        features = np.array([[
            gender_enc,
            int(data['age']),
            occ_enc,
            float(data['sleep_duration']),
            int(data['quality_of_sleep']),
            int(data['physical_activity_level']),
            int(data['stress_level']),
            bmi_enc,
            int(data['heart_rate']),
            int(data['daily_steps']),
            int(data['systolic']),
            int(data['diastolic']),
        ]], dtype=float)

        # ── Prediksi ─────────────────────────────────────────────────
        prediction = int(model.predict(features)[0])
        proba      = model.predict_proba(features)[0]
        label      = LABEL_MAP[prediction]  # ← FIX: pakai LABEL_MAP

        return jsonify({
            'status'    : 'success',
            'prediction': label,
            'confidence': {
                LABEL_MAP[i]: round(float(p), 4)
                for i, p in enumerate(proba)
            }
        })

    except ValueError as e:
        return jsonify({
            'status' : 'error',
            'message': f'Nilai input tidak valid: {str(e)}'
        }), 400
    except Exception as e:
        return jsonify({
            'status' : 'error',
            'message': str(e)
        }), 500

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=8000)
