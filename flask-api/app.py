from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import numpy as np

app = Flask(__name__)
CORS(app)

# Load model saja
model = joblib.load('model/noctura_xgboost.pkl')

# Hardcode mapping — urutan HARUS sama persis dengan saat training
GENDER_MAP     = {'Female': 0, 'Male': 1}
OCCUPATION_MAP = {
    'Accountant': 0, 'Doctor': 1, 'Engineer': 2,
    'Lawyer': 3, 'Manager': 4, 'Nurse': 5,
    'Sales Representative': 6, 'Salesperson': 7,
    'Scientist': 8, 'Software Engineer': 9, 'Teacher': 10,
}
BMI_MAP = {
    'Normal': 0, 'Normal Weight': 1,
    'Obese': 2, 'Overweight': 3,
}
LABEL_MAP = {0: 'Healthy', 1: 'Insomnia', 2: 'Sleep Apnea'}

print('✅ Noctura XGBoost Model loaded!')

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
        'genders'       : list(GENDER_MAP.keys()),
        'occupations'   : list(OCCUPATION_MAP.keys()),
        'bmi_categories': list(BMI_MAP.keys()),
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

        gender = str(data['gender'])
        if gender not in GENDER_MAP:
            return jsonify({
                'status' : 'error',
                'message': f"Gender '{gender}' tidak dikenali. Pilihan: {list(GENDER_MAP.keys())}"
            }), 400

        occ = str(data['occupation'])
        if occ not in OCCUPATION_MAP:
            return jsonify({
                'status' : 'error',
                'message': f"Occupation '{occ}' tidak dikenali. Pilihan: {list(OCCUPATION_MAP.keys())}"
            }), 400

        bmi = str(data['bmi_category'])
        if bmi not in BMI_MAP:
            return jsonify({
                'status' : 'error',
                'message': f"BMI Category '{bmi}' tidak dikenali. Pilihan: {list(BMI_MAP.keys())}"
            }), 400

        features = np.array([[
            GENDER_MAP[gender],
            int(data['age']),
            OCCUPATION_MAP[occ],
            float(data['sleep_duration']),
            int(data['quality_of_sleep']),
            int(data['physical_activity_level']),
            int(data['stress_level']),
            BMI_MAP[bmi],
            int(data['heart_rate']),
            int(data['daily_steps']),
            int(data['systolic']),
            int(data['diastolic']),
        ]], dtype=float)

        prediction = int(model.predict(features)[0])
        proba      = model.predict_proba(features)[0]
        label      = LABEL_MAP[prediction]

        return jsonify({
            'status'    : 'success',
            'prediction': label,
            'confidence': {
                LABEL_MAP[i]: round(float(p), 4)
                for i, p in enumerate(proba)
            }
        })

    except ValueError as e:
        return jsonify({'status': 'error', 'message': f'Nilai input tidak valid: {str(e)}'}), 400
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)