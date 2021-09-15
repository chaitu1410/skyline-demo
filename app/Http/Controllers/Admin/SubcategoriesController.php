<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SubcategoriesController extends Controller
{
    public function store(Request $request, Category $category)
    {
        try {
            if ($request->has('subcategory') && $request->get('subcategory') !== "") {
                $category->subcategories()->create([
                    'name' => $request->get('subcategory')
                ]);
                $request->session()->flash('success', 'Subcategory added to ' . $category->name . ' category!');
            } else {
                $request->session()->flash('error', 'Please enter subcategory name');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to store subcategory');
        }
        return back();
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        try {
            if ($request->has('subcategory') && $request->get('subcategory') !== "") {
                $subcategory->update([
                    'name' => $request->get('subcategory')
                ]);
                $request->session()->flash('success', 'Subcategory updated successfully!');
            } else {
                $request->session()->flash('error', 'Please enter subcategory name');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to update subcategory');
        }
        return back();
    }

    public function destroy(Request $request, Category $category, Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
            $request->session()->flash('success', 'Subcategory deleted successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to delete subcategory');
        }
        return redirect(route('admin.categories.show', ['category' => $category->id]));
    }
}
