@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Account')

@section('content')

<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Your Account</li>

    </ol>
  </nav>
  <!-- breadcrumb ends -->


  <!-- register form start -->
  <div class="registeruserform youraccountform mt-0 mb-4">
    <h4 class="mb-4 text-center">
      Your Account
    </h4>

    <form action="{{ route('users.update', $user) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="youraccountformparts">
        <div class="youraccountformpartsdiv">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">User Name<span class="mandatoryfield">*</span>
            </label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}">
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Mobile Number 1<span
                class="mandatoryfield">*</span>
            </label>
            <input type="text" name="mobile" class="form-control" id="exampleFormControlInput2" value="{{ $user->mobile }}" readonly>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Mobile Number 2
            </label>
            <input type="text" name="mobile2" class="form-control" id="exampleFormControlInput3" value="{{ $user->mobile2 }}">
          </div>

          <div class="mb-4">
            <label for="exampleFormControlInput4" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput4" value="{{ $user->email }}" readonly>
          </div>

          <div class="mt-4">
            <label for="exampleFormControlInput6" class="form-label">GST Information</label>
            <input type="text" name="gst" class="form-control mb-2 mb-lg-3" id="exampleFormControlInput6" placeholder="GST Number" value="{{ $user->gstNumber }}">
            <input type="text" name="company" class="form-control mb-2 mb-lg-3" id="exampleFormControlInput6" placeholder="Trade/Company Name" value="{{ $user->company }}">
          </div>

        </div>

        <div class="youraccountformpartsdiv">
          <div class="mb-3">
            <label for="exampleFormControlInput6" class="form-label">Address</label>
            <input type="text" name="pincode" class="form-control mb-2" id="exampleFormControlInput4" placeholder="Pincode" value="{{ $address->pincode }}">

            <input type="text" name="town" class="form-control mb-2" id="exampleFormControlInput4" placeholder="Town/City" value="{{ $address->town }}">

            <input type="text" name="area" class="form-control mb-2" id="exampleFormControlInput4" placeholder="Area, Colony, Street, Sector, Village" name="{{ $address->area }}">

            <input type="text" name="houseNumber" class="form-control mb-2" id="exampleFormControlInput4" placeholder="Flat, House no, Building, Company, Apartment" name="{{ $address->houseNumber }}">

            <input type="text" name="landmark" class="form-control mb-2 mb-lg-3" id="exampleFormControlInput4" placeholder="Landmark eg. near Max Hospital" name="{{ $address->landmark }}">

          </div>

          <div class="mb-3 insightsaccount mt-4">

            <div class="insightbox">
              <div class="count">
                <p class="mb-0">100</p>
              </div>
              <div class="insighttxt">
                <p class="mb-0">Your Orders</p>
              </div>
            </div>

            <div class="insightbox">
              <div class="count">
                <p class="mb-0">{{ Cart::session(Auth::id())->getTotalQuantity() }}</p>
              </div>
              <div class="insighttxt">
                <p class="mb-0">Your Cart</p>
              </div>
            </div>

            <div class="insightbox">
              <div class="count">
                <p class="mb-0">2</p>
              </div>
              <div class="insighttxt">
                <p class="mb-0">Quote Requests</p>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="registerloginbtn mb-2">
        <button class="btn w-100" type="submit">Update</button>
      </div>

    </form>
  </div>
  <!-- register form ends -->

@endsection