<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelHasRole extends Model
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(config('permission.models.role'));
    }
}
