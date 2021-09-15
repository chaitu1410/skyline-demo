@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Orders')

@section('content')

<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Place Order</li>

    </ol>
</nav>
<!-- breadcrumb ends -->


<style>
    .yourorderplacecontainer {
        padding-bottom: 1rem;
    }

    .orderplaceshippingto {
        width: 100%;
        overflow: hidden;
        white-space: pre-wrap;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .orderplaceshipaddress {
        border-bottom: 1px solid rgb(226, 226, 226);
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .orderplacecosts {
        display: flex;
        justify-content: space-between;
    }

  
</style>

<section>
    <!-- shopping cart start -->

    <div id="yourcartheading">
        <div class="siteheading">
            <h6>
                Order Now
            </h6>
        </div>
        <div class="headingunderline"></div>

    </div>

    <div class="yourcartcontainers yourorderplacecontainer">

        <div id="yourcartsubtotal">

            <div class="yourcartsubtotalhead">

                <div class="orderplaceshipaddress">
                    <p class="mb-1 text-secondary small orderplaceshippingto">Shipping to : <strong
                            class="text-dark">{{ Auth::user()->name }}</strong>
                    </p>


                    <p class="mb-1 text-secondary small">Delivery In : <strong class="text-success">2-3
                            Weeks</strong>
                    </p>


                </div>

                <div class="orderplacetotal">
                    <p class="orderplacecosts small">
                        <span>Items :</span>
                        <span>₹{{ $order->orderDetail->amount }}</span>
                    </p>

                    <p class="orderplacecosts small">
                        <span>GST :</span>
                        <span>₹{{ $order->orderDetail->totalGst }}</span>
                    </p>

                    
                    
                    <p class="orderplacecosts small">
                        <span>Total :</span>
                        <span>₹{{ $order->orderDetail->amount + $order->orderDetail->totalGst }}</span>
                    </p>
                    
                    <p class="orderplacecosts small">
                        <span>Discount :</span>
                        <span>- ₹{{ $order->orderDetail->totalDiscount }}</span>
                    </p>
                    
                    <p class="orderplacecosts small">
                        <span>Delivery Charge :</span>
                        <span>{{ $order->orderDetail->deliveryCharge }}</span>
                    </p>
  
                    <p class="orderplacecosts small">
                        <strong>Order Total :</strong>
                        <strong class="text-danger">₹{{ $order->orderDetail->payableAmount }}</strong>
                    </p>

                </div>

            </div>

        </div>


        <div id="yourcartitems" class="allorderitems">

            @foreach ($order->orderProducts as $product) 
                <div class="yourcartitem">
                    <div class="yourordersproductimg">
                        <img src="{{ asset('images/'.$product->product->image) }}" alt="">
                    </div>

                    <div class="yourordersproductinfo">
                        <p class="mb-2 yourordersprodname">{{ $product->product->name }}</p>
                        <p class="mb-2 text-secondary small">Qty: {{ $product->quantity }}</p>
                        <p class="mb-0 fw-bold text-success">₹{{ $product->varient->sellingPrice }}</p>

                    </div>
                </div>
            @endforeach

            
            </div>
        </div>
    </div>
    <!-- shopping cart end -->

    <!-- confirm details form starts-->
    <div class="registeruserform youraccountform mt-0 mb-4">
        <h4 class="mb-4 text-center">
            Confirm Your Details
        </h4>
            <div class="youraccountformparts">
                <div class="youraccountformpartsdiv">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Full Name<span
                                class="mandatoryfield">*</span>
                        </label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $order->orderDetail->customerName }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Mobile Number 1<span
                                class="mandatoryfield">*</span>
                        </label>
                        <input type="text" name="mobile" class="form-control" id="exampleFormControlInput2" value="{{ $order->orderDetail->customerContact }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Mobile Number 2
                        </label>
                        <input type="text" name="mobile2" class="form-control" id="exampleFormControlInput3" value="{{ $order->orderDetail->customerContact2 }}">
                    </div>
                   
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">GST Number
                        </label>
                        <input type="text" name="gst" class="form-control" id="exampleFormControlInput3" value="{{ $order->orderDetail->gst }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Trade/Company Name
                        </label>
                        <input type="text" name="company" class="form-control" id="exampleFormControlInput3" value="{{ $order->orderDetail->company }}">
                    </div>
                   
                    

                </div>

                <div class="youraccountformpartsdiv">
                    <div class="mb-3">
                        <label for="exampleFormControlInput6" class="form-label">Address</label>
                        <input type="text" name="pincode" class="form-control mb-3" id="exampleFormControlInput4"
                           value="{{ $order->orderDetail->pincode }}" placeholder="Pincode">

                        <input type="text" name="town" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ $order->orderDetail->town }}" placeholder="Town/City">

                        <input type="text" name="area" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ $order->orderDetail->area }}" placeholder="Area, Colony, Street, Sector, Village">

                        <input type="text" name="houseNumber" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ $order->orderDetail->houseNumber }}" placeholder="Flat, House no, Building, Company, Apartment">

                        <input type="text" name="landmark" class="form-control mb-3 mb-lg-3" id="exampleFormControlInput4"
                        value="{{ $order->orderDetail->landmark }}" placeholder="Landmark eg. near Max Hospital">

                    </div>


                </div>
            </div>

            <div class="container text-center">
                <form action="{{ route('orders.pay') }}" method="post">
            
                <script 
                    src="https://checkout.razorpay.com/v1/checkout.js"
                     data-key= "rzp_test_6MWDVR7We3RUcY",       
                    data-amount= "{{ $order->orderDetail->payableAmount }}", 
                    data-currency= "INR",
                    data-order_id= "{{ $order->razorpayOrderId }}"
                    data-buttontext="Pay with Razorpay"
                    data-name= "skyline",
                    data-description= "Test Transaction",
                    data-theme.color="#F37254"
                    ></script>

                     <input type="hidden" custom="Hidden Element" name="hidden" >
                </form>

        {{-- <form action="\" method="post">
            <div class="registerloginbtn mb-2">
                <button class="btn bg-orange w-100" type="submit">Place Your Order and Pay</button>
            </div>
        </form> --}}
    </div>
    <!-- confirm details form ends -->
</section>


@endsection