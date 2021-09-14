<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class EditPincodeForm extends Component
{

    public $id;
    public $pincode;

    public function mount($aPincode)
    {
        $this->selectedState = $aPincode->state;
        $this->selectedCity = $aPincode->city;
        $this->pincode = $aPincode->pincode;
    }

    public function render()
    {
        return view('livewire.admin.edit-pincode-form');
    }
}

/* 

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

*/