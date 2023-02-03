<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    {!! SEO::generate(true) !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="copyright" content="الکتروما - brarghkarsho" />
    <meta name="language" content="fa" />
    <meta name="theme-color" content="#0d6efd">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="website" content="https://www.barghkarsho.com/" />
    <meta name="Version" content="v1" />

    <!-- favicon -->
    <link rel="shortcut icon" href="/static/favicon.ico">

    @vite('resources/css/app.css')
    @livewireStyles
    @yield('style')
</head>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->
    @include('layouts.header.index')

    @yield('content')

    @if (isset($slot) and $slot !== null)
        {{ $slot }}
    @endif

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top">
        <x-icon-o-arrow-sm-up data-feather="arrow-up" class="icons h-75 w-75" />
    </a>
    <!-- Back to top -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    @yield('script')
    @vite('resources/js/app.js')
    @livewireScripts
    {{-- <!-- javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Icons -->
    <script src="js/feather.min.js"></script>
    <!-- Switcher -->
    <script src="js/switcher.js"></script>
    <!-- Main Js -->
    <script src="js/plugins.init.js"></script>
    <!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="js/app.js"></script>
    <!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. --> --}}
</body>

</html>
