<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests\StoreQueryRequest;

class QuestionsController extends Controller
{
    public function store(Request $request, Product $product)
    {
        try {
            if (($request->has('question')) && ($request->question !== "")) {
                $product->questions()->create([
                    'question' => $request->question,
                    'user_id' => Auth::id()
                ]);
                $request->session()->flash('success', 'Question posted successfully!');
            } else {
                $request->session()->flash('error', 'Please enter question in textbox');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to post question');
        }
        return back();
    }
}
