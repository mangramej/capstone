<?php

namespace App\Models\Champion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilkBagTransaction extends Model
{
    protected $fillable = [
        'owner_id',
        'type',
        'quantity',
        'milk_request_ref_number',
    ];

    public function milkBag(): BelongsTo
    {
        return $this->belongsTo(ChampionProvider::class, 'owner_id', 'provider_id');
    }
}
