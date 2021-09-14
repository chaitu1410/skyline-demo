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
    <div class="registeruserform youraccountform mt-0 mb-4">
        <h4 class="mb-4 text-center">
            Confirm Your Details
        </h4>

        <form action="{{ route('orders.placeOrder') }}" method="POST">
            @csrf
            <div class="youraccountformparts">
                <div class="youraccountformpartsdiv">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Full Name<span
                                class="mandatoryfield">*</span>
                        </label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ old('name') ?? Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Mobile Number 1<span
                                class="mandatoryfield">*</span>
                        </label>
                        <input type="text" name="mobile" class="form-control" id="exampleFormControlInput2" value="{{ old('mobile') ?? Auth::user()->mobile }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Mobile Number 2
                        </label>
                        <input type="text" name="mobile2" class="form-control" id="exampleFormControlInput3" value="{{ old('mobile2') ?? Auth::user()->mobile2 }}">
                    </div>
                   
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">GST Number
                        </label>
                        <input type="text" name="gst" class="form-control" id="exampleFormControlInput3" value="{{ old('gst') ?? Auth::user()->gstNumber }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Trade/Company Name
                        </label>
                        <input type="text" name="company" class="form-control" id="exampleFormControlInput3" value="{{ old('company') ?? Auth::user()->company }}">
                    </div>
                   
                    

                </div>

                <div class="youraccountformpartsdiv">
                    <div class="mb-3">
                        <label for="exampleFormControlInput6" class="form-label">Address</label>
                        <input type="text" name="pincode" class="form-control mb-3" id="exampleFormControlInput4"
                           value="{{ old('pincode') ?? $address->pincode }}" placeholder="Pincode">

                        <input type="text" name="town" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ old('town') ?? $address->town }}" placeholder="Town/City">

                        <input type="text" name="area" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ old('area') ?? $address->area }}" placeholder="Area, Colony, Street, Sector, Village">

                        <input type="text" name="houseNumber" class="form-control mb-3" id="exampleFormControlInput4"
                        value="{{ old('houseNumber') ?? $address->houseNumber }}" placeholder="Flat, House no, Building, Company, Apartment">

                        <input type="text" name="landmark" class="form-control mb-3 mb-lg-3" id="exampleFormControlInput4"
                        value="{{ old('landmark') ?? $address->landmark }}" placeholder="Landmark eg. near Max Hospital">

                    </div>


                </div>
            </div>

            <div class="registerloginbtn mb-2">
                <button class="btn bg-orange w-100" type="submit">Next</button>
            </div>

        </form>
    </div>
    <!-- confirm details form ends -->
</section>


@endsection