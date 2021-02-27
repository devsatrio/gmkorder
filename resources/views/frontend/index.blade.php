<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title','Katalog - GROSIR MURAH KEDIRI')</title>
    @include('frontend.css')
    <style>

    </style>
    @yield('css')
    @stack('css_in')
</head>

<body>
    @include('frontend.nav')
    @yield('content')

   @include('frontend.footer')
   @include('frontend.js')
   @yield('js')
   @stack('js_in')
</body>

</html>
