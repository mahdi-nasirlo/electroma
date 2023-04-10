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

    @vite('resources/css/app.css')
</head>

<body style="background: #f7f7f7ad">
    @yield('content')

    @if (isset($slot) and $slot !== null)
        {{ $slot }}
    @endif
</body>

</html>
