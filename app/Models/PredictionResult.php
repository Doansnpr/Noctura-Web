<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class PredictionResult extends Model
{
    // Nama collection di MongoDB
    protected $connection = 'mongodb';
    protected $collection = 'prediction_results';

    protected $fillable = [
        'user_id',      
        'prediction',   
        'label',         
        'confidence',    
        'predicted_at',  
    ];

    protected $casts = [
        'confidence'   => 'array',
        'predicted_at' => 'datetime',
    ];
}