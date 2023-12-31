<?php

namespace App\Models;

use App\Models\Requester\MilkRequest;
use App\Modules\Castables\PersonalInfo;
use App\Modules\Enums\UserEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\HasAddress;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasAddress, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',

        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone_number',

        'street',
        'barangay_id',
        'city_id',
        'province_id',
        'region_id',
        'zip_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type' => UserEnum::class,
        'personal_info' => PersonalInfo::class,
        'date_of_birth' => 'datetime',
    ];

    public function isAccountFullyRegistered(): bool
    {
        return $this->personal_info->hasFilled() &&
            (
                ! is_null($this->street) &&
                ! is_null($this->region_id) &&
                ! is_null($this->province_id) &&
                ! is_null($this->city_id) &&
                ! is_null($this->barangay_id) &&
                ! is_null($this->zip_code)
            );
    }

    public function fullname(): string
    {
        return sprintf('%s %s',
            $this->first_name,
            $this->last_name
        );
    }

    public function address(): string
    {
        return sprintf('%s, %s, %s, %s, %s',
            $this->street,
            $this->barangay->name,
            $this->city->name,
            $this->province->name,
            $this->zip_code
        );
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(config('address.model.barangay', Barangay::class), 'barangay_id', 'id')->withDefault();
    }

    public function modelHasRole(): MorphOne
    {
        return $this->morphOne('App\Models\ModelHasRole', 'model');
    }

    public function preScreening()
    {
        return $this->hasOne(PreScreening::class, 'provider_id', 'id');
    }

    public function donorApplication(): HasOne
    {
        return $this->hasOne(ProviderApplication::class, 'provider_id');
    }

    public function requesterVerification(): HasOne
    {
        return $this->hasOne(RequesterVerification::class);
    }

    public function isVerifiedRequester(): bool
    {
        return $this->requesterVerification && $this->requesterVerification->status;
    }

    public function hasPendingMilkRequest()
    {
        return $this->milkRequests()
            ->where('requester_id', $this->id)
            ->whereNotIn('status', ['confirmed', 'declined'])
            ->exists();
    }

    public function milkRequests(): HasMany
    {
        return $this->hasMany(MilkRequest::class, 'requester_id');
    }
}
