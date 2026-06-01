<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class SleepLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sleep_logs';
    protected $primaryKey = '_id';

    protected $fillable = [
        'user_id',
        'tanggal',         
        'jam_tidur',     
        'jam_bangun',    
        'durasi',     
        'kualitas',      
        'notes',        
    ];

    protected $casts = [
        'kualitas'  => 'integer',
        'durasi' => 'integer',
    ];
}