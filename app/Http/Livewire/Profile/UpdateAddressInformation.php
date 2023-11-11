<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\Region;

class UpdateAddressInformation extends Component
{
    use Actions;

    public $street;

    public $regions;

    //    public $provinces;

    public $cities;

    public $barangays;

    public $zip_code;

    public $selectedRegion = null;

    //    public $selectedProvince = null;

    public $selectedCity = null;

    public $selectedBarangay = null;

    protected $rules = [
        'street' => ['required', 'string', 'max:255'],
        'selectedRegion' => ['required', 'string'],
        //        'selectedProvince' => ['required', 'string'],
        'selectedCity' => ['required', 'string'],
        'selectedBarangay' => ['required'],
        'zip_code' => ['required', 'string'],
    ];

    protected $messages = [
        'selectedRegion.required' => 'Choose at least one region.',
        //        'selectedProvince.required' => 'Choose at least one province.',
        'selectedCity.required' => 'Choose at least one city.',
        'selectedBarangay.required' => 'Choose at least one barangay.',
        'zip_code' => 'The Zip Code cannot be empty.',
    ];

    public function mount(): void
    {
        $this->regions = Region::all();
        //        $this->provinces = collect();
        $this->cities = collect();
        $this->barangays = collect();
    }

    public function updatedSelectedRegion($region): void
    {
        //        $this->provinces = Province::where('region_id', $region)->get();
        //        $this->selectedProvince = null;
        $this->cities = City::where('region_id', $region)->get();
        $this->selectedCity = null;
        $this->selectedBarangay = null;
    }

    //    public function updatedSelectedProvince($province): void
    //    {
    //        $this->cities = City::where('province_id', $province)->get();
    //        $this->selectedCity = null;
    //        $this->selectedBarangay = null;
    //    }

    public function updatedSelectedCity($city): void
    {
        $this->barangays = Barangay::where('city_id', $city)->get();
        $this->selectedBarangay = null;
    }

    public function save(): void
    {
        $this->validate();

        $brgy = Barangay::where('id', $this->selectedBarangay)->first('province_id');

        Auth::user()->update([
            'street' => $this->street,
            'region_id' => $this->selectedRegion,
            'province_id' => $brgy->province_id,
            'city_id' => $this->selectedCity,
            'barangay_id' => $this->selectedBarangay,
            'zip_code' => $this->zip_code,
        ]);

        $this->notification()->success(
            'Profile Update',
            'Your address info was successfully updated'
        );

        $this->dispatchBrowserEvent('close');
    }

    public function render(): View
    {
        return view('livewire.profile.update-address-information');
    }
}
