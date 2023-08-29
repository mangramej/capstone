<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class UpdatePersonalInformation extends Component
{
    use Actions;

    public ?string $first_name = '';

    public ?string $middle_name = '';

    public ?string $last_name = '';

    public ?string $date_of_birth = '';

    public ?string $phone_number = '';

    protected $rules = [
        'first_name' => ['required', 'string', 'min:2', 'max:255'],
        'middle_name' => ['nullable', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'min:2', 'max:255'],
        'date_of_birth' => ['required', 'date'],
        'phone_number' => ['required', 'string', 'max:255'],
    ];

    public function mount(): void
    {
        $this->first_name = Auth::user()->first_name;
        $this->middle_name = Auth::user()->middle_name;
        $this->last_name = Auth::user()->last_name;
        $this->date_of_birth = Auth::user()->date_of_birth;
        $this->phone_number = Auth::user()->phone_number;
    }

    public function save(): void
    {
        Auth::user()->update($this->validate());

        $this->notification()->success(
            'Update saved',
            'Your personal info was successfully updated'
        );
    }

    public function render()
    {
        return view('livewire.profile.update-personal-information');
    }
}
