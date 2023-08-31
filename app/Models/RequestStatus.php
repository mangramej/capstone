<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestStatus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'milk_request_id',
        'pending_at',
        'accepted_at',
        'assigned_at',
        'delivered_at',
        'confirmed_at',
    ];

    protected $casts = [
        'pending_at' => 'datetime:M/d/Y, h:i A',
        'accepted_at' => 'datetime:M/d/Y, h:i A',
        'assigned_at' => 'datetime:M/d/Y, h:i A',
        'delivered_at' => 'datetime:M/d/Y, h:i A',
        'confirmed_at' => 'datetime:M/d/Y, h:i A',
    ];
}
