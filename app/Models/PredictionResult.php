<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredictionResult extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'prediction_results';

    protected $fillable = [
        'user_id',
        'prediction',
        'label',
        'confidence',
        'description',
        'suggestions',
        'input_data',
        'solution',
        'predicted_at',
    ];

    protected $casts = [
        'confidence'   => 'array',
        'suggestions'  => 'array',
        'input_data'   => 'array',
        'solution'     => 'array',
        'predicted_at' => 'datetime',
    ];
    protected $dates = ['created_at', 'predicted_at', 'updated_at'];        
}