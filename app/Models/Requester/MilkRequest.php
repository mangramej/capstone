<?php

namespace App\Models\Requester;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilkRequest extends Model
{
    protected $fillable = [
        'requester_id',
        'mother_name',
        'baby_name',
        'quantity',
        'address',
        'phone_number',
//        'image_id',
        'comment'
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function champion(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provided_by');
    }
}
