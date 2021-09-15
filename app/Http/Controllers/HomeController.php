<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['toppicks'] = Product::where('topPick', 1)->take(10)->get();
        $data['banners'] = Banner::all();
        return view('home', $data);
    }
}
