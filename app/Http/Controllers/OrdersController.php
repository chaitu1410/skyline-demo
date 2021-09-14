<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Pincode;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\ContactDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;

class OrdersController extends Controller
{
    public function index()
    {
        $data['orders'] = Auth::user()->orders()
            ->where('isPaid', true)
            ->orderBy('created_at', 'desc')
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
            if ($payableAmount < $pincode->freeDeliveryLimit) {
                $deliveryCharge = $pincode->deliveryCharge;
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
            $request->session()->flash('error', $e->getMessage());
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
        $data['order'] = $order;
        $data['details'] = $order->orderDetail;
        $data['products'] = $order->orderProducts;
        $data['pincode'] = Pincode::where('pincode', '=', $order->orderDetail->pincode)->first();
        $data['sellerDetails'] = ContactDetail::first();
        //return view('orders.invoice', $data);
        $pdf = PDF::loadView('orders.invoice', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('order_' . $order->id . '_invoice.pdf');
    }

    public function pay(Request $request)
    {
        $order = Order::where('razorpayOrderId', $request->get('razorpay_order_id'))->first();
        $order->update([
            'razorpayPaymentId' => $request->get('razorpay_payment_id'),
            'isPaid' => true,
        ]);
        $request->session()->flash('success', "Order placed Successfully!");
        return redirect(route('orders.index'));
    }
}
