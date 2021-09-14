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
                    Your Returned
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

            @forelse ($returnedorders as $returnorder)
                <!-- order returned -->
                <div class="yourordersitem">
                    <div class="yourordersitemheader">
                        <div class="yourordersitemheaderitem">
                            <p class="mb-0 fw-bold">ORDER DELIVERED</p>
                            <p class="mb-0 fw-bold">{{ date('d M, Y', strtotime($returnorder->order->delivered_at)) }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">TOTAL</p>
                            <p class="mb-0">₹{{ $returnorder->returnAmount }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">SHIP TO</p>
                            <p class="mb-0 text-primary">{{ $returnorder->order->orderDetail->customerName }}</p>
                        </div>

                        <div class="yourordersitemheaderitem">
                            <p class="mb-0">ORDER ID</p>
                            <p class="mb-0"># {{ $returnorder->id }}</p>
                        </div>

                    </div>
                    <div class="p-3">
                        <div>
                            <p class="yourordersdelivereddate"><strong>Order Returned on {{ date('d M, Y', strtotime($returnorder->created_at)) }}</strong></p>


                            @forelse ($returnorder->returnOrderProducts as $returnorderproduct)
                                <div>
                                    <div class="yourordersproduct">
                                        <div class="yourordersproductimg">
                                            <img src="{{ asset('images/'.$returnorderproduct->orderProduct->product->image) }}" alt="">
                                        </div>
            
                                        <div class="yourordersproductinfo">
                                            <p class="mb-0 yourordersprodname">{{ $returnorderproduct->orderProduct->product->name }}</p>
                                            <p class="mb-1 text-secondary small">Qty: {{ $returnorderproduct->orderProduct->quantity }}</p>
                                            <p class="mb-1 text-secondary small">Variant: {{ $returnorderproduct->orderProduct->varient->name }}</p>
                                            <p class="mb-0 fw-bold text-success">₹{{ $returnorderproduct->orderProduct->varient->sellingPrice }}</p>
            
                                        </div>
                                    </div>
                                    <div class="mb-4 mt-3">
                                        <div class="mb-3">
                                            <label class="form-label small">Your reason to return this product :</label>
                    
                                            <input type="text" class="form-control form-control-sm mb-2" id="exampleFormControlInput2"
                                                value="{{ $returnorderproduct->reason }}" disabled>
                    
                                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="4"
                                                disabled>{{ $returnorderproduct->detailedReason }}</textarea>
                                        </div>
                                        @if ($returnorderproduct->reply)
                                            <div class="mb-3">
                                                <label class="form-label small">Skyline's Reply :</label>
                                                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="4"
                                                    disabled>{{ $returnorderproduct->reply }}</textarea>
                                            </div>
                                        @else
                                            <p>Skyline admin not replied yet</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
            <!-- order returned ends
        </div>
        <!-- your orders end -->
    </section>


@endsection