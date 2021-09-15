<?php

namespace App\Http\Livewire\Admin;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PincodeForm extends Component
{
    public $states = [];
    public $cities = [];
    public $selectedState;
    public $selectedCity;
    public $state;
    public $city;
    public $pincode;
    public $validPincode = false;
    public $deliveryCharge;

    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'X-CSCAPI-KEY' => env('CITY_STATE_API_ACCESS_KEY')
            ])->accept('application/json')->get('https://api.countrystatecity.in/v1/countries/IN/states', [
                'method' => 'GET',
                'redirect' => 'follow'
            ]);
            if ($response->failed()) {
                request()->session()->flash('state', 'Failed to fetch data. Try Again.');
                return redirect(url()->current());
            }
            $this->states = $response->collect();
        } catch (Exception $e) {
            request()->session()->flash('state', 'Failed to fetch data. Try Again.');
        }
    }

    public function updatedSelectedState($value)
    {
        if ($value == "-1") {
            $this->syncInput('selectedState', null);
        }
        $this->resetPincode();
        $this->resetCities();
    }

    public function updatedSelectedCity($value)
    {
        if ($value == "-1") {
            $this->syncInput('selectedCity', null);
        }
        $this->resetPincode();
    }

    public function resetCities()
    {
        try {
            if ($this->selectedState) {
                $state = $this->states->where('name', $this->selectedState)->first();
                if ($state) {
                    $response = Http::withHeaders([
                        'X-CSCAPI-KEY' => env('CITY_STATE_API_ACCESS_KEY')
                    ])->accept('application/json')->get('https://api.countrystatecity.in/v1/countries/IN/states/' . $state['iso2'] . '/cities', [
                        'method' => 'GET',
                        'redirect' => 'follow'
                    ]);
                    if ($response->failed()) {
                        request()->session()->flash('city', 'Failed to fetch data. Try Again.');
                        return redirect(url()->current());
                    }
                    $this->cities = $response->collect();
                } else {
                    $this->cities = null;
                }
            } else {
                $this->cities = null;
            }
            $this->selectedCity = null;
        } catch (Exception $e) {
            request()->session()->flash('city', 'Failed to fetch data. Try Again.');
        }
    }

    public function resetPincode()
    {
        $this->pincode = null;
        $this->validPincode = false;
    }

    public function updatedPincode()
    {
        if (!validatePincode($this->pincode)) {
            $this->validPincode = false;
            session()->remove('success');
            session()->flash('error', 'Invalid Pincode');
            return;
        }
        session()->remove('error');
        session()->flash('success', 'Valid Pincode');
        $this->validPincode = true;
    }

    public function render()
    {
        return view('livewire.admin.pincode-form');
    }
}



/* 

collect([
                'id' => '1',
                'name' => 'Andhrapradesh'
            ]),
            collect([
                'id' => '2',
                'name' => 'Himachalpraesh'
            ]),
            collect([
                'id' => '3',
                'name' => 'Jharkhand'
            ]),
            collect([
                'id' => '4',
                'name' => 'Karnataka'
            ]),
            collect([
                'id' => '5',
                'name' => 'Madhyapradesh'
            ]),
            collect([
                'id' => '6',
                'name' => 'Maharashtra'
            ]),
            collect([
                'id' => '7',
                'name' => 'Uttarpradesh'
            ]),

*/
