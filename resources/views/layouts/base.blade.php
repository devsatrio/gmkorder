<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Top Navigation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('token')
<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
@yield('customcss')
<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<audio id="notifsound" src="{{asset('notif.mp3')}}" muted></audio>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts/nav')
  
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  
  <aside class="control-sidebar control-sidebar-dark" style="height:100%;">
    <div class="p-3">
      <h5>Menu Lainnya</h5>
      <a href="{{url('backend/slider')}}" class="mt-3"><i class="fa fa-image"></i> Slider</a><br>
      <a href="{{url('backend/setting-web')}}" class="mt-3"><i class="fa fa-cog"></i> Setting Web</a>
    </div>
  </aside>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@stack('customjs')
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<script src="{{asset('customjs/backend/notiforder.js')}}"></script>
@stack('customscripts')
</body>
</html>
