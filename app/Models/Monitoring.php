<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Monitoring extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'prediction_results';
    protected $primaryKey = '_id';

    protected $fillable = [
        'user_id',
        'prediction',
        'label',
        'confidence',
        'description',
        'suggestions',
        'input_data',
        'predicted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
