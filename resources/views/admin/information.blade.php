@extends('admin.layouts.main')

@section('content')
    <!-- Page content-->
    <div class="container-fluid">

        <div class="allcontents bg-white p-2 mt-2">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumblinks">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Information</li>
                </ol>
            </nav>



            <!--add product form-->
            <div class="bg-white mt-2 pt-3 p-lg-3">
                <form method="POST" action="{{ route('admin.update') }}" name="form-example-1" id="form-example-1">
                    @csrf
                    @method('PATCH')
                  
                    <p class="fw-bold mb-0 small mb-3 mt-4">Contact Numbers :</p>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Customer Support</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('customerSupportContact') ?? $details->CutomerSupportContactNumber }}" name="customerSupportContact">
                        </div>
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Sales and Bulk Quote</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('salesContact') ?? $details->SalesContactNumber }}" name="salesContact">
                        </div>
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Any Other Query</label>
                            <input type="text" class="form-control form-control-sm"
                            value="{{ old('otherQueryContact') ?? $details->OtherQueryContactNumber }}" name="otherQueryContact">
                        </div>
                    </div>

                    <hr>

                    <p class="fw-bold mb-0 small mb-3 mt-4">Email ID :</p>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Customer Support</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('costomerSupportEmail') ?? $details->CutomerSupportEmail }}" name="costomerSupportEmail">
                        </div>
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Sales and Bulk Quote</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('salesEmail') ?? $details->SalesEmail }}" name="salesEmail">
                        </div>
                        <div class="mb-3 col-md-4 col-lg-4">
                            <label class="form-label small">Any Other Query</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ old('otherQueryEmail') ?? $details->OtherQueryEmail }}" name="otherQueryEmail">
                        </div>
                    </div>
                    <hr>

                
                    <p class="fw-bold mb-0 small mb-3 mt-4">Office Address :</p>
                    <div class="mb-3">
                       
                        <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="8" name="officeAddress">{{ old('officeAddress') ?? $details->OfficeAddress }}</textarea>
                    </div>

                    <div class="prodsubmitbtn mt-4">
                        <button class="btn btn-sm orangebg" type="submit">Update Information</button>
                    </div>

                </form>



            </div>


        </div>




    </div>
    <!-- Page content ends-->
@endsection