<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title','Transaction - GROSIR MURAH KEDIRI')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.css')
</head>
<body>

    <div class="container">
      <div class="jumbotron text-center">
        <h1 class="display-3">Terimaksih Atas Ordernya !</h1>
        @php
            $data=Session::get('cwa');
            $fk=Session::get('fk');
            $lst=[];
            foreach ($data as $key => $v) {
                $lst[]=$v['prod'].'  '.$v['varian'].' - '.$v['qty'].'%0D%0A';
            }

            $snd=$fk.'%0D%0A'. implode(" ",$lst);
          //   dd($snd);
        @endphp
          <a target="_blank" href="https://api.whatsapp.com/send?phone={{CekNotif::getNoTelp()->telp}}&text={{$snd}}"> <p class="lead"><strong>Kirim Daftar Pesanan</strong></p> </a>
        <hr>
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{route('beranda')}}" role="button">Yuk Lihat Barang Lain Yang Lebih Menarik</a>
        </p>
      </div>
    </div>
</body>
