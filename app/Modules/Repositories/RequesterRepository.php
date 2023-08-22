<?php

namespace App\Modules\Repositories;

use App\Models\Requester\MilkRequest;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Support\Facades\Auth;

class RequesterRepository
{
    private User $user;

    public function __construct(int $id = null)
    {
        $this->user = ($id)
            ? User::where('type', UserEnum::Requester)->findOrFail($id)
            : Auth::user();
    }

    public function newMilkRequest(
        string $motherName,
        string $babyName,
        int $quantity,
        string $address,
        string $phoneNumber,
        //        string $image,
        string $comment = null
    ): MilkRequest {
        return MilkRequest::create([
            'requester_id' => $this->user->id,
            'mother_name' => $motherName,
            'baby_name' => $babyName,
            'quantity' => $quantity,
            'address' => $address,
            'phone_number' => $phoneNumber,
            //            'image' => $image,
            'comment' => $comment,
        ]);
    }
}
