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
          @auth
               <!-- account and orders dropdown -->
              <div class="dropdown accountordersdropd">
                <a class="dropdown-toggle accountordersdropd-inner" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Hello, {{ auth()->user()->name }} <br><strong class="acntordersspan">Account & Orders</strong>
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
                    <a href="{{ route('users.edit') }}">Your Account</a>
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
            <p><em>Hello, User</em></p>
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

        <div onclick="location.href='{{ route('categories.index') }}'" class="mobsidebaritem">
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

          <div onclick="location.href='{{ route('users.edit') }}'" class="mobsidebaritem">
            <a href="{{ route('users.edit') }}">Your Account</a>
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

        <div onclick="location.href=''" class="mobsidebaritem">
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

  </section>

  <div class="b-example-divider"></div>
</div>