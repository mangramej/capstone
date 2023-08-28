<?php

namespace App\Models\Requester;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MilkRequest extends Model
{
    protected $fillable = [
        'requester_id',
        'mother_name',
        'baby_name',
        'quantity',
        'address',
        'phone_number',
        'image',
        'comment',
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

    public function getImageUrl(): string
    {
        return '/attachments/user-'.auth()->id().'/'.$this->image;

        //        return Storage::disk('attachments')->url("/user-$this->id/$this->image");
    }

    protected static function booted(): void
    {
        static::created(function (MilkRequest $milkRequest) {
            $prefix = strtoupper($milkRequest->mother_name[0].$milkRequest->baby_name[0]);
            $date = $milkRequest->created_at->format('mdy');
            $id = $milkRequest->id;

            $milkRequest->ref_number = $prefix . $date . $id;

            $milkRequest->save();
        });
    }
}
