<?php

namespace App\Http\Livewire;

use App\Models\Pincode;
use Livewire\Component;

class CheckAvailability extends Component
{
    public $pincode;

    public function check()
    {
        if (validatePincode($this->pincode)) {
            if (Pincode::where('pincode', $this->pincode)->exists()) {
                session()->flash('success', 'Delivery available for this pincode!!!');
            } else {
                session()->flash('error', 'Delivery not available for this pincode');
            }
        } else {
            session()->flash('error', 'Enter valid pincode');
        }
    }

    public function render()
    {
        return view('livewire.check-availability');
    }
}
