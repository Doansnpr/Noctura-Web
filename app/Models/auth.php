<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Auth extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'akun';
    protected $primaryKey = '_id';
    protected $table = 'akun';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'profile',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'profile' => 'array',
    ];

    public function getCollection()  // ← tambah ini
    {
        return $this->collection;
    }

    public function getAuthIdentifierName()
{
    return '_id';
}
}