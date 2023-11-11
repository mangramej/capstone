<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderApplication extends Model
{
    protected $fillable = [
        'provider_id', 'pre_screening_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }

    public function preScreening(): BelongsTo
    {
        return $this->belongsTo(PreScreening::class);
    }
}
