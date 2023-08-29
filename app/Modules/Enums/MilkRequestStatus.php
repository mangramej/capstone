<?php

namespace App\Modules\Enums;

enum MilkRequestStatus: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Assigned = 'assigned';
    case Delivered = 'delivered';
    case Confirmed = 'confirmed';
}
