<?php

namespace App\Modules\Enums;

enum MilkRequestStatus: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Declined = 'declined';
    case Assigned = 'assigned';
    case Delivered = 'delivered';
    case Confirmed = 'confirmed';
}
