<div>
    <nav class="navbar navbar-expand-lg navbar-dark bluebg" aria-label="Main navigation">
        <div class="container-fluid">

            <button id="backbtnicon" class="p-0 border-0 bluebg" data-bs-toggle="offcanvas"
                data-bs-target="#mob-sidebar" aria-controls="mob-sidebar" onclick="location.href='{{ url()->previous() }}'">
                <span class="material-icons">
                    keyboard_backspace
                </span>
            </button>

            <!-- logo -->
            <a id="sky-logo" class="navbar-brand mr-auto" href="#">
                <p id="allcathead" class="d-inline-block align-text-top mb-0">{{ $title }}</p>
            </a>
            <!-- logo end -->

            <!-- mobile cart start-->
            <div id="mob-cart" onclick="location.href='{{ route('carts.index') }}'">
                <div id="shoppingcart-mob" class="d-flex">
                    <div id="cartimg">
                        <span class="material-icons">
                            shopping_cart
                        </span>
                    </div>
                    <div id="cartcount" class="badge rounded-pill bg-grey">
                        @auth
                            {{ Cart::session(Auth::id())->getTotalQuantity() }}
                        @endauth
                            
                        @guest
                            {{ Cart::getTotalQuantity() }}
                        @endguest
                    </div>
                </div>
            </div>
            <!-- mobile cart end -->

            <!-- navbar items in desktop -->
            <div class="navbar-collapse offcanvas-collapse justify-content-lg-end">
                
                <!-- cart start desktop-->
                <div id="shoppingcart" class="mr-0" onclick="location.href='{{ route('carts.index') }}'">
                    <div id="cartimg">
                        <img src="assets/images/shopping-cart.png" alt="">
                    </div>
                    <div id="cartcount" class="badge rounded-pill bg-grey">
                        {{ Cart::getTotalQuantity() }}
                    </div>
                </div>
                <!-- cart end -->
            </div>
            <!-- desktop nav items end -->
        </div>
    </nav>
    <!-- header end -->
</div>