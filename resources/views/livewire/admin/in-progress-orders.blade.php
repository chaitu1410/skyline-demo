<div class="tab-pane fade show active" id="cat2" role="tabpanel" aria-labelledby="home-tab">
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
                        <div class="d-flex editstatusbtn" data-bs-toggle="modal"
                            data-bs-target="#statusupdate{{ $order->id }}">
                            @if($order->status == config('constants.orderStatus.accepted'))
                                <span class="badge bg-success">Order Accepted</span>
                            @elseif($order->status == config('constants.orderStatus.packed'))
                                <span class="badge bg-secondary">Packed</span>
                            @elseif($order->status == config('constants.orderStatus.shipped'))
                                <span class="badge bg-primary">Shipped</span>
                            @elseif($order->status == config('constants.orderStatus.outForDelivery'))
                                <span class="badge bluebg">Out For Delivery</span>
                            @endif
                            <span class="material-icons" style="font-size: 21px;">
                                edit_note
                            </span>
                        </div>  

                    </td>
                    <td>
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#viewproductsmodal{{ $order->id }}">View Products</a>
                    </td>

                    <td>₹{{ $order->orderDetail->payableAmount }}</td>
                    <td>{{ $order->orderDetail->gst }}</td>
                    <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>

                    <!--modal for status update starts  -->
                    <div class="modal fade" id="statusupdate{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')  
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label fw-bold">Status :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" @if($order->status == config('constants.orderStatus.accepted')) checked @endif value="{{config('constants.orderStatus.accepted')}}">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Order Accepted
                                                </label>
                                            </div>
            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" @if($order->status == config('constants.orderStatus.packed')) checked @endif value="{{config('constants.orderStatus.packed')}}">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Order Packed
                                                </label>
                                            </div>
            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" @if($order->status == config('constants.orderStatus.shipped')) checked @endif value="{{config('constants.orderStatus.shipped')}}">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Order Shipped
                                                </label>
                                            </div>
            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault3" @if($order->status == config('constants.orderStatus.outForDelivery')) checked @endif value="{{config('constants.orderStatus.outForDelivery')}}">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Out For Delivery
                                                </label>
                                            </div>
            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault3" @if($order->status == config('constants.orderStatus.delivered')) checked @endif value="{{config('constants.orderStatus.delivered')}}">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Order Delivered
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label fw-bold">Estimated Delivery
                                                Date :</label>
            
                                                <input type="date" name="date" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($order->estimatedDate)) }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn bluebg btn-sm">Update Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--modal for status update ends  -->
    
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
                <p>No orders in progress</p>
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
