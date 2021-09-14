<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Skyline | Admin</title>
  @livewireStyles

  <!-- Favicons -->
  <link href="{{ asset('assets/admin/images/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/admin/images/favicon.png') }}" rel="apple-touch-icon">
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/image-uploader.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/properties-dynamicfields.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/properties-subcategory.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/admin/js/properties-variants.js') }}"></script>


  <meta name="author" content="Kunal Pandharkar">
  <meta name="twitter:title" content="Skyline | Admin">
  <meta name="twitter:description"
    content="designed and promoted by maharashtra industries directory, www.maharashtradirectory.com" />
  <meta property="og:title" content="Skyline | Admin">
  <meta property="og:url" content="wwww.skyline.com">
  <meta property="og:image" content="https://samvaidya961.github.io/skylineadmin/assets/images/favicon.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1024">
  <meta property="og:image:height" content="1024">
  <!-- texteditor js cdn -->
  <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
  <!-- image uploader css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/image-uploader.min.css') }}">

</head>

<body>


  <div class="d-flex" id="wrapper">
    {{-- sidebar --}}
    <x-admin.sidebar />


    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
    {{-- header --}}
      <x-admin.header />

      @if ($message = Session::get('success'))
        <x-alert>{{ $message }}</x-alert>
      @elseif ($message = Session::get('error'))
        <x-alert type="danger">{{ $message }}</x-alert>
      @endif

      <!-- Page content-->
      @yield('content')
      <!-- Page content ends-->

    </div>
  </div>
  
  @stack('scripts')
  <!-- Core theme JS-->
  <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/admin/js/calendar.js') }}"></script>
  @livewireScripts
</body>

</html>