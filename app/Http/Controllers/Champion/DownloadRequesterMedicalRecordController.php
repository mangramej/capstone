<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\RequesterVerification;
use Illuminate\Support\Facades\Storage;

class DownloadRequesterMedicalRecordController extends Controller
{
    public function __invoke(RequesterVerification $requesterVerification)
    {
        $requesterVerification->load('user');

        $ext = pathinfo($requesterVerification->medical_record_path, PATHINFO_EXTENSION);

        $filename = str($requesterVerification->user->fullname())->slug().'-medical-record.'.$ext;

//        return Storage::disk('attachments')
//            ->download($requesterVerification->medical_record_path, $filename);
//
        return response()->download(storage_path('app/attachments/'. $requesterVerification->medical_record_path), $filename);

    }
}
