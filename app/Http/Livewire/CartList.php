<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Varient;
use Livewire\Component;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class CartList extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];
    public $items = [];

    public function mount()
    {
        $this->cartItems = \Cart::session(Auth::id())->getContent()->toArray();
        $userID = Auth::id();
        foreach ($this->cartItems as $key => $item) {
            $product = Product::find($item['associatedModel']['id']);
            $varient = $product->varients->find($item['attributes']['varient']['id']);

            if ($product && $varient) {
                \Cart::session($userID)->update($item['id'], [
                    'name' => $product->name,
                    'price' => $varient->sellingPrice,
                    'attributes' => array(
                        'varient' => $varient
                    ),
                    'associatedModel' => $product,
                ]);
            } else {
                \Cart::session($userID)->remove($item['id']);
            }
            $this->cartItems = \Cart::session(Auth::id())->getContent()->toArray();
        }

        // foreach ($this->cartItems as $key => $value) {
        //     $this->items['$key'] = Product::firstWhere('id', $value['id']);
        // }
    }

    public function removeCart($id)
    {
        \Cart::session(Auth::id())->remove($id);
        session()->flash('success', 'Item has removed successfully!');
        $this->redirect(route('carts.index'));
    }

    public function clearAllCart()
    {
        \Cart::session(Auth::id())->clear();
        session()->flash('success', 'Cart Cleared Successfully !');
    }

    public function render()
    {
        //$this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.cart-list');
    }
}
