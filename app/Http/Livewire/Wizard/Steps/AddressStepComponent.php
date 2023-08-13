<?php

namespace App\Http\Livewire\Wizard\Steps;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Spatie\LivewireWizard\Components\StepComponent;
use WireUi\Traits\Actions;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\Region;

class AddressStepComponent extends StepComponent
{
    use Actions;

    public $street;

    public $regions;

    public $provinces;

    public $cities;

    public $barangays;

    public $zip_code;

    public $selectedRegion = null;

    public $selectedProvince = null;

    public $selectedCity = null;

    public $selectedBarangay = null;

    protected $rules = [
        'street' => ['required', 'string', 'max:255'],
        'selectedRegion' => ['required', 'string'],
        'selectedProvince' => ['required', 'string'],
        'selectedCity' => ['required', 'string'],
        'selectedBarangay' => ['required'],
        'zip_code' => ['required', 'string'],
    ];

    protected $messages = [
        'selectedRegion.required' => 'Choose at least one region.',
        'selectedProvince.required' => 'Choose at least one province.',
        'selectedCity.required' => 'Choose at least one city.',
        'selectedBarangay.required' => 'Choose at least one barangay.',
        'zip_code' => 'The Zip Code cannot be empty.',
    ];

    public function mount(): void
    {
        $this->regions = Region::all();
        $this->provinces = collect();
        $this->cities = collect();
        $this->barangays = collect();
    }

    public function updatedSelectedRegion($region): void
    {
        $this->provinces = Province::where('region_id', $region)->get();
        $this->selectedProvince = null;
        $this->selectedCity = null;
        $this->selectedBarangay = null;
    }

    public function updatedSelectedProvince($province): void
    {
        $this->cities = City::where('province_id', $province)->get();
        $this->selectedCity = null;
        $this->selectedBarangay = null;
    }

    public function updatedSelectedCity($city): void
    {
        $this->barangays = Barangay::where('city_id', $city)->get();
        $this->selectedBarangay = null;
    }

    public function save()
    {
        $this->validate();

        Auth::user()->update([
            'street' => $this->street,
            'region_id' => $this->selectedRegion,
            'province_id' => $this->selectedProvince,
            'city_id' => $this->selectedCity,
            'barangay_id' => $this->selectedBarangay,
            'zip_code' => $this->zip_code,
        ]);

        $this->notification()->success(
            'Update saved',
            'Your personal info was successfully saved'
        );

        return to_route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.complete-registration-wizard.address-step');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Address Location',
            'icon' => 'globe',
            'description' => 'Place where you currently live.',
        ];
    }
}
