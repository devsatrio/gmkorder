<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @php
    $datawebsetting = DB::table('web_setting')->orderby('id','desc')->limit(1)->get();
    @endphp
    @foreach($datawebsetting as $dws)
    <title>{{$dws->singkatan}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{{asset('images/setting/'.$dws->favicon)}}"/>
    @endforeach
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
        @include('layouts/nav')
        @yield('content')
        <aside class="control-sidebar control-sidebar-dark" style="height:100%;">
            <div class="p-3">
                <h5>Daftar Laporan</h5>
                <a href="{{url('backend/laporan-transaksi')}}" class="mt-3"><i class="fa fa-file"></i> Laporan
                    Transaksi</a><br>
                <a href="{{url('backend/laporan-detail-transaksi')}}" class="mt-3"><i class="fa fa-file"></i> Laporan
                    Detail Transaksi</a><br>
                <a href="{{url('backend/laporan-transaksi-peradmin')}}" class="mt-3"><i class="fa fa-file"></i> Laporan
                    Transaksi Per Admin</a><br>
                    <a href="{{url('backend/laporan-shift-peradmin')}}" class="mt-3"><i class="fa fa-file"></i> Laporan
                    Transaksi Per Shift</a><br>
                <a href="{{url('backend/laporan-penjualan-perbarang')}}" class="mt-3"><i class="fa fa-file"></i> Laporan
                    Per Barang</a><br>
                <a href="{{url('backend/laporan-detail-penjualan-perbarang')}}" class="mt-3"><i class="fa fa-file"></i>
                    Laporan Detail Per Barang</a><br>
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