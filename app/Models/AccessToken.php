<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class AccessToken extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tokens';

    protected $fillable = [
        'user_id',
        'token',
        'created_at',
    ];
}