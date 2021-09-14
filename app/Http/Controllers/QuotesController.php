<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuoteRequest;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{

    public function index()
    {
        $data['quotes'] = Auth::user()->quotes;
        return view('quotes.index', $data);
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(StoreQuoteRequest $request)
    {
        $clientRequirementFileName = null;

        if ($request->hasFile('clientRequirement')) {
            $clientRequirementFileName = getRandomFileName() . '.' . $request->file('clientRequirement')->extension();
            $request->file('clientRequirement')->move(public_path('files'), $clientRequirementFileName);
        }
        Auth::user()->quotes()->create([
            'customerName' => $request->get('name'),
            'company' => $request->get('company'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'requirement' => $request->get('requirements'),
            'pincode' => $request->get('pincode'),
            'city' => $request->get('city'),
            'clientQuotationFile' => $clientRequirementFileName,
        ]);
        $request->session()->flash('success', 'Your quotation sent to skyline successfully!');
        return redirect(route('home'));
    }
}
