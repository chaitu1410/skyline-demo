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
        $orders->where('isPaid', true);
        $orders->where('status', '=', config('constants.orderStatus.delivered'));
        $orders->orWhere('status', '=', config('constants.orderStatus.returned'));
        $orders->whereHas('OrderDetail', function ($q) {
            $q->where('customerName', 'like', '%' . $this->query . '%');
            $q->orWhere('customerContact', 'like', '%' . $this->query . '%');
            $q->orWhere('company', 'like', '%' . $this->query . '%');
        });
        //$orders->where('id', 'like', '%' . $this->query . '%');
        $data['orders'] = $orders->orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.admin.delivered-orders', $data);
    }
}
