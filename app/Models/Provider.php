<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'provider_id', 'status', 'eligibility', 'total_milk_bags',
    ];
}
