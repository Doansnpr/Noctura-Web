<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Edukasi extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'edukasi';
    protected $table = 'edukasi';
    protected $primaryKey = '_id';

    protected $fillable = [
        'judul_artikel',
        'kategori_gangguan_tidur',
        'jenis_edukasi',
        'ringkasan',
        'isi_artikel',
        'gambar_artikel',
        'tips_penanganan',
        'saran_konsultasi',
        'penulis',
        'estimasi_waktu_baca',
        'status_publish',
    ];

    protected $casts = [
        'status_publish' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
