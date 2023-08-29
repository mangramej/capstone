<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclinedRequest extends Model
{
    protected $fillable = [
        'declined_by',
        'milk_request_id',
    ];
}
