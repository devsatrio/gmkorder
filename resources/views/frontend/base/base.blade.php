<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Grosir Murah Kediri</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   @include('frontend.base.css')
   @stack('css_add')
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer bg-dark">

        @include('frontend.base.menu')
        @include('frontend.base.chart')
        @yield('content')
   
    </div>
    @include('frontend.base.js')
    @stack('js_add')
</body>

</html>