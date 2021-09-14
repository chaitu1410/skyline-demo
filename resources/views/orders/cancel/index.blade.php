@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Orders')

@section('content')

    <!-- breadcrumb start -->
    <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Your Returns</li>
        </ol>
    </nav>
    <!-- breadcrumb ends -->

    <style>
        .seemorereply {
            color: var(--blue);
            font-size: 13px;
            margin-left: 1rem;
            text-decoration: underline var(--blue);
        }

        .seemorereply:hover {
            color: var(--blue);
            text-decoration: underline var(--blue);
        }
    </style>
    <section>
        <!-- your orders start -->

        <div id="yourcartheading">
            <div class="siteheading">
                <h6>
                    Your Cancelled Orders
                </h6>
            </div>
            <div class="headingunderline"></div>
        </div>

        <div id="assistanthelpsection">
            <div class="assistanthelpitem">
                <div>
                    <img id="assistanthelpimg" src="{{ asset('assets/images/assistant.png') }}" alt="">
                </div>
                <div>
                    <button class="btn bluebg">Request Bulk Quote Now</button>

                </div>
            </div>
            <div class="assistanthelpitem">
                <img src="{{ asset('assets/images/approved.png') }}" alt="">
            </div>
        </div>


        <div id="yourorderscont">

            @forelse ($orders as $order)
                <div class="yourordersitem">
                    <div class="yourordersitemheader">
                        <div class="yourordersitemheaderitem">
                            <p class="mb-0 fw-bold">ORDER PLACED</p>
                            <p class="mb-0 fw-bold">{{ date('d M, Y', strtotime($order->created_at)) }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">TOTAL</p>
                            <p class="mb-0">₹{{ $order->orderDetail->payableAmount }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">SHIP TO</p>
                            <p class="mb-0 text-primary">{{ $order->orderDetail->customerName }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">ORDER ID</p>
                            <p class="mb-0"># {{ $order->id }}</p>
                        </div>

                    </div>
                    <div class="p-3">
                        <div>
                            <p class="yourordersdelivereddate"><strong>Order Cancelled on {{ date('d M, Y', strtotime($order->updated_at)) }}<small> by @if($order->cancelledOrder->cancelledBy == config('constants.userType.user')) You @else Skyline Admin @endif</small></strong></p>

                            @forelse ($order->orderProducts as $orderproduct)    
                                <div class="yourordersproduct">
                                    <div class="yourordersproductimg">
                                        <img src="{{ asset('images/'.$orderproduct->product->image) }}" alt="">
                                    </div>

                                    <div class="yourordersproductinfo">
                                        <p class="mb-0 yourordersprodname">{{ $orderproduct->product->name }}</p>
                                        <p class="mb-1 text-secondary small">Qty: {{ $orderproduct->quantity }}</p>
                                        <p class="mb-1 text-secondary small">Variant: {{ $orderproduct->varient->name }}</p>
                                        <p class="mb-0 fw-bold text-success">₹{{ $orderproduct->product->sellingPrice }}</p>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse
                        </div>

                    </div>
                    {{$order->cancelledOrder->cancelledBy}}
                    @if ($order->cancelledOrder->cancelledBy == config('constants.userType.user'))
                        <div class="mb-3 p-3">
                            <div class="mb-3">
                                <label class="form-label small">Your reason to cancel order :</label>
                                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="7"
                                    disabled>{{ $order->cancelledOrder->reason }}</textarea>
                            </div>
                            @if ($order->cancelledOrder->reply)
                                <div class="mb-3">
                                    <label class="form-label small">Skyline's Reply :</label>
                                    <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="7"
                                        disabled>{{ $order->cancelledOrder->reply }}</textarea>
                                </div>
                            @else
                                <p>Skyline admin not replied yet</p>
                            @endif
                            
                        </div>
                    @else
                        <div class="mb-3 p-3">
                            <div class="mb-3">
                                <label class="form-label small">Skyline's Reply :</label>
                                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="7"
                                    disabled>{{ $order->cancelledOrder->reason }}</textarea>
                            </div>
                        </div>
                    @endif

                </div>
            @empty
                
            @endforelse
            <!-- order returned ends
        </div>
        <!-- your orders end -->
    </section>


@endsection