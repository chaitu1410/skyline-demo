 <!-- Sidebar-->
    <div id="sidebar-wrapper" class="bg-dark">

        <div id="adminsidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
  
            <div class="dropdown">
              <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin</strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li>
                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <input type="submit" class="dropdown-item" value="Sign out"/>
                  </form>
                </li>
              </ul>
            </div>
          </a>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
  
            <li>
              <a href="{{ route('admin.dashboard') }}" class="nav-link">
                Dashboard
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.users.index') }}" class="nav-link">
                Users
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.categories.index') }}" class="nav-link">
                Categories & Products
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.products.addVarient') }}" class="nav-link">
                Product Variants
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.brands.index') }}" class="nav-link">
                Brands
              </a>
            </li>
  
  
            <li>
              <a href="{{ route('admin.pincodes.index') }}" class="nav-link">
                Cities & Pincodes
              </a>
            </li>
  
  
            <li>
              <a href="{{ route('admin.questions.index') }}" class="nav-link">
                FAQ
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.orders.index') }}" class="nav-link">
                Orders
              </a>
            </li>
  
            <li>
              <a href="{{ route('admin.quotes.index') }}" class="nav-link">
                Quote Requests
              </a>
            </li>
          </ul>
  
        </div>
  
      </div>