<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PincodeForm extends Component
{
    public $states;
    public $cities;
    public $selectedState;
    public $selectedCity;
    public $pincode;
    public $validPincode = false;
    public $deliveryCharge;

    public function mount()
    {
        $this->states = collect([
            [
                'id' => '1',
                'name' => 'Andhrapradesh'
            ],
            [
                'id' => '2',
                'name' => 'Himachalpraesh'
            ],
            [
                'id' => '3',
                'name' => 'Jharkhand'
            ],
            [
                'id' => '4',
                'name' => 'Karnataka'
            ],
            [
                'id' => '5',
                'name' => 'Madhyapradesh'
            ],
            [
                'id' => '6',
                'name' => 'Maharashtra'
            ],
            [
                'id' => '7',
                'name' => 'Uttarpradesh'
            ],
        ]);
    }

    public function updatedSelectedState($value)
    {
        $this->resetCities();
        if ($value == "-1") {
            $this->syncInput('selectedState', null);
        }

        $this->cities = collect([
            [
                'id' => '1',
                'name' => 'Mumbai'
            ],
            [
                'id' => '2',
                'name' => 'Pune'
            ],
            [
                'id' => '3',
                'name' => 'Delhi'
            ],
            [
                'id' => '4',
                'name' => 'Benglore'
            ],
            [
                'id' => '5',
                'name' => 'Hydrabad'
            ],
            [
                'id' => '6',
                'name' => 'Chennai'
            ],
            [
                'id' => '7',
                'name' => 'Aurangabad'
            ],
        ]);
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
        $this->cities = null;
        $this->selectedCity = null;
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
