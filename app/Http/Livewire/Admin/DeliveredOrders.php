<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveredOrders extends Component
{

    public $query;
    public function mount($query = "")
    {
        $this->query = $query;
    }

    use WithPagination;
    public function render()
    {
        $orders = Order::query();
        $orders->where('status', '=', config('constants.orderStatus.delivered'));
        $orders->whereHas('OrderDetail', function ($q) {
            $q->where('customerName', 'like', '%' . $this->query . '%');
            $q->orWhere('customerContact', 'like', '%' . $this->query . '%');
            $q->orWhere('company', 'like', '%' . $this->query . '%');
        });
        $data['orders'] = $orders->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.delivered-orders', $data);
    }
}