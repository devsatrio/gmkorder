@php
$data=Session::get('cwa');
$fk=Session::get('fk');
$lst=[];
foreach ($data as $key => $v) {
    $lst[]=$v['prod'].'  '.$v['varian'].' - '.$v['qty'].'%0D%0A';
}
$nama=Session::get('pembeli');
$telp=Session::get('telp');
$al=Session::get('alamat');

$snd=$fk.'%0D%0A'. implode(" ",$lst).'%0D%0A'.'%0D%0A'.'Nama : '.$nama.'%0D%0A'.'Telp: '.$telp.'%0D%0A'.'Pengiriman: '.$al.'%0D%0A'.'%0D%0A'.'PROMO GMK'.'%0D%0A'.'%0D%0A'.CekNotif::namaWeb()->promo;
//   dd($snd);
$urlwa='https://api.whatsapp.com/send?phone='.CekNotif::getNoTelp()->telp.'&text='.$snd;
@endphp
<html>
  <head>
    @include('frontend.css')
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            location.href='<?php echo $urlwa  ?>';
        });
    </script>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Transaksi Success</h1>
          <a target="_blank" href="https://api.whatsapp.com/send?phone={{CekNotif::getNoTelp()->telp}}&text={{$snd}}"> <p class="nav nav-link"> <i class="fa fa-send fa-lg"></i> <strong>Kirim Detail Belanja Ke ADMIN</strong></p> </a>
        <hr>
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{route('beranda')}}" role="button">Yuk Lihat Barang Lain Yang Lebih Menarik</a>
        </p>
      </div>
    </body>
</html>
