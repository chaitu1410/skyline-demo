<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Varient;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\EditVarientRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreVarientRequest;

class ProductsController extends Controller
{
    public function create(Category $category)
    {
        $data['subcategories'] = $category->subcategories;
        $data['brands'] = Brand::select('id', 'name')->get();
        $data['category'] = $category;
        return view('admin.products.create', $data);
    }

    public function store(StoreProductRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $subcategory = $request->get('subcategory');
            if ($subcategory && !(Subcategory::where('id', $subcategory)->exists())) {
                $request->session()->flash('error', 'Subcategory doesn\'t exists');
                return back();
            }

            $name = $request->get('name');
            $slug = slug($name);
            $imageName = $slug . '.' . $request->file('image')->extension();
            $manualName = $slug . '.' . $request->file('manual')->extension();

            $product = $category->products()->create([
                'name' => $name,
                'slug' => $slug,
                'image' => $imageName,
                'manual' => $manualName,
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
                'verified' => $request->get('verified'),
                'topPick' => $request->get('topPick') ? true : false,
                'description' => $request->get('description'),
                'countryOfOrigin' => $request->get('countryOfOrigin'),
                'brand_id' => $request->get('brand'),
                'subcategory_id' => $subcategory,
            ]);
            $request->file('image')->move(public_path('images'), $imageName);
            $request->file('manual')->move(public_path('files'), $manualName);

            $varient = $product->varients()->create([
                'name' => 'base',
                'slug' => 'base',
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
            ]);

            $props = $request->get('properties');
            $values = $request->get('values');
            if ($props) {
                for ($i = 0; $i < count($props); $i++) {
                    if ($props[$i] !== null && $values[$i] !== null) {
                        $varient->properties()->create([
                            'property' => $props[$i],
                            'value' => $values[$i]
                        ]);
                    }
                }
            }

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $img) {
                    $imgName = slug($name) . '.' . $img->getClientOriginalExtension();
                    ProductImage::create([
                        'image' => $imgName,
                        'product_id' => $product->id
                    ]);
                    $img->move(public_path('images'), $imgName);
                }
            }
            DB::commit();
            $request->session()->flash('success', 'Product added to ' . $category->name . ' category!');
            if ($subcategory) {
                return redirect(route('admin.categories.showSubcategory', ['category' => $category->id, 'subcategory' => $subcategory]));
            }
            return redirect(route('admin.categories.show', ['category' => $category->id]));
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to add product');
            return redirect(route('admin.categories.show', ['category' => $category->id]));
        }
    }

    public function show(Product $product)
    {
        return view('admin.products.show');
    }

    public function edit(Request $request, Product $product)
    {
        try {
            $data['product'] = $product;
            $data['properties'] = $product->varients()->where('name', '=', 'base')->first()->properties()->get();
            $data['subcategories'] = $product->category->subcategories;
            $data['brands'] = Brand::select('id', 'name')->get();
            $data['category'] = $product->category;
            return view('admin.products.edit', $data);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Currntly cannot edit product');
            return back();
        }
    }

    public function update(EditProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $subcategoryId = $request->get('subcategory');
            if ($subcategoryId && !(Subcategory::where('id', $subcategoryId)->exists())) {
                $request->session()->flash('error', 'Subcategory doesn\'t exists');
                return back();
            }

            $categoryId = $product->category->id;
            $name = $request->get('name');
            $slug = $product->slug;
            $imageName = $product->image;
            $manualName = $product->manual;

            if ($name !== $product->name) {
                $slug = slug($name);
            }

            if ($request->hasFile('image')) {
                deleteImage($imageName);
                $imageName = $slug . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('images'), $imageName);
            }

            if ($request->hasFile('manual')) {
                deleteFile($manualName);
                $manualName = $slug . '.' . $request->file('manual')->extension();
                $request->file('manual')->move(public_path('files'), $manualName);
            }


            $product->update([
                'name' => $name,
                'slug' => $slug,
                'image' => $imageName,
                'manual' => $manualName,
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
                'verified' => $request->get('verified'),
                'topPick' => $request->get('topPick') ? true : false,
                'description' => $request->get('description'),
                'countryOfOrigin' => $request->get('countryOfOrigin'),
                'brand_id' => $request->get('brand'),
                'subcategory_id' => $subcategoryId,
                'category_id' => $categoryId,
            ]);

            $varient = $product->varients()->where('name', '=', 'base')->first();

            $varient->update([
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
            ]);

            $props = $request->get('properties');
            $values = $request->get('values');
            if ($props) {
                for ($i = 0; $i < count($props); $i++) {
                    if ($props[$i] !== null && $values[$i] !== null) {
                        $varient->properties()->where('property', '=',  $props[$i])->update([
                            'value' => $values[$i]
                        ]);
                    }
                }
            }

            if ($request->hasFile('images')) {

                $oldImages = $product->productImages;
                foreach ($oldImages as $oldImage) {
                    deleteImage($oldImage->image);
                    $oldImage->delete();
                }

                $images = $request->file('images');
                foreach ($images as $img) {
                    $imgName = slug($name) . '.' . $img->getClientOriginalExtension();
                    ProductImage::create([
                        'image' => $imgName,
                        'product_id' => $product->id
                    ]);
                    $img->move(public_path('images'), $imgName);
                }
            }
            DB::commit();
            $request->session()->flash('success', 'Product updated successfully!');
            if ($subcategoryId) {
                return redirect(route('admin.categories.showSubcategory', ['category' => $categoryId, 'subcategory' => $subcategoryId]));
            }
            return redirect(route('admin.categories.show', ['category' => $categoryId]));
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to edit product');
            return redirect(route('admin.categories.show', ['category' => $categoryId]));
        }
    }

    public function addVarient()
    {
        return view('admin.products.addVarient');
    }

    public function storeVarient(StoreVarientRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $varient = $product->varients()->create([
                'name' => $request->get('name'),
                'slug' => slug($request->get('name')),
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
            ]);

            $props = $request->get('properties');
            $values = $request->get('values');
            if ($props) {
                for ($i = 0; $i < count($props); $i++) {
                    if ($props[$i] !== null && $values[$i] !== null) {
                        $varient->properties()->create([
                            'property' => $props[$i],
                            'value' => $values[$i]
                        ]);
                    }
                }
            }
            DB::commit();
            $request->session()->flash('success', 'Varient added successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to add varient');
        }
        return back();
    }

    public function updateVarient(EditVarientRequest $request, Product $product, Varient $varient)
    {
        try {
            DB::beginTransaction();
            $varient->update([
                'name' => $request->get('name'),
                'slug' => slug($request->get('name')),
                'mrp' => $request->get('mrp'),
                'discount' => $request->get('discount'),
                'gst' => $request->get('gst'),
                'sellingPrice' => $request->get('sellingPrice'),
                'stock' => $request->get('stock'),
            ]);

            $props = $request->get('properties');
            $values = $request->get('values');
            if ($props) {
                for ($i = 0; $i < count($props); $i++) {
                    if ($props[$i] !== null && $values[$i] !== null) {
                        $varient->properties()->where('property', '=',  $props[$i])->update([
                            'value' => $values[$i]
                        ]);
                    }
                }
            }
            DB::commit();
            $request->session()->flash('success', 'Varient updated successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to update varient');
        }
        return back();
    }

    public function destroy(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            deleteImage($product->image);
            $images = $product->productImages;
            foreach ($images as $image) {
                deleteImage($image->image);
                $image->delete();
            }
            deleteFile($product->manual);
            $product->delete();
            DB::commit();
            $request->session()->flash('success', 'Product deleted succesfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to delete product');
        }
        return back();
    }
}
