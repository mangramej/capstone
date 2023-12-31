<?php

namespace App\Models\Requester;

use App\Models\DeclinedRequest;
use App\Models\RequestStatus;
use App\Models\User;
use App\Modules\Enums\MilkRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class MilkRequest extends Model
{
    protected $attributes = [
        'status' => MilkRequestStatus::Pending,
    ];

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

    protected $casts = [
        'status' => MilkRequestStatus::class,
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
        return '/attachments/user-'.$this->requester_id.'/'.$this->image;

        //        return Storage::disk('attachments')->url("/user-$this->id/$this->image");
    }

    public function declines(): HasOne
    {
        return $this->hasOne(DeclinedRequest::class);
    }

    public function statuses(): HasOne
    {
        return $this->hasOne(RequestStatus::class);
    }

    protected static function booted(): void
    {
        static::created(function (MilkRequest $milkRequest) {
            //            $prefix = strtoupper($milkRequest->mother_name[0]);
            //            $prefix = Str::random(6);
            //            $date = $milkRequest->created_at->format('mdy');
            //            $id = $milkRequest->id;

            $milkRequest->ref_number = strtoupper(Str::random(9));

            $milkRequest->save();

            $milkRequest->statuses()->create([
                'pending_at' => $milkRequest->created_at,
            ]);
        });
    }
}
