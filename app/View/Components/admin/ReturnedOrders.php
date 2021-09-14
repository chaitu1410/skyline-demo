<?php

namespace App\View\Components\admin;

use App\Models\ReturnOrder;
use Illuminate\View\Component;

class ReturnedOrders extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $returnorders = ReturnOrder::query();
        $returnorders->whereHas('order', function ($q) {
            $q->where('id', 'like', '%' . $this->query . '%');
        });
        $data['returnorders'] = $returnorders->orderBy('created_at', 'desc')->paginate(10);
        return view('components.admin.returned-orders', $data);
    }
}
