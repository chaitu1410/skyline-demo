@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">

  <div class="allcontents bg-white p-2 mt-2">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumblinks">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
      </ol>
    </nav>



    <!--add product form-->
    <div class="bg-white mt-2 pt-3 p-lg-3">
      <form action="{{ route('admin.products.update', $product->id) }}" method="POST" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label small">Sub-category :</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="subcategory">
              <option selected value="">None</option>
              @foreach ($subcategories as $subcategory)
                <option @if($product->subcategory_id == $subcategory->id) selected @endif value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label small">Select Brand :</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="brand">
              <option selected disabled>Open this select menu</option>
              @foreach ($brands as $brand)
                <option @if($product->brand_id == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
              @endforeach
              
            </select>
          </div>

        </div>

        <div class="mb-3">
          <label class="form-label small">Product Name :</label>
          <input type="text" name="name" class="form-control form-control-sm"
            value="{{ $product->name }}">
        </div>

        <style>
          .uploadmainimg {
            display: flex;
          }

          .alreadyuploadedimg {
            display: inline-block;
            border: 1px solid lightgrey;
            padding: 0.7rem;
          }

          .mainproductupload {
            margin-left: 1rem;
          }

          .alreadyuploadedimg img {
            width: 6rem;
          }
        </style>
        <hr>
        <div class="mb-4 mt-2 uploadmainimg">

          
          <div class="alreadyuploadedimg">
            <img src="{{ asset('images/'.$product->image) }}" alt="{{$product->name}}">
          </div>


          <div class="col mainproductupload">
            <label class="form-label small mb-0">Main Product Image :</label>
            <p class="mb-2 mt-0 small text-secondary"><small>(Previously uploaded image will be replaced with this image)</small></p>
            <input type="file" name="image" class="form-control form-control-sm">
          </div>
        </div>
        <hr>


        <div class="mb-3 input-field">
          <label class="form-label small">Product Images :</label>
          <p class="mb-2 mt-0 small text-secondary"><small>(Previously uploaded all images will be replaced with this images.)</small></p>
          <div class="input-images-1"></div>
        </div>

        <div class="row mt-4">
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">MRP:</label>
            <input type="text" name="mrp" min="0" step="1" id="mrp" onchange="calculate()" class="form-control form-control-sm" value="{{ $product->mrp }}">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">Discount :</label>
            <input type="text" name="discount" min="0" step=".01" id="discount" onchange="calculate()" class="form-control form-control-sm" value="{{ $product->discount }}">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">GST :</label>
            <input type="text" name="gst" min="0" step=".01" id="gst" onchange="calculate()" class="form-control form-control-sm" value="{{ $product->gst }}">
          </div>
          <div class="mb-3 col-md-6 col-lg-3">
            <label class="form-label small">Selling Price :</label>
            <input type="text" name="sellingPrice" min="0" step="1" id="sellingPrice" class="form-control form-control-sm" value="{{ $product->sellingPrice }}" readonly>
          </div>

          <div class="mb-3 mt-3 col-sm-2 col-md-6">
            <label class="form-label small">Product Availability :</label>
            <div class="prodavialverified">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stock" id="inlineRadio1"
                  value="1" @if($product->stock) checked @endif>
                <label class="form-check-label small" for="inlineRadio1">In Stock</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stock" id="inlineRadio2"
                  value="0" @if(!$product->stock) checked @endif>
                <label class="form-check-label small" for="inlineRadio2">Out of Stock</label>
              </div>
            </div>
          </div>


          <div class="mb-3 mt-3 col-md-6">
            <label class="form-label small">Skyline Verification :</label>
            <div class="prodavialverified">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="verified" id="inlineRadio1"
                  value="1" @if($product->verified) checked @endif>
                <label class="form-check-label small" for="inlineRadio1">Verified</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="verified" id="inlineRadio2"
                  value="0" @if(!$product->verified) checked @endif>
                <label class="form-check-label small" for="inlineRadio2">Not Verified</label>
              </div>
            </div>
          </div>


        </div>

        <div class="row mt-4 mb-4">
          <div class="form-check form-switch col-md-6">
            <input class="form-check-input" type="checkbox" name="topPick" @if($product->topPick) checked @endif id="flexSwitchCheckDefault">
            <label class="form-check-label small fw-bold" for="flexSwitchCheckDefault">
              Add To Top Picks
            </label>
          </div>

          <div class="col-md-6">
            <label class="form-label small mb-0">Country Of Origin :</label>
            <input type="text" name="countryOfOrigin" value="{{ $product->countryOfOrigin }}" class="mt-2 form-control form-control-sm">
          </div>
        </div>

        <hr>
        <div class="mb-4 mt-4">
          <label class="form-label small">Add Properties :</label>
          <div class="field_wrapperpn">
            @forelse ($properties as $property)
              <div class="mb-3">
                <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Name"
                  value="{{ $property->property }}" readonly name="properties[]">

                <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Value"
                  value="{{ $property->value }}" name="values[]">
              </div>
            @empty
                
            @endforelse
          </div>
        </div>


        <hr>

        <div class="mb-3">
          <label class="form-label small">Add Product Description :</label>
          <textarea id="editor" name="description" class="small" placeholder="Type here...">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3 col-md-6">
          <label for="formFileSm" class="form-label small">Upload Product Manual</label>
          <p class="mb-2 mt-0 small text-secondary"><small>(Previously uploaded manual will be replaced with this manual)</small></p>
          <input class="form-control form-control-sm" id="formFileSm" type="file" name="manual">
        </div>

        <hr>

        <div class="prodsubmitbtn">
          <button class="btn btn-sm orangebg" type="submit">Update Product</button>
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