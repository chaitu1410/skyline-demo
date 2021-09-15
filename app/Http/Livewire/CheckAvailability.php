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
            $pincode = Pincode::where('pincode', $this->pincode)->first();
            if ($pincode) {
                $msg = 'Delivery available for this pincode! Delivery charge: ₹';
                if ($pincode->freeDeliveryLimit) {
                    $msg =  $msg . $pincode->deliveryCharge . ' and free delivery for orders over ₹' . $pincode->freeDeliveryLimit;
                } else {
                    $msg =  $msg . $pincode->deliveryCharge . ' and This pincode is not eligible for free delivery';
                }
                session()->flash('success', $msg);
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
