<?php

namespace App\Policies;

use App\Models\Requester\MilkRequest;
use App\Models\User;
use App\Modules\Enums\UserEnum;

class MilkRequestPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MilkRequest $milkRequest): bool
    {
        return match ($user->type) {
            UserEnum::Requester => $milkRequest->requester_id === $user->id,
            UserEnum::Champion => $milkRequest->accepted_by === $user->id,
            UserEnum::Provider => false,
        };
    }

    /**
     * Determine whether the user can create models.
     */
//    public function create(User $user): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can update the model.
     */
//    public function update(User $user, MilkRequest $milkRequest): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the model.
     */
//    public function delete(User $user, MilkRequest $milkRequest): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can restore the model.
     */
//    public function restore(User $user, MilkRequest $milkRequest): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can permanently delete the model.
     */
//    public function forceDelete(User $user, MilkRequest $milkRequest): bool
//    {
//        //
//    }
}
