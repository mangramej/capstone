<?php

namespace App\Modules\Enums;

enum UserEnum: string
{
    case Champion = 'champion';
    case Requester = 'requester';
    case Provider = 'provider';
}
