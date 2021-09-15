<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CancelOrdersController extends Controller
{

    public function index()
    {
        $data['orders'] = Auth::user()->orders()
            ->where('isPaid', true)
            ->where('status', '=', config('constants.orderStatus.cancelled'))
            ->orderBy('updated_at', 'desc')
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
        try {
            DB::beginTransaction();
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
            DB::commit();
            $request->session()->flash('success', 'Order cancelled successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to cancel order');
            return back();
        }
        return redirect(route('orders.cancel.index'));
    }
}
