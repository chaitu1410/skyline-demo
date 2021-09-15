<div class="tab-pane fade show active" id="cat3" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Payment ID</th>
                <th>Customer Name</th>  
                <th>Trade/Company Name</th>  
                <th>Contact No.</th>
                <th>Ship To</th>
                <th>Status</th>
                <th>Purchased Products</th>

                <th>Purchased Price</th>
                <th>GST No.</th>
                <th>Ordered Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)    
                <tr wire:key="{{ $order->id }}">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->razorpayPaymentId }}</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $order->orderDetail->customerName }}</p>
                        </div>
                    </td>

                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $order->orderDetail->company }}</p>
                        </div>
                    </td>

                    <td>{{ $order->orderDetail->customerContact }}</td>

                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $order->orderDetail->houseNumber }}, {{ $order->orderDetail->landmark }}, {{ $order->orderDetail->area }}, {{ $order->orderDetail->town }}. {{ $order->orderDetail->pincode }}</p>
                        </div>
                    </td>

                    <td>
                        <span class="badge bg-success">Delivered</span>@if($order->status == config('constants.orderStatus.returned'))<br><small>(Returned Completely)</small>@endif
                    </td>

                    <td>
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#viewproductsmodal{{ $order->id }}">View Products</a>
                    </td>

                    <td>₹{{ $order->orderDetail->payableAmount }}</td>

                    <td>{{ $order->orderDetail->gst }}</td>

                    <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>
                    <!--modal for view products ordered starts -->
                    <div class="modal fade" id="viewproductsmodal{{ $order->id }}" tabindex="-1" aria-labelledby="viewproductsmodalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
    
                                    <div class="d-flex mb-4 justify-content-between align-content-center">
                                        <h6 class="fw-bold">Purchased Products</h6>
    
                                    </div>
    
                                    @forelse ($order->orderProducts as $p)    
                                        <div wire:key="prod{{ $p->id }}" class="orderhistoryitem">
                                            <p class="mb-0">
                                                <a href="">{{ $p->product->name }}</a>
                                            </p>
                                            <p class="mb-0 text-success">₹{{ $p->varient->sellingPrice }}</p>
                                            <p class="mb-0 text-secondary">Qty: {{ $p->quantity }}</p>
                                            <p class="mb-0 text-secondary">Varient: {{ $p->varient->name }}</p>
                                        </div>
                                    @empty
                                        
                                    @endforelse
    
                                    <h6 class="fw-bold">Total Amount: ₹{{ $order->orderDetail->payableAmount }}</h6>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    <!--modal for view products ordered  ends-->
                </tr>

            @empty
                <p>No delivered orders</p>
            @endforelse

        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-end">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
</div>