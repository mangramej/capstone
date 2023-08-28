<?php

namespace App\Models\Champion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkBagTransaction extends Model
{
    protected $fillable = [
        'owner_id',
        'type',
        'quantity',
        'milk_request_ref_number',
    ];
}
