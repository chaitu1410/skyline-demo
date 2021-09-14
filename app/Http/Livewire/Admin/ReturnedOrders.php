<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ReturnOrder;
use Livewire\WithPagination;

class ReturnedOrders extends Component
{

    public $query;
    public function mount($query = "")
    {
        $this->query = $query;
    }

    use WithPagination;
    public function render()
    {
        $returnorders = ReturnOrder::query();
        $returnorders->whereHas('order', function ($q) {
            $q->where('id', 'like', '%' . $this->query . '%');
        });
        $data['returnorders'] = $returnorders->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.returned-orders', $data);
    }
}
