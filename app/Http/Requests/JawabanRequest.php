<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JawabanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $base = [
            'pertanyaan_id' => 'required|integer',
            'tipe'          => 'required|in:select,range',
        ];

        if ($this->input('tipe') === 'select') {
            $base['opsi'] = 'required|array|min:1';
            $base['opsi.*'] = 'required|string|max:255';
        }

        if ($this->input('tipe') === 'range') {
            $base['range_min'] = 'required|numeric';
            $base['range_max'] = 'required|numeric|gte:range_min';
            $base['unit']      = 'nullable|string|max:50';
            $base['label']     = 'nullable|string|max:100';
        }

        return $base;
    }

    public function messages(): array
    {
        return [
            'pertanyaan_id.required' => 'Pertanyaan wajib dipilih.',
            'tipe.required'          => 'Tipe jawaban wajib diisi.',
            'tipe.in'                => 'Tipe harus select atau range.',
            'opsi.required'          => 'Opsi jawaban wajib diisi.',
            'opsi.min'               => 'Minimal satu opsi jawaban.',
            'range_min.required'     => 'Nilai minimum wajib diisi.',
            'range_max.required'     => 'Nilai maksimum wajib diisi.',
            'range_max.gte'          => 'Nilai maksimum harus >= nilai minimum.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => 'Validasi gagal.',
            'errors'  => $validator->errors(),
        ], 422));
    }
}