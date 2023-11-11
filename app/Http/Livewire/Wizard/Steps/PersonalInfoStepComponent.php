<?php

namespace App\Http\Livewire\Wizard\Steps;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Spatie\LivewireWizard\Components\StepComponent;
use WireUi\Traits\Actions;

class PersonalInfoStepComponent extends StepComponent
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
        'date_of_birth' => 'required|date|before:-16 years',
        'phone_number' => ['required', 'string', 'max:255'],
    ];

    protected $messages = [
        'date_of_birth.before' => 'Must 16+ years older',
    ];

    public function save(): void
    {
        Auth::user()->update($this->validate());

        $this->notification()->success(
            'Update saved',
            'Your personal info was successfully saved'
        );

        $this->nextStep();
    }

    public function render(): View
    {
        return view('livewire.complete-registration-wizard.personal-info-step');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Personal Information',
            'icon' => 'information-circle',
            'description' => 'More information about you',
        ];
    }
}
