<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Requester\MilkRequest;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Support\Facades\Auth;

class ShowRequesterRequestHistoryController extends Controller
{
    public function __invoke(User $user)
    {
        abort_unless($user->type === UserEnum::Requester, 404);

        $milkRequests = MilkRequest::query()
            ->select(['id', 'ref_number', 'accepted_by', 'quantity', 'status', 'created_at', 'requester_id'])
            ->where('requester_id', $user->id)
            ->where('accepted_by', Auth::id())
            ->latest()
            ->paginate();

        $requestCount = MilkRequest::query()
            ->select(['id', 'accepted_by', 'requester_id'])
            ->where('requester_id', $user->id)
            ->where('accepted_by', Auth::id())
            ->count();

        return view('champion.requester-history', compact('user', 'milkRequests', 'requestCount'));
    }
}
