<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Varient;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class AddVarient extends Component
{
    public $categoryId;
    public $productId;

    public $category;
    public $product = null;

    public $categories = [];
    public $products = [];

    public $baseVarient;
    public $varients = [];
    public $baseProperties = [];

    public $subcategoryDisabled = true;
    public $productDisabled = true;
    public $showContent = false;

    public function mount()
    {
        $this->categories = Category::select('id', 'name')->get();
    }

    public function updatedCategoryId($value)
    {
        $this->resetProduct();

        $this->category = Category::where('id', $this->categoryId)->first();
        if (!($this->category)) {
            $this->resetProduct();
            return;
        }
        $this->products = $this->category->products;
        $this->productDisabled = false;
    }

    public function updatedSubcategoryId($value)
    {
    }

    // private function resetSubcategory()
    // {
    //     $this->subcategoryId = null;
    //     $this->subcategoryDisabled = true;
    //     $this->subcategories = [];
    // }

    private function resetProduct()
    {
        $this->productId = null;
        $this->productDisabled = true;
        $this->showContent = false;
        $this->products = [];
        $this->baseVarient = null;
        $this->varients = [];
        $this->baseProperties = [];
    }

    public function updatedProductId($value)
    {
        $this->product = Product::where('id', $this->productId)->first();
        if (!($this->product)) {
            $this->showContent = false;
            return;
        }
        $this->varients = $this->product->varients;
        $this->baseVarient = $this->varients->where('name', '=', 'base')->first();
        $this->baseProperties = $this->baseVarient->properties;
        $this->showContent = true;
    }

    public function deleteVarient($id)
    {
        Varient::where('id', $id)->delete();
        request()->session()->flash('success', 'Varient deleted successfully!');
        return redirect(route('admin.products.addVarient'));
    }

    public function render()
    {
        return view('livewire.admin.add-varient');
    }
}
