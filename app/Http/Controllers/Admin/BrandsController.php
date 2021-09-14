<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditBrandRequest;
use App\Http\Requests\StoreBrandRequest;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $brands = Brand::query();
        $brands->where('name', 'like', '%' . $query . '%');
        $data['brands'] = $brands->paginate(15);

        return view('admin.brands.index', $data);
    }

    public function store(StoreBrandRequest $request)
    {
        try {
            $slug = slug($request->get('name'));
            $imageName = $slug . '.' . $request->file('image')->extension();
            Brand::create([
                'name' => $request->get('name'),
                'slug' => $slug,
                'image' => $imageName,
            ]);
            $request->file('image')->move(public_path('images'), $imageName);
            $request->session()->flash('success', 'Brand added successfully!');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Failed to add brand');
        }
        return back();
    }

    public function update(EditBrandRequest $request, Brand $brand)
    {
        try {
            $slug = slug($request->get('name'));
            $imageName = $brand->image;
            if ($request->file('image')) {
                deleteImage($brand->image);
                $imageName = $slug . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('images'), $imageName);
            }

            Brand::where('id', $brand->id)->update([
                'name' => $request->get('name'),
                'slug' => $slug,
                'image' => $imageName,
            ]);
            $request->session()->flash('success', 'Brand updated successfully!');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Failed to update brand');
        }
        return back();
    }

    public function destroy(Request $request, Brand $brand)
    {
        try {
            deleteImage($brand->image);
            $brand->delete();
            $request->session()->flash('success', 'Brand deleted successfully!');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Failed to delete brand');
        }
        return back();
    }
}
