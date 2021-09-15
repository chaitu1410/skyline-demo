<div class="tab-pane fade show active" id="cat4" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Payment ID</th>
                <th>Customer Name</th>
               
                <th>Contact No.</th>
                <th>Ship To</th>
                <th>Status</th>

                <th>Purchased Products</th>
                <th>Purchased Price</th>
                <th>GST No.</th>
                <th>Trade/Company Name</th>
                <th>Ordered Date</th>
                
                <th>Reason</th>
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
                
                    <td>{{ $order->orderDetail->customerContact }}</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $order->orderDetail->houseNumber }}, {{ $order->orderDetail->landmark }}, {{ $order->orderDetail->area }}, {{ $order->orderDetail->town }}. {{ $order->orderDetail->pincode }}</p>
                        </div>
                    </td>
                    <td>
                        @if($order->cancelledOrder->cancelledBy == config('constants.userType.admin'))
                            <span class="badge bg-primary">Canceled By Admin</span>
                        @elseif($order->cancelledOrder->cancelledBy == config('constants.userType.user'))
                            <span class="badge bg-danger">Canceled By User</span>
                        @endif
                    </td>

                    <td>
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#viewproductsmodal{{ $order->id }}">View Products</a>
                    </td>

                    <td>₹{{ $order->orderDetail->payableAmount }}</td>
                    <td>{{ $order->orderDetail->gst }}</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $order->orderDetail->company }}</p>
                        </div>
                    </td>
                    <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>
                    <td>
                        @if($order->cancelledOrder->cancelledBy == config('constants.userType.admin'))
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#reasonreturnmodal{{ $order->id }}">View</a>
                        @elseif($order->cancelledOrder->cancelledBy == config('constants.userType.user'))
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#reasoncancelmodalwithreply{{ $order->id }}">View & Reply</a>
                        @endif

                    </td>
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
                                            <div class="orderhistoryitem">
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
        
                        @if($order->cancelledOrder->cancelledBy == config('constants.userType.admin'))
                            <!--Cancelled by admin start -->
                            <div class="modal fade" id="reasonreturnmodal{{ $order->id }}" tabindex="-1" aria-labelledby="reasonreturnmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex mb-3justify-content-between align-content-center">
                                            <h6 class="fw-bold">Reason For Cancelling Order</h6>
                                        </div>
                                        <div>
                                            <p>{{ $order->cancelledOrder->reason }}</p>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                            </div>
                            <!--Cancelled by admin end-->
                        @elseif($order->cancelledOrder->cancelledBy == config('constants.userType.user'))
                            <!-- Cancelled by user start -->
                            <div class="modal fade" id="reasoncancelmodalwithreply{{ $order->id }}" tabindex="-1" aria-labelledby="replyreturnmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.orders.cancelReply', $order) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="returnedproduct">
                                                <div>
                                                    <p class="mb-0 fw-bold">Reason to cancel order :</p>
                                                    <p>{{ $order->cancelledOrder->reason }}</p>
                                                </div>
                                            </div>
                                            <hr>
                
                                            <p class="mb-3 fw-bold">Reply to User:</p>
                                            <div class="mb-3">
                                                <textarea class="form-control form-control-sm" name="reply" id="exampleFormControlTextarea1" rows="5"
                                                    placeholder="Write your reply here...">{{ $order->cancelledOrder->reply }}</textarea>
                                            </div>
                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bluebg btn-sm">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Cancelled by user end -->
                    @endif
                </tr>
                


        @empty
            <p>No cancelled orders.</p>
        @endforelse

        </tbody>
    </table>
</div>