<?php
namespace Database\Seeders;

use App\Models\Jawaban;
use Illuminate\Database\Seeder;

class JawabanSeeder extends Seeder
{
    public function run(): void
    {
        Jawaban::truncate();

        $data = [
            ['pertanyaan_id' => 1, 'tipe' => 'select', 'opsi' => ['Male', 'Female']],
            ['pertanyaan_id' => 3, 'tipe' => 'select', 'opsi' => ['Doctor','Engineer','Teacher','Nurse','Accountant','Lawyer','Sales Representative','Scientist','Software Engineer','Manager']],
            ['pertanyaan_id' => 8, 'tipe' => 'select', 'opsi' => ['Underweight', 'Normal Weight', 'Overweight', 'Obese']],
            ['pertanyaan_id' => 2, 'tipe' => 'range', 'range_min' => 18,  'range_max' => 90,    'unit' => 'tahun',      'label' => 'Usia Dewasa'],
            ['pertanyaan_id' => 4, 'tipe' => 'range', 'range_min' => 1,   'range_max' => 12,    'unit' => 'jam',        'label' => 'Durasi Tidur'],
            ['pertanyaan_id' => 5, 'tipe' => 'range', 'range_min' => 1,   'range_max' => 10,    'unit' => '',           'label' => 'Skala Kualitas'],
            ['pertanyaan_id' => 6, 'tipe' => 'range', 'range_min' => 0,   'range_max' => 120,   'unit' => 'menit/hari', 'label' => 'Aktivitas Fisik'],
            ['pertanyaan_id' => 7, 'tipe' => 'range', 'range_min' => 1,   'range_max' => 10,    'unit' => '',           'label' => 'Skala Stres'],
            ['pertanyaan_id' => 9, 'tipe' => 'range', 'range_min' => 0,   'range_max' => 25000, 'unit' => 'langkah',    'label' => 'Langkah Harian'],
        ];

        foreach ($data as $item) {
            Jawaban::create($item);
        }

        $this->command->info('JawabanSeeder: ' . count($data) . ' jawaban berhasil di-seed.');
    }
}