<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="description" content="@yield('meta_description')">
  <meta name="keywords" content="@yield('meta_keyword')">
  <meta name="author" content="@yield('title')">
  <link rel="shortcut icon" href="{{asset('uploads/logo/'.$option_nav->favicon)}}">
  <meta property="og:image" content="@yield('image')">
  <link rel="stylesheet" href="{{asset('assets/vendor/boxicon/css/boxicons.min.css')}}">
  <link href="{{asset('assets/vendor/offcanvas/offcanvas-navbar.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

  {{--
  <link rel="stylesheet" href="{{asset('assets/vendor/select2bs5/select2-bootstrap-5-theme.min.css')}}" /> --}}


</head>

<body class="d-flex flex-column min-vh-100">
  <div id="app">
    @include('layouts.inc.frontend.navbar')

    <main>
      @yield('content')

      <a href="https://wa.me/{{$option_nav->whatsapp}}" class="act-btn-shopee fs-2 bg-success rounded">
        <i class='bx bxl-whatsapp display-3'></i> </a>



    </main>
  </div>
  @include('layouts.inc.frontend.footer')

</body>

<script src="{{asset('assets/vendor/offcanvas/offcanvas-navbar.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- <script type="text/javascript">
  var nav = document.querySelector('nav');
  
        window.addEventListener('scroll', function () {
          if (window.pageYOffset > 100) {
            nav.classList.add('bg-white', 'shadow-sm');
          } else {
            nav.classList.remove('bg-white', 'shadow-sm');
          }
        });
</script> --}}

@yield('scripts')

</html>