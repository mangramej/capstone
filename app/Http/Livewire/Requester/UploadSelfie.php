<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class UploadSelfie extends Component
{
    use WithFileUploads, Actions;

    public $selfie;

    public function upload()
    {
        $this->validate(['selfie' => 'required|image|max:5000']);

        Auth::user()->requesterVerification()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'selfie_path' => $this->selfie->store('/user-'.Auth::id(), 'attachments'),
            ]
        );

        $this->notification()->success('Uploaded');
        $this->emitUp('UpdateForm');
    }

    public function render(): View
    {
        return view('livewire.requester.upload-selfie');
    }
}
