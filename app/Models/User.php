<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Modules\Castables\PersonalInfo;
use App\Modules\Enums\UserEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\HasAddress;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasAddress;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        return sprintf('%s %s %s',
            $this->first_name,
            $this->middle_name ?? '',
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
}
