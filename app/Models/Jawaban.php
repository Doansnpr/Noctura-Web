<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Jawaban extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jawaban';

    protected $fillable = [
        'pertanyaan_id',
        'tipe',
        'opsi',
        'range_min',
        'range_max',
        'unit',
        'label',
    ];

    protected $casts = [
        'pertanyaan_id' => 'integer',
        'range_min'     => 'float',
        'range_max'     => 'float',
        'opsi'          => 'array',
    ];
}