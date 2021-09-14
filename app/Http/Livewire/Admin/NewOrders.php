<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class NewOrders extends Component
{
    use WithPagination;
    public function render()
    {
        $orders = Order::query();
        $orders->where('status', '=', config('constants.orderStatus.ordered'));
        //$orders->whereHas('OrderDetail', function ($q) {
        //  $q->where('customerName', 'like', '%' . $this->query . '%');
        //  $q->orWhere('customerContact', 'like', '%' . $this->query . '%');
        //  $q->orWhere('company', 'like', '%' . $this->query . '%');
        //});
        $data['orders'] = $orders->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.new-orders', $data);
    }
}