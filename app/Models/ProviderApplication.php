<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderApplication extends Model
{
    protected $fillable = [
        'provider_id', 'pre_screening_id', 'application_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }

    public function preScreening(): BelongsTo
    {
        return $this->belongsTo(PreScreening::class);
    }

    protected static function booted(): void
    {
        static::creating(function (ProviderApplication $application) {
            $application->application_id = bin2hex(random_bytes(5));
        });
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isDeclined(): bool
    {
        return $this->status === 'declined';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ProviderApplicationAttachment::class);
    }
}
