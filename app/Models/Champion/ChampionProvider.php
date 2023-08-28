<?php

namespace App\Models\Champion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChampionProvider extends Model
{
    protected $fillable = [
        'champion_id',
        'provider_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function champion(): BelongsTo
    {
        return $this->belongsTo(User::class, 'champion_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(MilkBagTransaction::class, 'owner_id', 'id');
    }
}
