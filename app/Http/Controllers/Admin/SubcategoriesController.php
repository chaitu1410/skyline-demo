<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoriesController extends Controller
{
    public function store(Request $request, Category $category)
    {
        if ($request->has('subcategory') && $request->get('subcategory') !== "") {
            $category->subcategories()->create([
                'name' => $request->get('subcategory')
            ]);
            $request->session()->flash('success', 'Subcategory added to ' . $category->name . ' category!');
        } else {
            $request->session()->flash('error', 'Please enter subcategory name');
        }
        return back();
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        if ($request->has('subcategory') && $request->get('subcategory') !== "") {
            $subcategory->update([
                'name' => $request->get('subcategory')
            ]);
            $request->session()->flash('success', 'Subcategory updated successfully!');
        } else {
            $request->session()->flash('error', 'Please enter subcategory name');
        }
        return back();
    }

    public function destroy(Request $request, Category $category, Subcategory $subcategory)
    {
        $subcategory->delete();
        $request->session()->flash('success', 'Subcategory deleted successfully!');
        return redirect(route('admin.categories.show', ['category' => $category->id]));
    }
}
