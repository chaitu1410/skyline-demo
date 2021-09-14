<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQueryRequest;

class QueriesController extends Controller
{
    public function store(StoreQueryRequest $request)
    {
        Query::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'message' => $request->get('message')
        ]);
        $request->session()->flash('success', 'Query posted successfully!');
        return back();
    }
}
