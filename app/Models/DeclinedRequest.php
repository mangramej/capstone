<?php

namespace App\Models;

use App\Http\Livewire\Champion\Report\MilkRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeclinedRequest extends Model
{
    protected $fillable = [
        'declined_by',
        'milk_request_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    public function milkRequest(): BelongsTo
    {
        return $this->belongsTo(MilkRequest::class, 'milk_request_id');
    }
}
