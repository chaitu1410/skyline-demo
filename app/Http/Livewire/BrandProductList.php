<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;

class BrandProductList extends Component
{
    public $query;
    public $sort = "";

    public $brand;
    public $category = "";
    public $subcategory = "";
    public $min = "";
    public $max = "";

    public $categories;
    public $subcategories;

    public function mount($query, $brand)
    {
        $this->query = $query;
        $this->brand = $brand;
        $this->categories = Category::select('id', 'name')->get();
        $this->subcategories = Subcategory::select('id', 'name')->get();
    }

    public function removeFilters()
    {
        $this->category = "";
        $this->subcategory = "";
        $this->min = "";
        $this->max = "";
        $this->sort = "";
    }

    use WithPagination;
    public function render()
    {
        $products = Product::query();

        $products->where('name', 'like', '%' . $this->query . '%');
        $products->where('brand_id', '=', $this->brand);

        if ($this->sort === "LATEST") {
            $products->orderBy('created_at', 'DESC');
        } elseif ($this->sort === "ASC" || $this->sort === "DESC") {
            $products->orderBy('sellingPrice', $this->sort);
        }

        if ($this->category) {
            $products->where('category_id', '=', $this->category);
        }

        if ($this->subcategory) {
            $products->where('subcategory_id', '=', $this->subcategory);
        }


        if ($this->min && $this->max && is_numeric($this->min) && is_numeric($this->max) && $this->min < $this->max) {
            $products->whereBetween('sellingPrice', [$this->min, $this->max]);
        }

        $data['products'] = $products->paginate(15);
        return view('livewire.brand-product-list', $data);
    }
}
