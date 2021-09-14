<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class BestSellerCategory extends Component
{
    public $category;
    public $categories;
    public $products;

    public function mount()
    {
        $this->categories = Category::where('bestSeller', 1)->take(10)->get();
        $this->category = $this->categories->first();
        //$this->products = $this->category->products;
    }

    public function setCategory($id)
    {
        $this->category = $this->categories->find($id);
        //$this->products = $this->category->products;
    }

    public function render()
    {
        return view('livewire.best-seller-category');
    }
}
