@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Orders')

@section('content')

<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Your Orders</li>

    </ol>
  </nav>
  <!-- breadcrumb ends -->


  <section>
    <!-- your orders start -->

    <div id="yourcartheading">
      <div class="siteheading">
        <h6>
          Your Orders
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

      <!-- order delivered -->
      @forelse ($orders as $order)
        <div class="yourordersitem">
            <div class="yourordersitemheader">
                <div class="yourordersitemheaderitem">
                    <p class="mb-0 fw-bold">ORDER @if($order->status !== config('constants.orderStatus.outForDelivery')) {{ strtoupper($order->status) }} @else OUT FOR DELIVERY @endif</p>
                    <p class="mb-0 fw-bold">{{ date('d M, Y', strtotime($order->updated_at)) }}</p>
                </div>
                @if ($order->status == config('constants.orderStatus.cancelled'))
                    <div class="yourordersitemheaderitem">
                        <p class="mb-0">CANCELLED ON</p>
                        <p class="mb-0">{{ date('d M, Y', strtotime($order->updated_at)) }}</p>
                    </div>
                @elseif ($order->status == config('constants.orderStatus.returned'))
                    <div class="yourordersitemheaderitem">
                        <p class="mb-0">RETURNED ON</p>
                        <p class="mb-0">{{ date('d M, Y', strtotime($order->updated_at)) }}</p>
                    </div>
                @elseif ($order->status !== config('constants.orderStatus.delivered'))
                    <div class="yourordersitemheaderitem">
                        <p class="mb-0">ESTIMATED DELIVERY</p>
                        <p class="mb-0">{{ date('d M, Y', strtotime($order->estimatedDate)) }}</p>
                    </div>
                @else
                    <div class="yourordersitemheaderitem">
                        <p class="mb-0">DELIVERED ON</p>
                        <p class="mb-0">{{ date('d M, Y', strtotime($order->delivered_at)) }}</p>
                    </div>
                @endif

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

                <div class="yourordersitemheaderitem1">
                    <a href="{{ route('orders.invoice', $order) }}" class="mb-0 text-primary invoicedownloadlink">
                    <span id="invoicedownloadicon" class="material-icons d-block">
                        file_download
                    </span>
                    <span class="d-block">
                        Invoice
                    </span>
                    </a>
                </div>
            </div>

            <div class="yourordersitembody">
                <div id="yourordersitembody1">
                    <p class="yourordersdelivereddate"><strong>Order Placed {{ date('d M, Y', strtotime($order->created_at)) }}</strong></p>

                    @forelse ($order->orderProducts as $orderproduct)    
                        <div class="yourordersproduct">
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

                </div>
                @can('cancel', $order)
                    <div id="yourordersitembody2">
                        <a href="{{ route('orders.cancel', $order) }}" class="btn btn-outline-danger">Cancel
                        Delivery</a>
                    </div>
                @elsecan('return', $order)
                    <div id="yourordersitembody2">
                        <a href="{{ route('orders.return.create', $order) }}" class="btn btn-outline-danger">Return
                        Items</a>
                        <p class="mb-0 text-secondary verysmall">You can return order within 8 days of delivery date.</p>
                    </div>
                @endcan
            </div>
        </div>
      @empty
          <p>You don't placed any order</p>
      @endforelse

    </div>
    <!-- your orders end -->
  </section>

@endsection