<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreScreening extends Model
{
    protected $fillable = [
        'provider_id', 'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }
}
