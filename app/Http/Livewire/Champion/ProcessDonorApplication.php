<?php

namespace App\Http\Livewire\Champion;

use App\Models\ProviderApplication;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class ProcessDonorApplication extends Component
{
    use WithFileUploads, Actions;

    public $application;

    public $name;

    public $file;

    public function mount(ProviderApplication $application)
    {
        $this->application = $application;
        $this->application->load('user');
    }

    public function uploadAttachment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:5000',
        ], [
            'file.required' => 'Attach at least one file.',
            'file.max' => 'The files must not exceed 5MB',
        ]);

        $this->application->attachments()->create([
            'name' => $this->name,
            'file_path' => $this->file->store('/user-'.$this->application->user->id, 'attachments'),
        ]);

        $this->notification()->success(
            title: 'Updated',
            description: 'File uploaded successfully'
        );

        $this->emit('refreshComponent');
        $this->reset('name', 'file');
        $this->dispatchBrowserEvent('pondReset');
    }

    public function downloadAttachment($file_id)
    {
        $file = $this->application->attachments()->where('id', $file_id)->first(['name', 'file_path']);

        $file_name = $this->application->application_id.'-'.str($file->name)->slug().'.'.pathinfo($file->file_path, PATHINFO_EXTENSION);

        return response()->download(
            storage_path('app/attachments/'.$file->file_path),
            $file_name
        );
    }

    public function render(): View
    {
        $this->application->load('attachments');

        return view('livewire.champion.process-donor-application');
    }
}
