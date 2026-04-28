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
        'title',
        'category',
        'summary',
        'content',
        'image_url',
        'author',
        'tags',
        'read_time',
        'is_published'
    ];

    // Mengonversi _id menjadi id (string) secara otomatis di JSON
    protected $appends = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        // 'tags' sengaja dikosongkan karena MongoDB sudah menyimpannya sebagai array
    ];
}
