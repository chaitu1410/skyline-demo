<div>
  <section>
    <nav class="navbar navbar-expand-lg navbar-dark bluebg" aria-label="Main navigation">
      <div class="container-fluid">

        <button class="navbar-toggler p-0 border-0" type="button" id="sbtoggle">
          <span id="sb-toggle" class="navbar-toggler-icon"></span>
        </button>

        <!-- logo -->
        <a id="sky-logo" class="navbar-brand mr-auto" onclick="location.href='{{ route('home') }}'">
          <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="24" class="d-inline-block align-text-top">
        </a>
        <!-- logo end -->

        <!-- bulk quote -->
        <a id="bulkquote" class="btn btn-success btn-sm" href="{{ route('quotes.create') }}">
          BULK QUOTE
        </a>
        <!-- bulk quote end -->

        <!-- location select mobile start -->
        <a id="selectlocicon" href="" data-bs-toggle="offcanvas" data-bs-target="#locationoffcanvas"
          aria-controls="locationoffcanvas">
          <span class="material-icons">
            location_on
          </span>
        </a>
        <!-- location select mobile end -->


        <!-- mobile cart start-->
        <div id="mob-cart" onclick="location.href='{{ route('carts.index') }}'">
          <div id="shoppingcart-mob" class="d-flex">
            <div id="cartimg">
              <span class="material-icons">
                shopping_cart
              </span>
            </div>
            <div id="cartcount" class="badge rounded-pill bg-grey">
              {{ Cart::getTotalQuantity() }}
            </div>
          </div>
        </div>

        <!-- mobile cart end -->

        <x-search />

        <!-- navbar items in desktop -->
        <div id="desknavitems" class="navbar-collapse offcanvas-collapse">


          <!-- lang -->
          {{-- <div id="langchange" class="dropdown">
            <a class="text-light dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
              aria-expanded="false">
              En
            </a>
            <ul id="langchangeitems" class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <li><button class="dropdown-item" type="button">Marathi</button></li>
              <li><button class="dropdown-item" type="button">Japanese</button></li>
              <li><button class="dropdown-item" type="button">German</button></li>
            </ul>
          </div> --}}
          <!-- lang end -->
          @auth
               <!-- account and orders dropdown -->
              <div class="dropdown accountordersdropd">
                <a class="dropdown-toggle accountordersdropd-inner" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <marquee>Hello, {{ auth()->user()->name }}</marquee> <br><strong class="acntordersspan">Account & Orders</strong>
                </a>
                <div id="acountordersdiv" class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <p><strong>Your Account</strong></p>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button id="signoutbtn" class="w-100 btn" type="submit">Sign Out</button>
                  </form>
                  <div id="youracntitemlist">
                    @if (Auth::user()->isAdmin)
                      <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                    @endif
                    <a href="{{ route('users.edit', Auth::user()) }}">Your Account</a>
                    <a href="{{ route('orders.index') }}">Your Orders</a>
                    <a href="{{ route('orders.return.index') }}">Your Returned Orders</a>
                    <a href="{{ route('orders.cancel.index') }}">Your Cancelled Orders</a>
                    <a href="{{ route('quotes.index') }}">Your Quote Requests</a>
                    <a href="{{ route('carts.index') }}">Your Cart</a>
                    <a href="{{ route('quotes.create') }}">Bulk Quote</a>
                  </div>
                </div>
              </div>
              <!-- account and orders dropdown end-->
          @endauth

          @guest
              <!-- account and orders dropdown -->
              <div class="dropdown accountordersdropd">
                <a class="dropdown-toggle accountordersdropd-inner" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <strong class="acntordersspan">Login/Register</strong>
                </a>
                <div id="acountordersdiv" class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <div id="youracntitemlist">
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                  </div>
                </div>
              </div>
              <!-- account and orders dropdown end-->
          @endguest


          <!-- select location start -->
          <a id="locationselect" data-bs-toggle="offcanvas" data-bs-target="#locationoffcanvas"
            aria-controls="locationoffcanvas" class="accountordersdropd-inner d-flex">
            <p class="mb-0" id="locicon">
              <span class="material-icons">
                location_on
              </span>
            </p>
            <p class="mb-0">
              <span>Hello</span>
              <br>
              <strong class="acntordersspan">
                Select Your Address</strong>
            </p>

          </a>
          <!-- select location end -->


          <!-- cart start desktop-->
          <div id="shoppingcart" onclick="location.href='{{ route('carts.index') }}'">
            <div id="cartimg">
              <img src="{{ asset('assets/images/shopping-cart.png') }}" alt="">
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
          <!-- cart end -->
        </div>

        <!-- desktop nav items end -->

      </div>
    </nav>


    <!-- sidebar in mobile start -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mob-sidebar" aria-labelledby="mob-sidebarLabel">

      <!-- sidebar header -->
      <div id="mobsidebarheader">
        <a class="float-end" data-bs-dismiss="offcanvas" aria-label="Close">
          <span class="material-icons">
            close
          </span>
        </a>
        @auth
          <div id="mobsidebarusername">
            <marquee><p><em>Hello, {{auth()->user()->name}}</em></p></marquee>
          </div>
        @endauth
        @guest
          <div id="mobsidebarusername">
            <marquee><p><em>Hello, User</em></p></marquee>
          </div>
        @endguest
        
      </div>
      <!-- sidebar header end -->


      <!-- sidebar links start -->
      <div id="mobsidebaritems">

        <div onclick="location.href='{{ route('home') }}'" class="mobsidebaritem">
          <a href="{{ route('home') }}">Home</a>
          <span class="material-icons">
            navigate_next
          </span>
        </div>

        <div onclick="location.href='allcategories.html'" class="mobsidebaritem">
          <a href="{{ route('categories.index') }}">Shop By Category</a>
          <span class="material-icons">
            navigate_next
          </span>
        </div>

        @auth
          @if (Auth::user()->isAdmin)
            <div onclick="location.href='{{ route('admin.dashboard') }}'" class="mobsidebaritem">
              <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
              <span class="material-icons">
                navigate_next
              </span>
            </div>
          @endif

          <div onclick="location.href='{{ route('users.edit', Auth::user()) }}'" class="mobsidebaritem">
            <a href="{{ route('users.edit', Auth::user()) }}">Your Account</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>

          <div onclick="location.href='{{ route('orders.index') }}'" class="mobsidebaritem">
            <a href="{{ route('orders.index') }}">Your Orders</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>

          <div onclick="location.href='{{ route('orders.return.index') }}'" class="mobsidebaritem">
            <a href="{{ route('orders.return.index') }}">Your Returned Orders</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>

          <div onclick="location.href='{{ route('orders.cancel.index') }}'" class="mobsidebaritem">
            <a href="{{ route('orders.cancel.index') }}">Your Cancelled Orders</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>

          <div onclick="location.href='{{ route('quotes.index') }}'" class="mobsidebaritem">
            <a href="{{ route('quotes.index') }}">Your Quote Requests</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>

          <div onclick="location.href='{{ route('carts.index') }}'" class="mobsidebaritem">
            <a href="{{ route('carts.index') }}">Your Cart</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>


          <div onclick="location.href='{{ route('quotes.create') }}'" class="mobsidebaritem">
            <a href="{{ route('quotes.create') }}">Bulk Quote</a>
            <span class="material-icons">
              navigate_next
            </span>
          </div>
          
          @endauth

          @guest
            <div onclick="location.href='{{ route('login') }}'" class="mobsidebaritem">
              <a href="{{ route('login') }}">Login</a>
              <span class="material-icons">
                navigate_next
              </span>
            </div>

            <div onclick="location.href='{{ route('register') }}'" class="mobsidebaritem">
              <a href="{{ route('login') }}">Register</a>
              <span class="material-icons">
                navigate_next
              </span>
            </div>
          @endguest

        


        <div onclick="location.href=''" class="mobsidebaritem">
          <a href="aboutus.html">About Us</a>
          <span class="material-icons">
            navigate_next
          </span>
        </div>

        <div onclick="location.href='contactus.html'" class="mobsidebaritem">
          <a href="contactus.html">Contact Us</a>
          <span class="material-icons">
            navigate_next
          </span>
        </div>

        @auth
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button id="signoutbtn" class="w-100 btn" type="submit">Sign Out</button>
          </form>
        @endauth

      </div>
      <!-- sidebar links end -->

    </div>
    <!-- sidebar in mobile end -->



    <!-- location offcanvas -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="locationoffcanvas"
      aria-labelledby="locationoffcanvasLabel">

      <div class="offcanvas-body small">
        <h6><strong>Choose Your Location</strong></h6>
        <span class="text-secondary">Select a delivery location to see product availability and delivery options</span>

        <div id="defaultaddress">
          <span id="defname"><strong> User -</strong></span>
          <span id="defcity"><strong>AURANGABAD -</strong> </span>
          <span id="defpin">431009</span>
          <p class="text-secondary mb-0">
            <strong>
              Current Address
            </strong>
          </p>
        </div>

        <a href="" class="text-primary"><small>Change or edit address</small></a>
        <hr>

        <div class="input-group mt-3 mb-3">
          <input type="text" class="form-control" placeholder="Enter Your Pincode" aria-label="Recipient's username"
            aria-describedby="button-addon2">
          <button class="btn btn-secondary" type="button" id="button-addon2">
            Check
          </button>
        </div>
      </div>
    </div>
    <!-- location offcanvas end-->

  </section>

  <div class="b-example-divider"></div>
</div>