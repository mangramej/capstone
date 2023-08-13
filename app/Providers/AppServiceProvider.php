<?php

namespace App\Providers;

use App\Http\Livewire\Wizard\CompleteRegistrationWizardComponent;
use App\Http\Livewire\Wizard\Steps\AddressStepComponent;
use App\Http\Livewire\Wizard\Steps\PersonalInfoStepComponent;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('complete-registration-wizard', CompleteRegistrationWizardComponent::class);
        Livewire::component('personal-info-step', PersonalInfoStepComponent::class);
        Livewire::component('address-step', AddressStepComponent::class);
    }
}
