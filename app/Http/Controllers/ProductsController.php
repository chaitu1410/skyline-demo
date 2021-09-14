<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Varient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = "";

        if ($request->get('query')) {
            $query = $request->get('query');
        }

        return view('products.index', [
            'query' => $query,
        ]);
    }

    public function show(Request $request, Product $product)
    {
        $data['product'] = $product;
        $varients = $product->varients;

        if ($request->get('varient')) {
            $data['varient'] = $varients->find($request->get('varient'));
        } else {
            $data['varient'] = $varients->where('name', '=', 'base')->first();
        }
        if (!($data['varient'])) {
            return back();
        }

        $data['varients'] = $varients;
        $data['images'] = $product->productImages;
        $data['relatedProducts'] = $product->category->products->take(10);

        return view('products.show', $data);
    }

    public function addToCart(Request $request, Product $product, Varient $varient)
    {
        //dd(\Cart::get($product->id));
        if (\Cart::session(Auth::id())->get($product->id) && \Cart::session(Auth::id())->get($product->id)['attributes']['varient']['id'] === $varient->id) {
            $request->session()->flash('success', 'Product already added to cart');
            return redirect('cart');
        }


        \Cart::session(Auth::id())->add([
            'id' => $product->id . $varient->id,
            'name' => $product->name,
            'price' => $varient->sellingPrice,
            'quantity' => $request->get('quantity'),
            'attributes' => array(
                'varient' => $varient
            ),
            'associatedModel' => $product,
        ]);
        $request->session()->flash('success', 'Product added to cart successfully!');
        return redirect('cart');
    }
}
