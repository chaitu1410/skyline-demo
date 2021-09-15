    <!-- Top navigation-->
    <nav class="navbar navbar-expand-lg bluebg">
      <div class="container-fluid d-flex">

        <button id="sidebarToggle">
          <span class="material-icons">
            menu
          </span>
        </button>

        <div id="companylogo">
          <img src="assets/images/logo.png" alt="" onclick="location.href='{{ route('home') }}'">
        </div>

        <button id="navbartogglerbtn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

          <span class="material-icons">
            more_vert
          </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
          </ul>
        </div>
      </div>
    </nav>