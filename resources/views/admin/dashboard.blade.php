@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- dashboard starts  -->
    <div id="dashboardboxes">

      <div class="dbboxouter">
        <div class="dbbox">
          <div class="dbboxleft">
            <div class="dbicon">
              <span class="material-icons">
                people
              </span>
            </div>
          </div>
          <div class="dbboxright">
            <div class="dbboxcount">
              <p class="mb-0">{{ $totalUsers }}</p>
            </div>
            <div class="dbboxname">
              <p class="mb-0">Total Users</p>
            </div>
          </div>
        </div>
        <div class="dbboxbottom">

          <span class="material-icons rightarrow">
            arrow_right_alt
          </span>
        </div>
      </div>

      <div class="dbboxouter">
        <div class="dbbox">
          <div class="dbboxleft">
            <div class="dbicon">
              <span class="material-icons">
                inventory_2
              </span>

            </div>
          </div>
          <div class="dbboxright">
            <div class="dbboxcount">
              <p class="mb-0">{{ $totalProducts }}</p>
            </div>
            <div class="dbboxname">
              <p class="mb-0">Total Products</p>
            </div>
          </div>
        </div>
        <div class="dbboxbottom">

          <span class="material-icons rightarrow">
            arrow_right_alt
          </span>
        </div>
      </div>

      <div class="dbboxouter" onclick="location.href='orders.html'">
        <div class="dbbox">
          <div class="dbboxleft">
            <div class="dbicon">
              <span class="material-icons">
                shopping_bag
              </span>
            </div>
          </div>
          <div class="dbboxright">
            <div class="dbboxcount">
              <p class="mb-0">{{ $totalOrders }}</p>
            </div>
            <div class="dbboxname">
              <p class="mb-0">Total Orders</p>
            </div>
          </div>
        </div>
        <div class="dbboxbottom">

          <span class="material-icons rightarrow">
            arrow_right_alt
          </span>
        </div>
      </div>

      <div class="dbboxouter">
        <div class="dbbox">
          <div class="dbboxleft">
            <div class="dbicon">
              <span class="material-icons">
                request_quote
              </span>
            </div>
          </div>
          <div class="dbboxright">
            <div class="dbboxcount">
              <p class="mb-0">{{ $totalQuotes }}</p>
            </div>
            <div class="dbboxname">
              <p class="mb-0">Quote Requests</p>
            </div>
          </div>
        </div>
        <div class="dbboxbottom">

          <span class="material-icons rightarrow">
            arrow_right_alt
          </span>
        </div>
      </div>

    </div>
    <!-- dashboard ends -->

    <div id="bannercalendar" class="mb-4">
      <!-- add images/banner for home page starts-->
      <div class="addbannerimgcalendar">
        <div>
          <h5 class="mt-4 mb-4 text-center">Banners For Home Page</h5>
          <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-4 mt-2">
              @csrf
              <input required type="file" name="images[]" multiple class="form-control form-control-sm">
            </div>
            <div class="bannerimgpostbtn mt-4">
              <button class="btn btn-sm orangebg" type="submit">Upload Images</button>
            </div>
          </form>
        </div>

        <div>
          <!-- table -->
          <div id="alldatatable" class="bg-white mt-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Uploaded Banner Images</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($banners as $banner)
                  <tr>
                    <td>
                      <div class="brandlogoimg">
                        <img src="{{ asset('images/'.$banner->image) }}" alt="">
                      </div>
                    </td>
                    <td>
                      <form method="POST" action="{{ route('admin.banner.destroy', $banner) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">
                          <span class="material-icons">
                            delete
                          </span>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                    
                @endforelse

              </tbody>
            </table>
          </div>
        </div>


      </div>
      <!-- add images/banner for home page ends-->

      <div class="addbannerimgcalendar">
        <!-- calendar starts -->
        <div class="wrapper">
          <div class="container-calendar">
            <h5 id="monthAndYear"></h5>

            <div class="button-container-calendar">
              <button id="previous" onclick="previous()">&#8249;</button>
              <button id="next" onclick="next()">&#8250;</button>
            </div>

            <table class="table-calendar" id="calendar" data-lang="en">
              <thead id="thead-month"></thead>
              <tbody id="calendar-body"></tbody>
            </table>

            <div class="footer-container-calendar">
              <label for="month">Jump To: </label>
              <select id="month" onchange="jump()">
                <option value=0>Jan</option>
                <option value=1>Feb</option>
                <option value=2>Mar</option>
                <option value=3>Apr</option>
                <option value=4>May</option>
                <option value=5>Jun</option>
                <option value=6>Jul</option>
                <option value=7>Aug</option>
                <option value=8>Sep</option>
                <option value=9>Oct</option>
                <option value=10>Nov</option>
                <option value=11>Dec</option>
              </select>
              <select id="year" onchange="jump()"></select>
            </div>

          </div>

        </div>
        <!-- calendar ends -->
      </div>

    </div>
    
  </div>
@endsection
