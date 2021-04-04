<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/jpg" href="{{asset('images/setting').'/'.CekNotif::namaWeb()->favicon}}"/>
    <title>@yield('title',CekNotif::namaWeb()->nama)</title>
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

<body id="loadData">
    @include('frontend.nav')
    @include('frontend.panelcari')
    <div class="row">
        <div class="col-12 col-md-2 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-10">
            @yield('content')
        </div>
    </div>

    <div class="row fixed-bottom" id="basket" style="display: none">
        <div class="navbar justify-content-center bg-white">
            <div class="col-12 col-md-12 col-lg-12">
                {{-- <div class="card-body"> --}}
                    <div class="text-center">
                        <div class="row ">
                            <div class="col-12 col-md-4 col-lg-4 ">
                                <span class="fa fa-shopping-basket fa-2x"></span>
                                <sup><span style="top:0" class="badge badge-danger"><span id="countC">0</span></span></sup>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <p> Total Belanja <b><span id="totalbl">0</span></b></p>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <button onclick="openBasket()" class="btn btn-success btn-sm">Lihat Keranjang</button>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
   <div class="modal fade" id="modalbasket">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-header">
                <div class="modal-tittle">
                    <p>Rincian Belanja</p>
                </div>
                   <button class="close" data-dismiss="modal">&times;</button>
               </div>
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
   <script>
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
   </script>
    @php
        $data=Session::get('cart');
        // dd($data);
        // Session::flush();
    @endphp
     <script>

    // loading
      function loadingf() {
        $("#loadData").loading({
            stoppable: true,
            theme: "dark",
            message: 'Proses Simpan....',
          });
      }
      function loadingawal() {
        $(".ading").loading({
            stoppable: true,
            theme: "dark",
            message: 'Please Wait....',
          });
      }
      function sloadingawal() {
        $(".ading").loading('stop');
      }
      function stoploadingf() {
        $("#loadData").loading('stop');
      }

         $(document).ready(function(){
            loadingawal();
            $(window).on('load', function () {
                // $(".loader").remove();
               sloadingawal();
            });
        })
         countC();
           const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });

        //
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
        function hapusItem(key) {
            loadingf();
            $.ajax({
                url:'/hapus-item/'+key,
                dataType:'json',
                type:'get',
                success:function(response){

                    if(response.sts=='1'){
                        $('#basket').attr('style','display:inherit');
                        Toast.fire({
                            type: 'success',
                            title: response.msg
                        });
                        $('#totalbl').html("Rp. "+numberFormatComma(response.ttal));
                        countCt(response.item);
                        openBs();
                        stoploadingf();
                    }else{
                        Toast.fire({
                            type: 'warning',
                            title: 'Gagal Menghapus Item'
                        });
                    }

                }
            })
        }
        function openBs() {
             $.ajax({
                 url:'/ambil-basket',
                 dataType:'html',
                 type:'get',
                 success:function (data) {
                    $('#loadbasket').empty().html(data);
                    // countC();
                    // $('#modalbasket').modal('show');
                 }
             });

         }
        function countC() {
            var ct="<?php echo CekNotif::countKeranjang() ?>";
            $('#countC').html(ct);
            if(ct>0){
                var totl=$('#ttl').text();
                $('#basket').attr('style','display:inherit');
                $('#totalbl').html(totl);
            }else{
                $('#basket').attr('style','display:none');
            }
        }
        function countCt(nom) {
                $('#countC').html(nom);
                if(nom<=0){
                    $('#basket').attr('style','display:none');
                    $('#modalbasket').modal('toggle');
                }
        }
        function numberFormatComma(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");
        }
        function checkout() {
            loadingf();
            var jns="";
            var nama=$('#fnama').val();
            var telp=$('#ftelp').val();
            var ctoko=$('#rtoko:checked').val();
            var ckirim=$('#rkirim:checked').val();
            var cdrop=$('#rdrop:checked').val();
            var pn="-";
            var pal="-";
            var ptlp="-";
            var alamat="-";

            if(ctoko=="Toko"){
                alamat="ambil di toko";
                jns="Toko";
            }else if(cdrop=="Drop"){
                pn=$('#fpenerima').val();
                pal=$('#falamatPenerima').val();
                ptlp=$('#ftelpPenerima').val();
                jns="Kirim";
            }else{
                alamat=$('#falamat').val();
                jns="Kirim";
            }
            if(ctoko=='Toko'){
                if(nama=='' || telp==''){
                    Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Harap Lengkapi  Identitas Anda !',
                        })
                }else{
                    $.ajax({
                        url:'/simpan-belanja',
                        type:'post',
                        dataType:'json',
                        data:{nama:nama,telp:telp,alamat:alamat,pn:pn,pal:pal,ptlp:ptlp,jns:jns},
                        success:function(response){
                            if(response.sts=='1'){
                                window.open('<?php echo route("sukses") ?>','_blank');
                                $('#modalbasket').modal('toggle');
                                location.reload();
                            }
                        }
                    })
                }
            }else if(ckirim=="Kirim"){
                if(alamat==''){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Harap Lengkapi  Alamat Anda !',
                    })
                }else{
                    $.ajax({
                        url:'/simpan-belanja',
                        type:'post',
                        dataType:'json',
                        data:{nama:nama,telp:telp,alamat:alamat,pn:pn,pal:pal,ptlp:ptlp,jns:jns},
                        success:function(response){
                            if(response.sts=='1'){
                                window.open('<?php echo route("sukses") ?>','_blank');
                                $('#modalbasket').modal('toggle');
                                location.reload();
                            }
                        }
                    })
                }
            }else if(cdrop=='Drop'){
                if(pn==''||pal==''||ptlp==''){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Harap Lengkapi  Nama, Alamat , Telp Dropship Anda !',
                    })
                }else{
                    alamat='Dropship';
                    $.ajax({
                        url:'/simpan-belanja',
                        type:'post',
                        dataType:'json',
                        data:{nama:nama,telp:telp,alamat:alamat,pn:pn,pal:pal,ptlp:ptlp,jns:jns},
                        success:function(response){
                            if(response.sts=='1'){
                                window.open('<?php echo route("sukses") ?>','_blank');
                                $('#modalbasket').modal('toggle');
                                location.reload();
                            }
                        }
                    })
                }
            }

        }
        function cekToko() {
            $('#rtoko').prop(':checked',true);
            $('#rkirim').prop(':checked',false);
            $('#rdrop').prop(':checked',false);
            $('#fkirim').attr('style','display:none');
            $('#fdropship').attr('style','display:none');
        }
        function cekKirim() {
            $('#rtoko').prop(':checked',false);
            $('#rkirim').prop(':checked',true);
            $('#rdrop').prop(':checked',false);
            $('#fkirim').attr('style','display:inherit');
            $('#fdropship').attr('style','display:none');
        }
        function cekDrop() {
            $('#rtoko').prop(':checked',false);
            $('#rkirim').prop(':checked',false);
            $('#rdrop').prop(':checked',true);
            $('#fkirim').attr('style','display:none');
            $('#fdropship').attr('style','display:inherit');

        }
    </script>
   @yield('js')
   @stack('js_in')

</body>

</html>
