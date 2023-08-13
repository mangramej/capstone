<?php

namespace App\Http\Livewire\Wizard;

use App\Http\Livewire\Wizard\Steps\AddressStepComponent;
use App\Http\Livewire\Wizard\Steps\PersonalInfoStepComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\LivewireWizard\Components\WizardComponent;

class CompleteRegistrationWizardComponent extends WizardComponent
{
    private User $user;

    public function mount(): void
    {
        $this->user = Auth::user();
    }

    public function steps(): array
    {
        return [
            PersonalInfoStepComponent::class,
            AddressStepComponent::class,
        ];
    }

    public function initialState(): ?array
    {
        return [
            'personal-info-step' => $this->user->personal_info->toArray(),
        ];
    }
}
