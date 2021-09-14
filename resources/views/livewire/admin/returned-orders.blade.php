<div class="tab-pane fade show active" id="cat5" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Payment ID</th>
                <th>Customer Name</th>
           
                <th>Contact No.</th>
                <th>Pickup Address</th>

                <th>Returned Products</th>
                <th>Purchased Price</th>
                <th>Delivery Charge</th>
                <th>Return Amount</th>
                <th>GST No.</th>
                <th>Trade/Company Name</th>
                <th>Ordered Date</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($returnorders as $returnorder )
                <tr>
                    <td>{{ $returnorder->id }}</td>
                    <td>#345678902345</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $returnorder->order->orderDetail->customerName }}</p>
                        </div>
                    </td>
                
                    <td>{{ $returnorder->order->orderDetail->customerContact }}</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $returnorder->order->orderDetail->houseNumber }}, {{ $returnorder->order->orderDetail->landmark }}, {{ $returnorder->order->orderDetail->area }}, {{ $returnorder->order->orderDetail->town }}. {{ $returnorder->order->orderDetail->pincode }}</p>
                        </div>
                    </td>

                    <td>
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#viewproductsmodal{{ $returnorder->id }}">View Products</a>
                    </td>

                    <td>₹{{ $returnorder->order->orderDetail->payableAmount }}</td>
                    <td>₹{{ $returnorder->order->orderDetail->deliveryCharge }}</td>
                    <td>₹{{ $returnorder->returnAmount }}</td>
                    <td>{{ $returnorder->order->orderDetail->gst }}</td>
                    <td>
                        <div class="tablecellwidth">
                            <p class="mb-0">{{ $returnorder->order->orderDetail->company }}</p>
                        </div>
                    </td>
                    <td>{{ date('d M, Y', strtotime($returnorder->order->created_at)) }}</td>
                    <td>
                        <a href="" data-bs-toggle="modal"
                            data-bs-target="#reasonreturnmodalwithreply{{ $returnorder->id }}">View & Reply</a>

                    </td>

                </tr>

                <!--modal for view products returned starts -->
                <div class="modal fade" id="viewproductsmodal{{ $returnorder->id }}" tabindex="-1" aria-labelledby="viewproductsmodalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">skyline username</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-flex mb-4 justify-content-between align-content-center">
                                    <h6 class="fw-bold">Returned Products</h6>

                                </div>

                                @forelse ($returnorder->returnOrderProducts as $p)    
                                    <div class="orderhistoryitem">
                                        <p class="mb-0">
                                            <a href="">{{ $p->orderProduct->product->name }}</a>
                                        </p>
                                        <p class="mb-0 text-success">₹{{ $p->orderProduct->varient->sellingPrice }}</p>
                                        <p class="mb-0 text-secondary">Varient: {{ $p->orderProduct->varient->name }}</p>
                                        <p class="mb-0 text-secondary">Qty: {{ $p->orderProduct->quantity }}</p>
                                    </div>
                                @empty
                                    
                                @endforelse

                                <h6 class="fw-bold">Total Amount: ₹{{ $p->orderProduct->varient->sellingPrice * $p->orderProduct->quantity }}</h6>
                            </div>

                        </div>
                    </div>
                </div>
                <!--modal for view products returned ends-->
                
                <!--modal for reply to return by user starts -->
                <div class="modal fade" id="reasonreturnmodalwithreply{{ $returnorder->id }}" tabindex="-1" aria-labelledby="replyreturnmodalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <form action="{{ route('admin.orders.returnReply', $returnorder->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $returnorder->order->customerName }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> 
                            <div class="modal-body">
                                <div class="d-flex mb-3justify-content-between align-content-center mt-3 mb-2">
                                    <h6 class="fw-bold">Returned Products :</h6>
                                </div>
                                @forelse ($returnorder->returnOrderProducts as $p)  
                                    <div class="returnedproduct">
                                        <div class="orderhistoryitem">
                                            <p class="mb-0">
                                                <strong>Product</strong>
                                                <a href="">{{ $p->orderProduct->product->name }}</a>
                                            </p>
                                            <p class="mb-0 text-secondary">Variant: {{ $p->orderProduct->varient->name }}</p>
                                            <p class="mb-0 text-success">₹ {{ $p->orderProduct->varient->sellingPrice }}</p>
                                            <p class="mb-0 text-secondary">Qty: {{ $p->orderProduct->quantity }}</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">Reason to return :</p>
                                            <p>{{ $p->reason }}</p>
                                            <p class="mb-0 fw-bold">Detailed Reason :</p>
                                            <p>{{ $p->detailedReason }}</p>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <p class="mb-2 fw-bold">Reply to User:</p>
                                            <input type="hidden" name="returnorderproducts[]" value="{{ $p->id }}">
                                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5"
                                                placeholder="Write your reply here..." name="replies[]">{{ $p->reply }}</textarea>
                                        </div>
                                    </div>
                                @empty
                                            
                                @endforelse
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn bluebg btn-sm">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            <!--modal for reply to return by user ends-->
            @empty
                <p>No returned orders.</p>
           @endforelse
        </tbody>

    </table>
</div>
