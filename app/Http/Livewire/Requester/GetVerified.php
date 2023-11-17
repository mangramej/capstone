<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class GetVerified extends Component
{
    use Actions, WithFileUploads;

    protected $listeners = ['UpdateForm' => '$refresh'];

    public function render(): View
    {
        return view('livewire.requester.get-verified');
    }
}
