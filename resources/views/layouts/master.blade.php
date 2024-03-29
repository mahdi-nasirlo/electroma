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
    <meta name="robots" content="noindex, nofollow" />

    <!-- favicon -->
    <link rel="shortcut icon" href="/static/favicon.ico">

    @vite('resources/css/app.css')
    @livewireStyles
    @yield('style')
</head>

<body style="background: #f7f7f7ad">

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
    @include('layouts.footer.index')
    @include('layouts.click_to_chat')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    @yield('script')
    @vite('resources/js/app.js')
    @livewireScripts
</body>

</html>
