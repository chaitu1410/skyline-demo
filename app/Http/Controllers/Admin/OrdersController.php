<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditOrderRequest;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status') ?? config('constants.orderStatus.ordered');

        if (!(in_array($status, config('constants.orderStatus')))) {
            return back();
        }
        $data['status'] = $status;
        $data['query'] = $request->get('query');
        return view('admin.orders.index', $data);
    }

    public function confirm(Request $request, Order $order)
    {
        try {
            $order->update([
                'status' => config('constants.orderStatus.accepted'),
                'estimatedDate' => $request->get('date')
            ]);
            $res = sendOrderStatusSMS($order->orderDetail->customerMobile, $order->id, getUpperStatus(config('constants.orderStatus.accepted')) . 'by Skyline admin');
            if ($res) {
                $request->session()->flash('success', 'Order accepted successfully!');
            } else {
                $request->session()->flash('success', 'Order accepted successfully but failed to send SMS');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to accept order');
        }
        return back();
    }

    public function cancel(Request $request, Order $order)
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
                'cancelledBy' => config('constants.userType.admin'),
                'reason' => $request->get('reason'),
            ]);
            $res = sendOrderStatusSMS($order->orderDetail->customerMobile, $order->id, getUpperStatus(config('constants.orderStatus.accepted')) . 'by Skyline admin');
            if ($res) {
                $request->session()->flash('success', 'Order cancelled successfully!');
            } else {
                $request->session()->flash('success', 'Order cancelled successfully but failed to send SMS');
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to cancel order');
        }

        return back();
    }

    public function update(EditOrderRequest $request, Order $order)
    {
        try {
            if (!(in_array($request->get('status'), config('constants.orderStatus')))) {
                return back();
            }

            $updatedOrder = [];
            if ($request->get('status') != config('constants.orderStatus.delivered')) {
                $updatedOrder = [
                    'status' => $request->get('status'),
                    'estimatedDate' => $request->get('date')
                ];
            } else {
                $updatedOrder = [
                    'status' => $request->get('status'),
                    'estimatedDate' => $request->get('date'),
                    'isDelivered' => true,
                    'delivered_at' => Carbon::now()
                ];
            }

            $order->update($updatedOrder);
            $res = sendOrderStatusSMS($order->orderDetail->customerContact, $order->id, getUpperStatus($request->get('status')));
            if ($res) {
                $request->session()->flash('success', 'Order status set to ' . $request->get('status') . ' successfully!');
            } else {
                $request->session()->flash('success', 'Order status set to ' . $request->get('status') . ' successfully but failed to send SMS');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed change order state');
        }
        return back();
    }

    public function cancelReply(Request $request, Order $order)
    {
        try {
            if (!($request->has('reply')) || $request->get('reply') == "") {
                $request->session()->flash('error', 'Please enter your reply');
                return back();
            }
            $order->cancelledOrder()->update([
                'reply' => $request->get('reply'),
            ]);
            $request->session()->flash('success', 'Replied successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to post cancel reply');
        }
        return back();
    }

    public function returnReply(Request $request, ReturnOrder $returnorder)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'replies' => ['required'],
                'replies.*' => ['required', 'max:2048'],
            ]);

            $returnorderproductids = $request->get('returnorderproducts');
            $replies = $request->get('replies');

            foreach ($returnorderproductids as $key => $returnorderproductid) {
                $returnorder->returnOrderProducts()->find($returnorderproductid)->update([
                    'reply' => $replies[$key]
                ]);
            }
            $request->session()->flash('success', 'Replied successfully!');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to post return reply');
        }
        return back();
    }
}
