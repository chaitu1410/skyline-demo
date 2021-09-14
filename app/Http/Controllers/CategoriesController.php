<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        return view('categories.index', $data);
    }

    public function show(Request $request, Category $category)
    {
        $data['query'] = $request->get('query');
        $data['category'] = $category;
        return view('categories.show', $data);
    }
}
