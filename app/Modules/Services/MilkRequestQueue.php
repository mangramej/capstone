<?php

namespace App\Modules\Services;

use App\Models\Requester\MilkRequest;
use App\Models\User;

class MilkRequestQueue
{
    public function __construct(
        public readonly User $user,
    ) {
    }

    //    public function getCurrentRequestToProccess(): MilkRequest
    //    {
    //
    //    }
    //
    //    public function getEarliestMilkRequestAccepted: ?MilkRequest
    //    {
    //
    //    }
}
