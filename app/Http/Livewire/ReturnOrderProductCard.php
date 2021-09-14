<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReturnOrderProductCard extends Component
{
    public $orderproduct;
    public $checkbox;
    public $visible = false;

    public function mount($orderproduct)
    {
        $this->orderproduct = $orderproduct;
    }

    public function updatedCheckbox($value)
    {
        if ($value) {
            $this->visible = true;
        } else {
            $this->visible = false;
        }
    }

    public function render()
    {
        return view('livewire.return-order-product-card');
    }
}
