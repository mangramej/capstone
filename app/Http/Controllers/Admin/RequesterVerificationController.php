<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequesterVerification;
use App\Notifications\RequesterVerifiedNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequesterVerificationController extends Controller
{
    public function index(): View
    {
        $applications = RequesterVerification::with('user', 'user.requesterVerification')
            ->paginate();

        return view('admin.requester-verification.index', compact('applications'));
    }

    public function show(RequesterVerification $requesterVerification)
    {
        $requesterVerification->load('user');

        return view('admin.requester-verification.show', compact('requesterVerification'));
    }

    public function download(RequesterVerification $requesterVerification)
    {
        $requesterVerification->load('user');

        $ext = pathinfo($requesterVerification->medical_record_path, PATHINFO_EXTENSION);

        $filename = str($requesterVerification->user->fullname())->slug().'-medical-record.'.$ext;

        return Storage::disk('attachments')
            ->download($requesterVerification->medical_record_path, $filename);
    }

    public function update(Request $request, RequesterVerification $requesterVerification)
    {
        $request->validate(['status' => 'required|boolean']);

        if ($request->status) {
            if (! $requesterVerification->status) {
                $requesterVerification->status = true;
                $requesterVerification->verified_at = now();

                if (! $requesterVerification->user->unreadNotifications()->where('data->type', 'verified')->exists()) {
                    $requesterVerification->user->notify(
                        new RequesterVerifiedNotification('Try refreshing the page and start requesting by clicking the blue plus icon at the right side')
                    );
                }
            }
        } else {
            $requesterVerification->status = false;
            $requesterVerification->verified_at = null;
        }

        $requesterVerification->save();

        return to_route('admin.requester-verification.index');
    }
}
