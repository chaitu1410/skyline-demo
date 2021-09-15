<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuoteRequest;

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
        try {
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
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to send quotation');
        }
        return redirect(route('home'));
    }
}
