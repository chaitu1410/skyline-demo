<div>
    @if (Cart::session(Auth::id())->getTotalQuantity() > 0)
    <section>
        <!-- shopping cart start -->
    
        <div id="yourcartheading">
          <div class="siteheading">
            <h6>
              Shopping Cart
            </h6>
          </div>
          <div class="headingunderline"></div>
          <a id="deselectallitems" wire:click.prevent="clearAllCart">
            <p class="mb-0">Delete All Items</p>
          </a>
        </div>
    
        <div class="yourcartcontainers">
          <div id="yourcartsubtotal">
    
            <div class="purchaseprotectcont">
              <div class="purchaseprotectimg">
                <img src="assets/images/skyline-protect.png" alt="">
              </div>
              <div class="purchaseprotecttxt">
                <p class="mb-0">100% Purchase Protection</p>
                <p class="mb-0 text-danger">Original Products | Secure Payments</p>
              </div>
            </div>
    
            <div class="yourcartsubtotalhead">
              <p>Subtotal ({{ Cart::session(Auth::id())->getTotalQuantity() }} Items )
                <strong>₹{{ Cart::session(Auth::id())->getTotal() }}</strong>
              </p>
            </div>
            {{-- @if ($item['attributes']['varient']['stock']) --}}
              <a href="{{ route('orders.confirm') }}" class="btn bg-orange w-100">Proceed To Buy</a>
            {{-- @endif --}}
          </div>
    
          <div id="yourcartitems">
              @foreach ($cartItems as $item)    
                <div wire:key="{{ $item['id'] }}" class="yourcartitem">
                    <div class="yourcartitemimg">
                    <img src="{{ asset('images/'.$item['associatedModel']['image']) }}" alt="">
                    </div>
                    <div class="yourcartitemdetails">
                    <div class="prodinfoname" onclick="location.href='{{ route('products.show', $item['associatedModel']['slug']) }}'">
                        <p>{{ $item['name'] }} <br> <span><small>Varient: {{ $item['attributes']['varient']['name'] }}</small></span> </p>
                    </div>
                    
                    @if ($item['associatedModel']['verified'])
                        <div id="verifiedbadge" class="mb-2">
                            <p class="mb-0">Skyline <span id="verifiedtxt">Verified</span><span class="material-icons">
                                verified_user
                            </span> </p>
                        </div>
                    @endif
        
        
                    <div class="prodpricees">
                        <p class="mb-1">Price: <span class="text-success"><strong> ₹{{ $item['attributes']['varient']['sellingPrice'] }}</strong></span></p>
                        <p class="mb-1">FREE Delivery: <strong class="text-dark">{{ date('M d', strtotime(\Carbon::now()->addDays(15))) }} - {{ date('M d', strtotime(Carbon::now()->addDays(20))) }}</strong></p>
                    </div>
        
        
                    <div class="prodmoredetails">
                        @if ($item['attributes']['varient']['stock'])
                            <p class="mb-2 text-success small">In Stock.</p>
                        @else
                            <p class="mb-2 text-danger small">Out Of Stock.</p>
                        @endif
                    </div>
        
                    <div class="quantityincdec quantityincdecyourcart">
                        <livewire:cart-update :item="$item" :key="$item['id']"/>
                        <a class="deleteitemcartlink" href="#" wire:click.prevent="removeCart('{{$item['id']}}')">Delete</a>
                    </div>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
        <!-- shopping cart end -->
      </section>
      @else
        <h2>No items in the cart</h2>
      @endif
</div>
