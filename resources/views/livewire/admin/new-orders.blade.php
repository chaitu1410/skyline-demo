<div class="tab-pane fade show active" id="cat1" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Payment ID</th>
                <th>Customer Name</th>
                <th>Trade/Company Name</th>
                <th>Contact No.</th>
                <th>Ship To</th>
                <th>Purchased Products</th>
                <th>Purchased Price</th>
                <th>GST No.</th>
                <th>Ordered Date</th>
                <th>Action</th>
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
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#viewproductsmodal{{ $order->id }}">View Products</a>
                    </td>

                    <td>₹{{ $order->orderDetail->payableAmount }}</td>
                    <td>{{ $order->orderDetail->gst }}</td>
                    <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>

                    <td>
                        <div class="d-flex">
                            <button class="btn bg-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#acceptordermodal{{ $order->id }}">
                                <span class="material-icons text-white">
                                    done
                                </span>
                            </button>

                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#rejectordermodal">
                                <span class="material-icons">
                                    close
                                </span>
                            </button>
                        </div>

                    </td>
                        <!--modal for order confirm starts -->
                        <div class="modal fade" id="acceptordermodal{{ $order->id }}" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.orders.confirm', $order) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label fw-bold">Estimated Delivery
                                                    Date :</label>
                                                <input type="date" name="date" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($order->estimatedDate)) }}">
                                            </div>
            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bluebg btn-sm">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--modal for order confirm ends-->
        
                        <!--modal for reject confirm starts -->
                            <div class="modal fade" id="rejectordermodal" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.orders.cancel', $order) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <p>Are you sure that you want to reject this order ?</p>
                                                </div>
                                                <textarea class="form-control form-control-sm" name="reason" id="exampleFormControlTextarea1" rows="5"
                                                    placeholder="Write reason to reject order..."></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger btn-sm">Confirm Reject Order</button>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div>
                            <!--modal for reject confirm ends-->
        
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
                <p>No new orders</p>
            @endforelse


        </tbody>
    </table>
    <!-- pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm justify-content-end">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
</div>