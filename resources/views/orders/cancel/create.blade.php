@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Orders')

@section('content')

    <!-- breadcrumb start -->
    <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cancel Your Order</li>

        </ol>
    </nav>
    <!-- breadcrumb ends -->

    <style>
        .cancelorderitem {
        width: 80%;
        padding: 1rem;
        border: 1px solid rgb(226, 226, 226);

        margin: 2%;
        padding-right: 1rem;
        }

        .cancelallproductsbtn {
        width: 100%;
        padding: 1rem;
        text-align: center;
        padding-top: 0rem;
        }

        .cancelallproductsbtn button {
        padding: 0.5rem 2rem;
        }


        .cancelorderproductitem1 {
        border: none;
        }

    
        .singleproductcancel {
        padding-bottom: 2rem;
        }

        /* return products */
        .seereturnpolicylink {
        color: var(--blue);

        }

        .seereturnpolicylink:hover {
        color: var(--blue);
        text-decoration: underline var(--blue);
        }

        .returnorderitemshead {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0.5rem;
        }

        /* Smartphones ----------- */
        @media only screen and (min-device-width: 200px) and (max-device-width: 500px) {
        .cancelorderitem {
            width: 96%;
            padding-right: 0rem;
            padding-left: 0rem;
            margin: 2%;
            padding-top: 0rem;

        }

        .cancelorderproductitem1 {
            padding-right: 0.7rem;
        }

        .cancelreasoncont {
            padding: 0.5rem;

        }

        .singleproductcancel {
            border-bottom: 1px solid rgb(223, 223, 223);
            padding-bottom: 2rem;
            margin-bottom: 1.5rem;
        }
        }
    </style>


    <!-- cancel order items starts -->
    <section>
        <div id="cancelordercontainer">
            <div class="cancelorderitem">
                <form action="{{ route('orders.cancelPost', $order) }}" method="post">
                    @csrf
                    <div class="returnorderitemshead">
                        <p class="yourordersdelivereddate"><strong>Order Placed {{ date('d M, Y', strtotime($order->created_at)) }}</strong></p>
                        <a class="small seereturnpolicylink" data-bs-toggle="modal" data-bs-target="#returnpolicymodal">
                            Return Policy
                        </a>
                    </div>
    
                    <div class="mt-4 mb-3">
                        @forelse ($order->orderProducts as $orderproduct)  
                            <div class="yourordersproduct w-100 cancelorderproductitem1">
                                <div class="yourordersproductimg">
                                    <img src="{{ asset('images/'.$orderproduct->product->image) }}" alt="">
                                </div>

                                <div class="yourordersproductinfo">
                                    <p class="mb-0 yourordersprodname">{{ $orderproduct->product->name }}</p>
                                    <p class="mb-2 text-secondary yourordersprodname small">Variant : {{ $orderproduct->varient->name }}</p>
                                    <p class="mb-2 text-secondary small">Qty: {{ $orderproduct->quantity }}</p>
                                    @if ($orderproduct->returned)
                                        <p class="mb-2 text-danger small">This product is returned</p>
                                    @endif
                                    <button class="btn bluebg mb-3" onclick="location.href='{{ route('products.show', $orderproduct->product) }}'">Buy Again</button>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
    
                        <div class="cancelreasoncont mt-3">
                            <div>
                                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5"
                                    placeholder="Write detailed reason to cancel this order" name="reason"></textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="cancelallproductsbtn">
                        <button class="btn btn-sm btn-danger" type="submit">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>


    </section>
    <!-- cancel order items ends -->


    <!-- return policy modal starts -->
    <section>
        <div class="modal fade" id="returnpolicymodal" tabindex="-1" aria-labelledby="returnpolicymodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Return Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="privacypolicytext" class="modal-body">
                <p class="fw-bold">OUR RETURN POLICY: IT’S REALLY SIMPLE!</p>
                <p>The Customer should verify the Product upon its receipt.</p>
                <p>We assure you of free replacement or repairs in case of any manufacturing defect in the
                performance of
                the standard products purchased from us within 8 days of receipt of material at your end.
                </p>
                <p>Kindly email our Customer Care team at info@skylinegroup.co.in or call us at 0240-2556133, if
                case of any
                questions or queries for timely resolution.</p>

                <table class="table table-bordered mt-3">

                <tr>
                    <td class="fw-bold small">REASON OF RETURN</td>
                    <td class="fw-bold small">RESOLUTION</td>
                </tr>

                <tr>
                    <td>Was delivered in a physically damaged condition</td>
                    <td>Free Replacement</td>
                </tr>

                <tr>
                    <td>Has missing parts or accessories</td>
                    <td>Delivery of Missing parts/ Free Replacement</td>
                </tr>

                <tr>
                    <td>Is different from what was ordered</td>
                    <td>Delivery of material originally ordered</td>
                </tr>

                <tr>
                    <td>Is no longer needed (subject to acceptance by us)</td>
                    <td>Refund subject to valid reason of return</td>
                </tr>

                </table>

                <p class="fw-bold">Resolution in various cases is given below:</p>
                <p>If the fault is on us (mixed up, faulty on arrival), we’ll of course pay for return shipping.
                </p>
                <p>As soon as the return or exchange has cleared it’s inspection, you will be notified of your
                exchange or
                credit immediately.</p>

                <p class="fw-bold">How to Return? Kindly raise a return & service request within 15 days of
                material
                delivery. Next Steps:</p>

                <p>
                <ul>
                <li>INFORM US</li>
                <li>PREPARE PACKAGE</li>
                <li>SEND THE PACKAGE</li>
                <li>WE RECEIVE THE PACKAGE</li>
                <li>REPLACEMENT OR REPAIR WITHIN 7 DAYS</li>
                <li>INFORM US</li>
                </ul>
                </p>

            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- return policy modal ends -->

@endsection