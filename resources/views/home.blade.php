@extends('layouts.main', ['header' => 'full', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Skyline Distributors | Aurangabad - Home')

@section('content')
    <!-- home carousel start -->
    <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div id="carindicators" class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @forelse ($banners as $banner)
                <div class="carousel-item  @if ($loop->first) active @endif">
                    <img src="{{ asset('images/'.$banner->image ) }}" class="d-block w-100" alt="...">
                </div>
            @empty
                
            @endforelse
        </div>


        <button class="carousel-control-prev nextprevbtn" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next nextprevbtn" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </section>
    <!-- home carousel end -->

    <div class="b-example-divider"></div>
    <!-- products scroller top picks start -->
    <section id="toppickssection">
        <div class="siteheading">
        <h6>
            Top Picks For You
        </h6>
        </div>
        <div class="headingunderline"></div>
        
        <div class="productscont">
            @forelse ($toppicks as $product)
                <div class="procard card">
                    <h1 class="discount">4%</h1>
                    <div class="prod-img">
                    <img src="{{ asset('images/'.$product->image) }}" class="" alt="{{ asset('images/'.$product->name) }}" onclick="location.href='{{ route('products.show', $product) }}'">
                    <div class="onhoverdetails">
                        <button class="btn quickviewbtn" data-bs-toggle="modal" data-bs-target="#quickviewproductmodal{{ $product->id }}">Quick
                        View</button>
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
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            @empty
                <p>No top picks till now</p>
            @endforelse
            
        </div>
    </section>
    <!-- products scroller top picks end -->

    <div class="b-example-divider"></div>

    <!-- products categorywise in tab pane start-->
    @livewire('best-seller-category')
    <!-- products categorywise in tab pane end-->

    <div class="b-example-divider"></div>

    <!-- quick view product modal start -->

    <!-- quick view product modal ends -->

    <x-shop-by-brands />
  @endsection