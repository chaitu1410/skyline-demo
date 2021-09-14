<section>
    <div class="siteheading">
        <h6>
            Best Seller Categories
        </h6>
    </div>
    <div class="headingunderline"></div>
    <div id="catvisetabs">
        <ul class="nav nav-tabs" id="tabcategory" role="tablist">
            @forelse ($categories as $cat)
                <li class="nav-item" role="presentation">
                    <button class="nav-link categorytabhead @if($category->id === $cat->id) active @endif" type="button" role="tab" aria-controls="cat1" aria-selected="true" wire:click="setCategory({{ $cat->id }})">{{ $cat->name }}</button>
                </li>
            @empty
                
            @endforelse
        </ul>
    </div>

    <div class="tab-content" id="proTabContent">

        <div class="tab-pane fade show active" id="cat1" role="tabpanel" aria-labelledby="home-tab">
            <div class="productscategorytabcont">

                @if ($category)
                    @forelse ($category->products as $product)
                        <div class="procard card">
                            <h1 class="discount">{{ $product->discount }}%</h1>
                            <div class="prod-img">
                                <img src="{{ asset('images/'.$product->image) }}" class="" alt="{{ $product->name }}" onclick="location.href='{{ route('products.show', $product) }}'">
                                <div class="onhoverdetails">
                                    <button class="btn quickviewbtn" data-bs-toggle="modal" data-bs-target="#quickviewproductmodal{{ $product->id }}">Quick View</button>
                                </div>
                            </div>

                            <div class="productdetails" onclick="location.href='{{ route('products.show', $product) }}'">
                            <a href="{{ route('products.show', $product) }}">
                                <p class="prodname">{{ $product->name }}</p>
                            </a>
                            <img src="{{ asset('images/'.$product->brand->image) }}" alt="{{ $product->brand->name }}">
                            <p class="mb-0 text-success prodprice"><span class="cutprice text-danger">₹{{ $product->mrp }} </span> ₹{{ $product->sellingPrice }} </p>
                            </div>
                        </div>

                        <div class="modal fade" id="quickviewproductmodal{{ $product->id }}" tabindex="-1" aria-labelledby="quickviewproductmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="modalprodimg">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('images/'.$product->image) }}" class="d-block" alt="{{ $product->name }}">
                                        </div>
                                        @forelse ($product->productImages as $image)
                                            <div class="carousel-item active">
                                                <img src="{{ asset('images/'.$image->image) }}" class="d-block" alt="{{ $product->name }}">
                                            </div>
                                        @empty
                                            
                                        @endforelse
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon prevnexticonmodal" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon prevnexticonmodal" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    </div>
                                </div>
                                <div class="modalproductdetails">
                                    <!-- product info start -->

                                    <div class="prodinfoname">
                                    <p>{{ $product->name }}</p>
                                    </div>

                                    @if ($product->verified)
                                        <div id="verifiedbadge">
                                            <p class="mb-0">Skyline <span id="verifiedtxt">Verified</span><span class="material-icons">
                                                verified_user
                                                </span> </p>
                                        </div>
                                    @endif

                                    <hr id="ratingsseparator">
                                    <div class="prodpricees">
                                        <p class="mb-1">MRP: <s><strong> ₹{{ $product->mrp }}</strong></s></p>
                                        <p class="mb-1">Price: <span class="text-success"><strong> ₹{{ $product->sellingPrice }}</strong></span></p>
                                        <p class="mb-1">You Save: <span class="text-danger">₹{{ $product->totalSaving() }} ({{ $product->discount }}%)</span></p>
                                        <p class="mb-1">FREE Delivery: <strong class="text-dark">July 20 - 24</strong></p>
                                    </div>
                                    <hr>

                                    <!-- check for availability -->
                                    <div class="checkavailibilitypincode">

                                        <p><strong>Check Availability At Your Location</strong></p>
                                        <div class="input-group mt-3">
                                            <input type="text" class="form-control" placeholder="Enter Your Pincode"
                                            aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-secondary" type="button" id="button-addon2">
                                                Check
                                            </button>
                                        </div>

                                    </div>

                                    <!-- product info end -->
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    @empty
                        <p>No products available for this category</p>
                    @endforelse
                @else
                    <p>No categories available</p>
                @endif

            </div>
            <div class="viewallbtn">
                <button onclick="location.href='{{ route('products.index') }}'" class="btn bg-orange">View All Products</button>
            </div>
        </div>
    </div>
</section>