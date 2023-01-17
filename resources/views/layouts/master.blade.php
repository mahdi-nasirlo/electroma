<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title>لندریک - قالب چندمنظوره ای مدرن html</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
    <meta name="author" content="JafarAbbasi" />
    <meta name="email" content="jabasi26@gmail.com" />
    <meta name="website" content="https://www.rtl-theme.com/author/tn_plugin/" />
    <meta name="Version" content="v3.2.1" />
    <!-- favicon -->
    <link rel="shortcut icon" href="static/favicon.ico">

    @vite('resources/css/app.css')
    @livewireStyles
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
    <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top"><i
            data-feather="arrow-up" class="icons"></i></a>
    <!-- Back to top -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
