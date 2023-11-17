<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class UploadBirthCertificate extends Component
{
    use Actions, WithFileUploads;

    public $birth_certificate;

    public function upload()
    {
        $this->validate(['birth_certificate' => 'required|image|max:5000']);

        Auth::user()->requesterVerification()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'birth_cert_path' => $this->birth_certificate->store('/user-'.Auth::id(), 'attachments'),
            ]
        );

        $this->notification()->success('Uploaded');
        $this->emitUp('UpdateForm');
    }

    public function render(): View
    {
        return view('livewire.requester.upload-birth-certificate');
    }
}
