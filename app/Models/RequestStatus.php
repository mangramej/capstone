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
}
