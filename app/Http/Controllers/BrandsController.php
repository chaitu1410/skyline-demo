<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function show(Request $request, Brand $brand)
    {
        $data['query'] = $request->get('query');
        $data['brand'] = $brand;
        return view("brands.show", $data);
    }
}
