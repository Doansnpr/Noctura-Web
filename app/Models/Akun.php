<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Jika Official MongoDB Laravel v4+
// use Jenssegers\Mongodb\Eloquent\Model; // Uncomment ini jika pakai Jenssegers

class Akun extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'akun';
    protected $table = 'akun'; // sesuai nama collection di MongoDB kamu

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'profile',
    ];

    protected $hidden = ['password'];

    // Mapping field MongoDB ke format tampilan
    public function getRoleDisplayAttribute(): string
    {
        return $this->role === 'admin' ? 'Admin' : 'Pengguna';
    }
}