<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Subcategory;

class CategoriesController extends Controller
{

    /**
     *  Show all Categories
     */
    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $categories = Category::query();
        $categories->where('name', 'like', '%' . $query . '%');

        $data['categories'] = $categories->paginate(16);
        return view('admin.categories.index', $data);
    }

    /**
     *  Show Category
     */
    public function show(Request $request, Category $category)
    {
        try {
            $data['category'] = $category;
            $data['subcategories'] = $category->subcategories;
            $data['subcategory'] = null;
            return view('admin.categories.show', $data);
        } catch (Exception $e) {
            $request->session()->flash('error', 'Unable to fetch data!');
            return back();
        }
    }

    public function showSubcategory(Request $request, Category $category, Subcategory $subcategory)
    {
        try {
            $data['category'] = $category;
            $subcategories = $category->subcategories;

            // if ($request->get('subcategory')) {
            //     $data['subcategory'] = $subcategories->find($request->get('subcategory'));
            // } else {
            //     $data['subcategory'] = $subcategories->first();
            // }

            $data['subcategory'] = $subcategory;
            $data['subcategories'] = $subcategories;
            return view('admin.categories.show', $data);
        } catch (Exception $e) {
            $request->session()->flash('error', 'Unable to fetch data!');
            return back();
        }
    }



    /**
     *  Store Category
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $slug = slug($request->get('name'));
            $imageName = $slug . '.' . $request->file('image')->extension();
            Category::create([
                'name' => $request->get('name'),
                'slug' => $slug,
                'image' => $imageName,
                'bestSeller' => $request->get('bestSeller') ? true : false,
            ]);
            $request->file('image')->move(public_path('images'), $imageName);
            $request->session()->flash('success', 'Category added successfully!');
        } catch (Exception $ex) {
            $request->session()->flash('error', 'Failed to add category');
        }
        return back();
    }

    /**
     *  Update Category
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        try {
            $slug = slug($request->get('name'));
            $imageName = $category->image;
            if ($request->file('image')) {
                deleteImage($category->image);
                $imageName = $slug . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('images'), $imageName);
            }

            Category::where('id', $category->id)->update([
                'name' => $request->get('name'),
                'slug' => $slug,
                'image' => $imageName,
                'bestSeller' => $request->get('bestSeller') ? true : false,
            ]);
            $request->session()->flash('success', 'Category updated successfully!');
        } catch (Exception $ex) {
            $request->session()->flash('error', 'Failed to edit category');
        }
        return back();
    }

    /**
     *  Delete Category
     */
    public function destroy(Request $request, Category $category)
    {
        try {
            deleteImage($category->image);
            $category->delete();
            $request->session()->flash('success', 'Category deleted successfully!');
        } catch (Exception $ex) {
            $request->session()->flash('error', 'Failed to delete category');
        }
        return back();
    }
}
