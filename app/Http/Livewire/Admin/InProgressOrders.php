<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class InProgressOrders extends Component
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
        return view('livewire.admin.in-progress-orders', $data);
    }
}
