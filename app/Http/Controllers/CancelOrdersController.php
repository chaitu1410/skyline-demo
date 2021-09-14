<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CancelOrdersController extends Controller
{

    public function index()
    {
        $data['orders'] = Auth::user()->orders()
            ->where('isPaid', true)
            ->where('status', '=', config('constants.orderStatus.cancelled'))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('orders.cancel.index', $data);
    }

    public function create(Request $request, Order $order)
    {
        $data['order'] = $order;
        return view('orders.cancel.create', $data);
    }

    public function store(Request $request, Order $order)
    {
        if (!($request->has('reason')) || $request->get('reason') == "") {
            $request->session()->flash('error', 'Please enter reason');
            return back();
        }
        $order->update([
            'status' => config('constants.orderStatus.cancelled'),
        ]);

        $order->cancelledOrder()->create([
            'cancelledBy' => config('constants.userType.user'),
            'reason' => $request->get('reason'),
        ]);

        $request->session()->flash('success', 'Order cancelled successfully!');
        return redirect(route('orders.cancel.index'));
    }
}
