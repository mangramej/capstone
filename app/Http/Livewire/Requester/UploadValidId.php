<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class UploadValidId extends Component
{
    use Actions, WithFileUploads;

    public $type;

    public $image;

    public function upload()
    {
        $this->validate([
            'type' => 'required|string',
            'image' => 'required|image|max:5000',
        ]);

        Auth::user()->requesterVerification()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'id_type' => $this->type,
                'id_path' => $this->image->store('/user-'.Auth::id(), 'attachments'),
            ]
        );

        $this->notification()->success('Uploaded');
        $this->emitUp('UpdateForm');
    }

    public function render(): View
    {
        return view('livewire.requester.upload-valid-id');
    }
}
