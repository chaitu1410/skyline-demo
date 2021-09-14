<div class="container-fluid">

    <div class="allcontents bg-white p-2 mt-2">

        <!--add product form-->
        <div class="bg-white mt-2 pt-3 p-lg-3">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label small">Category :</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="categoryId">
                            <option selected="selected">Open this select menu</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    {{-- <div class="mb-3 col-md-6">
                        <label class="form-label small">Sub-category :</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="subcategoryId" @if($subcategoryDisabled) disabled @endif>
                            <option selected="selected">Open this select menu</option>
                            @forelse ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div> --}}
                </div>

                <div class="mb-4">
                    <label class="form-label small">Product Name :</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="productId" @if($productDisabled) disabled @endif>
                        <option selected="selected">Open this select menu</option>
                        @forelse ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>

                <hr>
                <div class="mt-4 mb-3 prodvariants">

                    @if ($showContent)
                        <div class="mb-3">
                            <label class="form-label small">Add Product Variants :</label>
                            <a class="btn bluebg btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addvariantmodal">Add New Variant</a>
                        </div>
                        <div class="addedvariantcont small">

                            @forelse ($varients as $varient)
                                @if ($varient->name != 'base')
                                    <div class="addedvariant">
                                        <div data-bs-toggle="modal" data-bs-target="#editvariantmodal{{ $varient->id }}">
                                            {{-- <div class="addedvarname">
                                                <p class="mb-0"><strong>Diameter</strong></p>
                                            </div> --}}
                                            <div class="addedvarprice">
                                                {{-- <p class="mb-1">Value: 0.75mm</p> --}}
                                                <p class="mb-1">MRP: ₹{{ $varient->mrp }}</p>
                                                <p class="mb-1">Discount: {{ $varient->discount }}%</p>
                                                <p class="mb-1">GST: {{ $varient->gst }}%</p>
                                                <p class="mb-1">Selling Price : <strong>₹{{ $varient->sellingPrice }}</strong></p>
                                                @if ($varient->stock)
                                                    <p class="mb-0 text-success"><strong> In Stock</strong></p>
                                                @else
                                                    <p class="mb-0 text-danger"><strong> Out of Stock</strong></p>
                                                @endif
                                            </div>
                                        </div>

                                        <a id="seemorelessbtn" data-bs-toggle="collapse" href="#variantproperties{{ $varient->id }}"
                                                aria-expanded="false" aria-controls="collapseExample">
                                                See More
                                        </a>

                                        <div class="collapse" id="variantproperties{{ $varient->id }}">
                                            <div class="addedvarprops">
                                                @forelse ($varient->properties as $property)
                                                    <p class="mb-1">{{ $property->property }}: {{ $property->value }}</p>
                                                @empty
                                                    <p class="mb-1">No properties are added to this varient</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <!--modal for edit variant starts -->
                                    <div class="modal fade" id="editvariantmodal{{ $varient->id }}" tabindex="-1" aria-labelledby="addvariantmodalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Variant</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.products.updateVarient', [ $productId, $varient->id ]) }}" method="POST">
                                                            @csrf
                                                            @method("PATCH")
                                                            <label class="form-label">Variant Name 1:</label>
                                                            <div class="prodvariantvalues mb-3">
                                                                <div class="valuepriceip valuepriceip2">
                                                                    <input type="text" class="form-control form-control-sm" name="name" value="{{ $varient->name }}">
                                                                </div>


                                                            </div>
                                                            <div class="prodvariantvalues mb-3">

                                                                <div class="valuepriceip">
                                                                    <input type="text" class="form-control form-control-sm" placeholder="MRP" value="{{ $varient->mrp }}" name="mrp">
                                                                </div>

                                                                <div class="valuepriceip">
                                                                    <input type="text" class="form-control form-control-sm" placeholder="Discount" value="{{ $varient->discount }}" name="discount">
                                                                </div>

                                                                <div class="valuepriceip">
                                                                    <input type="text" class="form-control form-control-sm" placeholder="GST" value="{{ $varient->gst }}" name="gst">
                                                                </div>

                                                                <div class="valuepriceip">
                                                                    <input type="text" class="form-control form-control-sm" placeholder="Selling Price" value="{{ $varient->sellingPrice }}" name="sellingPrice">
                                                                </div>
                                                                <div class="valuepriceip">
                                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="stock">
                                                                        <option value="1" @if($varient->stock) selected @endif>In Stock</option>
                                                                        <option value="0" @if(!$varient->stock) selected @endif>Out Of Stock</option>
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            <hr>

                                                            <div class="mb-4 mt-3">
                                                                <label class="form-label">Properties :</label>
                                                                <div class="field_wrapperpn">
                                                                    @forelse ($varient->properties as $property)
                                                                        <div class="mb-3">
                                                                            <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Name" value="{{ $property->property }}"
                                                                            name="properties[]" readonly>
                                                        
                                                                            <input type="text" class="form-control form-control-sm d-inline m-1" placeholder="Property Value" value="{{ $property->value }}"
                                                                            name="values[]">
                                                                        </div>
                                                                    @empty
                                                                        <p class="mb-1">No properties are added to this varient</p>
                                                                    @endforelse
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="prodsubmitbtn">
                                                                <button class="btn btn-sm btn-danger" type="button" wire:click="deleteVarient({{ $varient->id }})">Delete Variant</button>
                                                                <button class="btn btn-sm orangebg" type="submit">Update Variant</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @empty      
                                <p class="mb-1">Varients not available</p>
                            @endforelse
                        </div>
                        <div class="modal fade" id="addvariantmodal" tabindex="-1" aria-labelledby="addvariantmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Variant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.products.storeVarient', $productId) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <label class="form-label">Add Variant :</label>

                                            <div class="field_wrapper1">
                                                <div class="mb-2">
                                                    <div class="mb-1">
                                                        <input type="text" class="form-control form-control-sm m-1" placeholder="Variant Name"
                                                            name="name">

                                                    </div>

                                                    <div class="d-flex variantmorevalues">
                                                        <input type="text" class="form-control form-control-sm m-1" placeholder="MRP"
                                                            name="mrp" id="mrp" onchange="calculate()">
                                                        <input type="text" class="form-control form-control-sm m-1" placeholder="Discount"
                                                            name="discount" id="discount" onchange="calculate()">
                                                        <input type="text" class="form-control form-control-sm m-1" placeholder="GST"
                                                            name="gst" id="gst" onchange="calculate()"> 
                                                        <input type="text" class="form-control form-control-sm m-1" placeholder="Price"
                                                            name="sellingPrice" id="sellingPrice" readonly>
                                                        <select class="form-select form-select-sm m-1" aria-label=".form-select-sm example"
                                                            name="stock">
                                                            <option selected value="1">In Stock</option>
                                                            <option value="0">Out Of Stock</option>
                                                        </select>
                                                    </div>

                                                    @forelse ($baseProperties as $property)
                                                        <div class="prodvariants mt-2 d-flex">

                                                            <input type="text" class="form-control form-control-sm w-50 d-inline m-1"
                                                                placeholder="Property Name" readonly name="properties[]" value="{{ $property->property }}">

                                                            <input type="text" class="form-control form-control-sm w-50 d-inline m-1"
                                                                placeholder="Property Value" name="values[]">

                                                        </div>
                                                    @empty
                                                        
                                                    @endforelse

                                                </div>
                                            </div>

                                            <div class="prodsubmitbtn mt-4">
                                                <button type="submit" class="btn btn-sm orangebg">Save/Add Variant</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!--modal for add variant ends-->
                </div>
                @endif
        </div>
    </div>
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
</div>
