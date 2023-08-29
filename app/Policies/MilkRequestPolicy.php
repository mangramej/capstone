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
        if ($user->type === UserEnum::Requester) {
            return $milkRequest->requester_id === $user->id;
        }

        if ($user->type === UserEnum::Champion) {
            $isDecline = $milkRequest->whereHas('declines', function ($query) use ($user, $milkRequest) {
                $query->where('milk_request_id', $milkRequest->id);
                $query->where('declined_by', $user->id);
            })->exists();

            if (is_null($milkRequest->accepted_by) && ! $isDecline) {
                return true;
            }

            return $milkRequest->accepted_by === $user->id;
        }

        return false;
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
    public function update(User $user, MilkRequest $milkRequest): bool
    {
        return ($user->type === UserEnum::Champion) && ($user->id === $milkRequest->accepted_by);
    }

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
