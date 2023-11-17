<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderApplicationAttachment extends Model
{
    protected $fillable = [
        'provider_application_id', 'file_path', 'name',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(ProviderApplication::class);
    }
}
