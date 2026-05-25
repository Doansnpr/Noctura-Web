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

    // ── Relasi ke User ────────────────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ── Scope: filter by authenticated user ───────────────────────────────────
    public function scopeForUser($query, string $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ── Accessor: cek apakah solusi sudah di-cache ────────────────────────────
    public function hasSolution(): bool
    {
        return !empty($this->solution);
    }
}