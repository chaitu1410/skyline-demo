<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReturnOrderRequest;

class OrderReturnsController extends Controller
{
    public function index(Request $request)
    {
        $returnedorders = Auth::user()->returnOrders()
            ->whereHas('Order', function ($q) {
                $q->where('isPaid', true);
            })
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['returnedorders'] = $returnedorders;
        return view('orders.return.index', $data);
    }

    public function create(Request $request, Order $order)
    {
        $data['order'] = $order;
        return view('orders.return.create', $data);
    }

    public function store(StoreReturnOrderRequest $request, Order $order)
    {
        try {
            DB::beginTransaction();
            $products = $request->get('products');
            $reasons = $request->get('reasons');
            $detailedReasons = $request->get('detailedReasons');

            $orderproducts = $order->orderProducts;
            $totalReturnPrice = 0;

            foreach ($products as $key => $productId) {
                $prod = $orderproducts->find($productId);
                $prod->update(['returned' => true]);
                $totalReturnPrice += $prod->amount;
            }

            $returnOrder = $order->returnOrders()->create([
                'returnAmount' => $totalReturnPrice,
                'pickupAddress' => $request->get('pickupAddress'),
                'deliveryCharge' => $order->orderDetail->deliveryCharge,
                'user_id' => Auth::id(),
            ]);

            foreach ($products as $key => $productId) {
                $orderproducts->find($productId)->update(['returned' => true]);
                $returnOrder->returnOrderProducts()->create([
                    'reason' => $reasons[$key],
                    'detailedReason' => $detailedReasons[$key],
                    'order_product_id' => $productId,
                ]);
            }

            if ($orderproducts->where('returned', '=', false)->count() == 0) {
                $order->update([
                    'status' => config('constants.orderStatus.returned')
                ]);
            }
            DB::commit();
            $request->session()->flash('success', 'Return order request seent successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to place return order request');
            return back();
        }
        return redirect(route('orders.return.index'));
    }
}
