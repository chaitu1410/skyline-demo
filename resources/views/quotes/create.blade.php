@extends('layouts.main', ['header' => 'small', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Request Bulk Quote')

@section('content')
<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Request Bulk Quote</li>

    </ol>
  </nav>
  <!-- breadcrumb ends -->

  <!-- bulk quote starts -->
  <section>
    <div id="bulkquoteform">
      <h4 class="mb-5 text-center">
        Request For Quote
      </h4>
      <form class="row g-3" method="POST" action="{{ route('quotes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Company</label>
          <input type="text" name="company" class="form-control" id="input1" value="{{ old('company') }}">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" id="input2" value="{{ old('name') }}">
        </div>

        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email Id</label>
          <input type="email" name="email" class="form-control" id="input3" value="{{ old('email') }}">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Mobile No.</label>
          <input type="text" name="mobile" class="form-control" id="input4" value="{{ old('mobile') }}">
        </div>

        <div class="col-12">
          <label for="exampleFormControlTextarea1" class="form-label">Describe Your Buying Requirement &
            Qty.</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="requirements">{{ old('requirements') }}</textarea>
        </div>


        <div class="col-md-3">
          <label for="inputCity" class="form-label">Zip/Pin Code</label>
          <input type="text" name="pincode" class="form-control" id="inputCity" value="{{ old('pincode') }}">
        </div>

        <div class="col-md-3">
          <label for="inputCity" class="form-label">City</label>
          <input type="text" name="city" class="form-control" id="inputCity" value="{{ old('city') }}">
        </div>

        <div class="col-md-6">
          <label for="formFile" class="form-label">File Upload</label>
          <input class="form-control" name="clientRequirement" type="file" id="formFile">
        </div>

        <div class="col-12">
          <button type="submit" class="btn">Send Enquiry</button>
        </div>

        <div class="col-12 bulkquotecontacts">
          <p onclick="location.href='tel:9765499823'" class="mb-1">
            <span class="material-icons">
              call
            </span> <span>+91 9765499823</span>
          </p>
          <p onclick="location.href='mailto:sales@skylinegroup.co.in'" class="mb-1">
            <span class="material-icons">
              mail_outline
              </span> <span>sales@skylinegroup.co.in</span>
          </p>
        </div>
      </form>
    </div>
  </section>
  <!-- bulk quote ends -->

  @endsection