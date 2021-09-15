<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Pincode;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ContactDetail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;

class OrdersController extends Controller
{
    public function index()
    {
        $data['orders'] = Auth::user()->orders()
            ->where('isPaid', true)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('orders.index', $data);
    }

    public function confirm()
    {
        $data['address'] = Auth::user()->address;
        return view('orders.confirm', $data);
    }

    public function placeOrder(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $order = Auth::user()->orders()->create();

            $cartItems = \Cart::session(Auth::id())->getContent()->toArray();
            $mrpTotal = 0.0;
            $gstTotal = 0.0;
            $discountTotal = 0.0;
            $deliveryCharge = 0.0;
            $pincode = Pincode::where('pincode', '=', $request->get('pincode'))->first();

            foreach ($cartItems as $item) {
                $product = Product::find($item['associatedModel']['id']);
                $varient = $product->varients->find($item['attributes']['varient']['id']);
                if ($product && $varient) {
                    $mrpTotal += ($varient->mrp * $item['quantity']);
                    $gstTotal += ($varient->gstAmount() * $item['quantity']);
                    $discountTotal += ($varient->totalSaving() * $item['quantity']);

                    $order->orderProducts()->create([
                        'quantity' => $item['quantity'],
                        'amount' => ($varient->sellingPrice * $item['quantity']),
                        'product_id' => $product->id,
                        'varient_id' => $varient->id,
                    ]);
                }
            }

            $payableAmount = $mrpTotal + $gstTotal - $discountTotal;
            if (!($pincode->freeDeliveryLimit) || $payableAmount < $pincode->freeDeliveryLimit) {
                $deliveryCharge += $pincode->deliveryCharge;
            }
            $payableAmount += $deliveryCharge;

            $order->orderDetail()->create([
                'customerName' => $request->get('name'),
                'customerContact' => $request->get('mobile'),
                'customerContact2' => $request->get('mobile2'),
                'company' => $request->get('company'),
                'gst' => $request->get('gst'),
                'pincode' => $request->get('pincode'),
                'town' => $request->get('town'),
                'area' => $request->get('area'),
                'houseNumber' => $request->get('houseNumber'),
                'landmark' => $request->get('landmark'),
                'amount' => $mrpTotal,
                'totalGst' => $gstTotal,
                'totalDiscount' => $discountTotal,
                'deliveryCharge' => $deliveryCharge,
                'payableAmount' => $payableAmount,
            ]);

            $api = new Api('rzp_test_6MWDVR7We3RUcY', 'efLRemqSArimxOuzOEAuQdyT');
            $razorPayOrder = $api->order->create(array('receipt' => $order->id, 'amount' => $payableAmount * 100, 'currency' => 'INR')); // Creates order
            $razorPayOrderId = $razorPayOrder['id'];

            $order->update([
                'razorpayOrderId' => $razorPayOrderId
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', "Faild to place order");
            return redirect(route('carts.index'));
        }
        return redirect(route('orders.checkout', $order));
    }

    public function checkout(Request $request, Order $order)
    {
        $data['order'] = $order;
        return view('orders.checkout', $data);
    }

    public function invoice(Request $request, Order $order)
    {
        try {
            $data['order'] = $order;
            $data['details'] = $order->orderDetail;
            $data['products'] = $order->orderProducts;
            $data['pincode'] = Pincode::where('pincode', '=', $order->orderDetail->pincode)->first();
            $data['sellerDetails'] = ContactDetail::first();
            $pdf = PDF::loadView('orders.invoice', $data)->setOptions(['defaultFont' => 'sans-serif']);

            return $pdf->download('order_' . $order->id . '_invoice.pdf');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to download invoice');
            return back();
        }
    }

    public function pay(Request $request)
    {
        $order = Order::where('razorpayOrderId', $request->get('razorpay_order_id'))->first();
        try {
            $order->update([
                'razorpayPaymentId' => $request->get('razorpay_payment_id'),
                'isPaid' => true,
            ]);
            $request->session()->flash('success', "Order placed Successfully!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to place order');
        }
        return redirect(route('orders.index'));
    }
}
