<?php

namespace App\View\Components\admin;

use App\Models\Order;
use Illuminate\View\Component;

class OrdersInProgress extends Component
{
    public $query;
    public function __construct($query = "")
    {
        $this->query = $query;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $orders = Order::query();
        $orders->where('status', '=', config('constants.orderStatus.accepted'))
            ->orWhere('status', '=', config('constants.orderStatus.shipped'))
            ->orWhere('status', '=', config('constants.orderStatus.packed'))
            ->orWhere('status', '=', config('constants.orderStatus.outForDelivery'));
        $orders->whereHas('OrderDetail', function ($q) {
            $q->where('customerName', 'like', '%' . $this->query . '%');
            $q->orWhere('customerContact', 'like', '%' . $this->query . '%');
            $q->orWhere('company', 'like', '%' . $this->query . '%');
        });
        $data['orders'] = $orders->orderBy('created_at', 'desc')->paginate(10);
        return view('components.admin.orders-in-progress', $data);
    }
}
