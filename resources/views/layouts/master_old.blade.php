<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('old/favicon.ico')}}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
          rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{asset('old/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{asset('old/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('old/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('old/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('old/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('old/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('old/css/style.css')}}" rel="stylesheet">

</head>

<body>

<!--==========================
Header
============================-->
<header id="header" class="fixed-top">
    <div class="container">

        <div class="logo float-left">
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
            <a href="#intro" class="scrollto"><img src="{{asset('old/pesologo.png')}}" alt="" class="img-fluid"><strong
                    class="text-dark">{{ config('app.name', 'Laravel') }}</strong></a>
        </div>

        <nav class="main-nav float-right d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{auth()->check() ? '/' : '#intro'}}">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact Us</a></li>
                @if(!auth()->check())
                    <li><a href="/login">Login</a></li>
                    <li><a href="/signup">Signup</a></li>
                @endif
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header><!-- #header -->

<main class="py-4">
    @yield('content')
</main>

<!--==========================
  Footer
============================-->
<footer id="footer">
    <!-- <div class="footer-top">

    </div> -->

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong>{{ config('app.name', 'Laravel') }}</strong>. All Rights Reserved
        </div>
    </div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- Uncomment below i you want to use a preloader -->
<!-- <div id="preloader"></div> -->

<!-- JavaScript Libraries -->
<script src="{{asset('old/old/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('old/lib/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('old/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('old/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('old/lib/mobile-nav/mobile-nav.js')}}"></script>
<script src="{{asset('old/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('old/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('old/lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('old/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('old/lib/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('old/lib/lightbox/js/lightbox.min.js')}}"></script>

<!-- Template Main Javascript File -->
<script src="{{asset('old/js/main.js')}}"></script>

</body>
</html>
