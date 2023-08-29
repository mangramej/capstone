<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Thread extends Model
{
    use HasEagerLimit;

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latest()->limit(1);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function isParticipant(int $id): bool
    {
        return $this->participants()->where('user_id', $id)->exists();
    }
}
