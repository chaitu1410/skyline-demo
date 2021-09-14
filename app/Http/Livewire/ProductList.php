<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;

class ProductList extends Component
{
    public $query;
    public $sort = "";

    public $category = "";
    public $subcategory = "";
    public $brand = "";
    public $min = "";
    public $max = "";

    public $categories;
    public $subcategories;
    public $brands;

    public function mount($query)
    {
        $this->query = $query;
        $this->categories = Category::select('id', 'name')->get();
        $this->subcategories = Subcategory::select('id', 'name')->get();
        $this->brands = Brand::select('id', 'name')->get();
    }

    public function removeFilters()
    {
        $this->category = "";
        $this->subcategory = "";
        $this->brand = "";
        $this->min = "";
        $this->max = "";
        $this->sort = "";
    }

    use WithPagination;
    public function render()
    {
        $products = Product::query();

        $products->where('name', 'like', '%'.$this->query.'%');

        if($this->sort === "LATEST"){
            $products->orderBy('created_at', 'DESC');
        }elseif($this->sort === "ASC" || $this->sort === "DESC"){
            $products->orderBy('sellingPrice', $this->sort);
        }

        if($this->category){
            $products->where('category_id', '=', $this->category);
        }

        if($this->subcategory){
            $products->where('subcategory_id', '=', $this->subcategory);
        }

        if($this->brand){
            $products->where('brand_id', '=', $this->brand);
        }

        if($this->min && $this->max && is_numeric($this->min) && is_numeric($this->max) && $this->min < $this->max){
            $products->whereBetween('sellingPrice', [$this->min, $this->max]);
        }

        $data['products'] = $products->paginate(15);

        return view('livewire.product-list', $data);
    }
}
