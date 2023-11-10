<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;

class ShowMilkRequestController extends Controller
{
    public function pending()
    {
        $milk_request_pending_count = MilkRequest::where('status', MilkRequestStatus::Pending)
            ->count();

        $milk_request_recent_count = MilkRequest::where('status', '!=', MilkRequestStatus::Pending)
            ->count();

        return view('champion.milk-requests.pending', compact('milk_request_pending_count', 'milk_request_recent_count'));
    }

    public function recent()
    {
        $milk_request_pending_count = MilkRequest::where('status', MilkRequestStatus::Pending)
            ->count();

        $milk_request_recent_count = MilkRequest::where('status', '!=', MilkRequestStatus::Pending)
            ->count();

        return view('champion.milk-requests.recent', compact('milk_request_pending_count', 'milk_request_recent_count'));
    }
}
