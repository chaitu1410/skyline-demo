<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartUpdate extends Component
{

    public $cartItems = [];
    public $quantity = 1;

    public function mount($item)
    {
        $this->cartItems = $item;
        $this->quantity = $item['quantity'];
    }

    public function updateCart()
    {
        \Cart::session(Auth::id())->update($this->cartItems['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);

        $this->emit('cartUpdated');
    }

    public function increase()
    {
        $this->quantity++;
        $this->updateCart();
    }

    public function decrease()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->updateCart();
        }
    }

    public function render()
    {
        return view('livewire.cart-update');
    }
}
