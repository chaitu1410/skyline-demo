@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">

  <div class="allcontents bg-white p-2 mt-2">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumblinks">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
      </ol>
    </nav>



    <!--add product form-->
    <div class="bg-white mt-2 pt-3 p-lg-3">
      <form method="POST" action="{{ route('admin.products.store', $category->id ) }}" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label small">Sub-category :</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="subcategory">
              <option selected value="">None</option>
              @foreach ($subcategories as $subcategory)
                <option @if(old('subcategory') == $subcategory->id) selected @endif value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label small">Select Brand :</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="brand">
              <option selected disabled>Open this select menu</option>
              @foreach ($brands as $brand)
                <option @if(old('brand') == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
              @endforeach
              
            </select>
          </div>

        </div>

        <div class="mb-3">
          <label class="form-label small">Product Name :</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm">
        </div>

        <div class="mb-4 mt-2">
          <label class="form-label small mb-0">Main Product Image :</label>
          <p class="mb-2 mt-0 small text-secondary"><small>(To be displayed on Product Card)</small></p>
          <input type="file" name="image" class="form-control form-control-sm">
        </div>

        <div class="mb-3 input-field">
          <label class="form-label small">Product Images :</label>
          <div class="input-images-1"></div>
        </div>

        <div class="row mt-4">
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">MRP:</label>
            <input type="number" min="0" step="1" id="mrp" name="mrp" onchange="calculate()" value="{{ old('mrp') }}" class="form-control form-control-sm">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">Discount :</label>
            <input type="number" min="0" step=".01" id="discount" name="discount" onchange="calculate()" value="{{ old('discount') }}" class="form-control form-control-sm">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">GST :</label>
            <input type="number" min="0" step=".01" id="gst" name="gst" onchange="calculate()" value="{{ old('gst') }}" class="form-control form-control-sm">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">Selling Price :</label>
            <input type="number" min="0" step="1" id="sellingPrice" name="sellingPrice" value="{{ old('sellingPrice') }}" class="form-control form-control-sm" readonly>
          </div>
          
          <div class="mb-3 mt-3 col-sm-2 col-md-6">
            <label class="form-label small">Product Availability :</label>
            <div class="prodavialverified">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stock" @if(old('stock')) checked @endif id="inlineRadio1"
                  value="1">
                <label class="form-check-label small" for="inlineRadio1">In Stock</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stock" @if(!old('stock')) checked @endif id="inlineRadio2"
                  value="0">
                <label class="form-check-label small" for="inlineRadio2">Out of Stock</label>
              </div>
            </div>
          </div>


          <div class="mb-3 mt-3 col-md-6">
            <label class="form-label small">Skyline Verification :</label>
            <div class="prodavialverified">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="verified" @if(old('verified')) checked @endif id="inlineRadio1"
                  value="1">
                <label class="form-check-label small" for="inlineRadio1">Verified</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="verified" @if(!old('verified')) checked @endif id="inlineRadio2"
                  value="0">
                <label class="form-check-label small" for="inlineRadio2">Not Verified</label>
              </div>
            </div>
          </div>

        </div>


        <div class="row mt-4 mb-4">
          <div class="form-check form-switch col-md-6">
            <input class="form-check-input" type="checkbox" name="topPick" @if(old('toppick')) checked @endif id="flexSwitchCheckDefault">
            <label class="form-check-label small fw-bold" for="flexSwitchCheckDefault">
              Add To Top Picks
            </label>
          </div>

          <div class="col-md-6">
            <label class="form-label small mb-0">Country Of Origin :</label>
            <input type="text" name="countryOfOrigin" value="{{ old('countryOfOrigin') }}" class="mt-2 form-control form-control-sm">
          </div>
        </div>

        <hr>
        <div class="mb-4 mt-4">
          <label class="form-label small">Add Properties :</label>
          <div class="field_wrapperpn">
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Name"
                name="properties[]">

              <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Value"
                name="values[]">

              <a href="javascript:void(0);" class="add_buttonpn" title="Add field">
                <span class="material-icons text-success">
                  add_circle_outline
                </span>
              </a>
            </div>
          </div>
        </div>
        <hr>

        <div class="mb-3">
          <label class="form-label small">Add Product Description :</label>
          <textarea id="editor" name="description" class="small" placeholder="Type here...">{{ old('description') }}</textarea>
        </div>

        <hr>

        <div class="mb-3 col-md-6">
          <label for="formFileSm" class="form-label small">Upload Product Manual</label>
          <input class="form-control form-control-sm" id="formFileSm" type="file" name="manual">
        </div>

        <hr>

        <div class="prodsubmitbtn">
          <button class="btn btn-sm orangebg" type="submit">Save/Add Product</button>
        </div>

      </form>

    </div>

  </div>

</div>
<!-- Page content ends-->

  @push('scripts')
    <script>
      function calculate(){
        var mrp = document.getElementById("mrp").value;
        var gst = document.getElementById("gst").value;
        var discount = document.getElementById("discount").value;
        var sellingPrice = document.getElementById("sellingPrice");

        if(mrp && gst && discount){
          mrp = Number.parseFloat(mrp);
          gst = Number.parseFloat(gst);
          discount = Number.parseFloat(discount);
          var gstAmount = (gst * mrp) / 100;
          var discountAmount = (discount * mrp) / 100;
          sellingPrice.value = (mrp + gstAmount) - discountAmount;
        }
      }
      
    </script>
  @endpush
  @endsection