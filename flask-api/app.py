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

print('✅ Noctura XGBoost Model loaded!')

@app.route('/', methods=['GET'])
def index():
    return jsonify({
        'app'    : 'Noctura API',
        'model'  : 'XGBoost',
        'status' : 'running',
        'version': '1.0.0'
    })

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json()

        # Validasi field wajib
        required = ['gender', 'age', 'occupation', 'sleep_duration',
                    'quality_of_sleep', 'physical_activity_level',
                    'stress_level', 'bmi_category', 'heart_rate',
                    'daily_steps', 'systolic', 'diastolic']

        missing = [f for f in required if f not in data]
        if missing:
            return jsonify({
                'status' : 'error',
                'message': f'Field tidak ditemukan: {missing}'
            }), 400

        # Encode kategorikal
        gender_enc = le_gender.transform([data['gender']])[0]
        occ_enc    = le_occ.transform([data['occupation']])[0]
        bmi_enc    = le_bmi.transform([data['bmi_category']])[0]

        # Susun fitur sesuai urutan training
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
        ]])

        prediction = model.predict(features)[0]
        proba      = model.predict_proba(features)[0]
        label      = le_target.inverse_transform([int(prediction)])[0]

        return jsonify({
            'status'    : 'success',
            'prediction': label,
            'confidence': {
                cls: round(float(prob), 4)
                for cls, prob in zip(le_target.classes_, proba)
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

@app.route('/options', methods=['GET'])
def options():
    return jsonify({
        'genders'        : le_gender.classes_.tolist(),
        'occupations'    : le_occ.classes_.tolist(),
        'bmi_categories' : le_bmi.classes_.tolist(),
    })

@app.route('/health', methods=['GET'])
def health():
    return jsonify({'status': 'ok', 'model': 'XGBoost'})

if __name__ == '__main__':
    app.run(debug=True, port=5000)