<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartsController extends Controller
{
    public function index()
    {
        return view('carts.index');
    }
}
