<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title','Katalog - GROSIR MURAH KEDIRI')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.css')
    <style>
       sup {
            top: -.8em;
            position: relative;
            font-size: 100%;
            line-height: 0;
            vertical-align: baseline;
        }
    </style>
    @yield('css')
    @stack('css_in')
</head>

<body>
    @include('frontend.nav')
    @yield('content')
    <div class="row fixed-bottom" id="basket" style="display: none">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <span class="fa fa-shopping-basket fa-2x"></span>
                                <sup><span style="top:0" class="badge badge-danger"><span id="countC">0</span></span></sup>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <p> Total Belanja <b><span id="totalbl">0</span></b></p>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <button onclick="openBasket()" class="btn btn-success btn-sm">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="modalbasket">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-body">
                    <div id="loadbasket">
                        @include('frontend.page.checkout')
                    </div>
               </div>
           </div>
       </div>
   </div>

   @include('frontend.footer')
   @include('frontend.js')
    @php
        $data=Session::get('cart');
        // dd($data);
        // Session::flush();
    @endphp
     <script>
         function openBasket() {
             $.ajax({
                 url:'/ambil-basket',
                 dataType:'html',
                 type:'get',
                 success:function (data) {
                    $('#loadbasket').empty().html(data);
                    $('#modalbasket').modal('show');
                 }
             });

         }
        countC();

    </script>
   @yield('js')
   @stack('js_in')

</body>

</html>
