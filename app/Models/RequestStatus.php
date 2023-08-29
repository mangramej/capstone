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
        'pending_at' => 'datetime',
        'accepted_at' => 'datetime',
        'assigned_at' => 'datetime',
        'delivered_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];
}
