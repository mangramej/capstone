<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class UploadMedicalRecord extends Component
{
    use Actions, WithFileUploads;

    public $medical_record;

    public function upload()
    {
        $this->validate(['medical_record' => 'required|file|max:5000']);

        Auth::user()->requesterVerification()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'medical_record_path' => $this->medical_record->store('/user-'.Auth::id(), 'attachments'),
            ]
        );

        $this->notification()->success('Uploaded');
        $this->emitUp('UpdateForm');
    }

    public function render(): View
    {
        return view('livewire.requester.upload-medical-record');
    }
}
