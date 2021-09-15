<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $quotes = Quote::query();
        $quotes->where('company', 'like', '%' . $query . '%');
        $quotes->orWhere('customerName', 'like', '%' . $query . '%');
        $quotes->orWhere('pincode', 'like', '%' . $query . '%');
        $quotes->orWhere('city', 'like', '%' . $query . '%');
        $data['quotes'] = $quotes->paginate(15);

        return view('admin.quotes.index', $data);
    }

    public function reply(Request $request, Quote $quote)
    {
        try {
            if (!($request->has('reply')) || $request->get('reply') == "") {
                $request->session()->flash('error', 'Reply is required');
                return back();
            }
            $file = null;
            if ($request->hasFile('file')) {
                $file = getRandomFileName() . '.' . $request->file('file')->extension();
                $request->file('file')->move(public_path('files'), $file);
            }
            $quote->update([
                'reply' => $request->get('reply'),
                'adminQuotationFile' => $file
            ]);
            $request->session()->flash('success', 'Quotation replyed successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to post quote reply');
        }
        return back();
    }
}
