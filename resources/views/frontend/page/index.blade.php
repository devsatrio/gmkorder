@extends('frontend.index')
@section('css')

    <style>
        .round-image, .card{
            border-radius: 2%;
        }

        .text-title{
            text-align: center;
            font-size: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
        }
        .product-discount-label,.product-new-label{color:#fff;background-color:#ef5777;font-size:15px;text-transform:uppercase;padding:4px 7px;display:block;position:absolute;top:10px;left:0}
        .product-discount-label{background-color:#333;left:auto;right:0}
    </style>
@endsection
@section('content')
<main class="page catalog-page">
    <section class="clean-block clean-catalog dark">
        <div class="container">
            @include('frontend.panelcari')
            <div class="block-heading">
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner">
                        @php
                            $idno=1;
                            $idm=1;
                        @endphp
                        @foreach ($slide as $item)
                            <div class="carousel-item {{$item->selected}}"><img class="w-100 d-block" src="{{asset('images/slider/'.$item->gambar)}}" alt="Slide Image"></div>
                        @endforeach
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                            data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        @foreach ($slide as $it)
                            <li data-target="#carousel-1" data-slide-to="{{$idm++}}" class="{{$it->selected}}"></li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <section class="clean-block clean-services ">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">Katalog</h2>
                    </div>
                    <div class="row">
                        @foreach ($kat as $k)
                        <div class="col-6 col-md-3 col-lg-3">
                            <p class="text-title">{{$k->nama}}</p>
                            @php
                                $link=str_replace(' ','-',$k->nama);
                            @endphp
                            <a href="{{route('produk',[$k->id,$link])}}" class="link">
                                <div class="card">
                                    <img class="card-img-top w-100 round-image d-block" src="{{asset('img/kategoriproduk/'.$k->gambar)}}">
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="clean-block clean-services dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">Promo SALE</h2>
                    </div>
                    <div class="row">
                        @foreach ($promo as $pr)
                        <div class="col-md-4 col-lg-4">
                            <div class="card">
                                @if ($pr->stok<1)
                                <div class="product-discount-label">Barang Habis</div>
                                @endif
                                <div class="product-new-label">Diskon {{$pr->diskon}}%</div>
                                <img src="{{asset('img/gambarproduk/'.$pr->gambar)}}" class="card-img-top" width="100%">
                                <div class="card-body mt-3 pt-0 px-0">
                                    <h4>
                                        {{$pr->produk}}
                                        <div class="badge badge-primary">{{$pr->warna}}</div>
                                        <div class="badge badge-info">{{$pr->size}}</div>
                                    </h4>
                                    <hr class="mt-2 mx-3">
                                    <div class="d-flex flex-row justify-content-between p-3 mid">
                                        <div class="d-flex flex-column"><small class="text-muted mb-1">Harga</small>
                                            <div class="d-flex flex-row">
                                                @if ($pr->diskon != '0')
                                                    <div class="d-flex flex-column ml-1"> <b> Rp. <strike> {{number_format($pr->harga)}}</strike></b></div>
                                                @else
                                                    <div class="d-flex flex-column ml-1"><b> Rp. {{$pr->harga}}</b></div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="d-flex flex-column"><small class="text-muted mb-1">  <b>Diskon {{$pr->diskon}}% </b> </small>
                                            <div class="d-flex flex-row">
                                                @php
                                                    $hdisk=($pr->harga)-($pr->harga*$pr->diskon)/100;
                                                @endphp
                                                <div class="d-flex flex-column ml-1" style="color: red"><h5> <b> Rp. {{number_format($hdisk)}}</b></h5></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <input id="qty{{$pr->idv}}" class="form-control qty" type="number" value="1" min="1" max="1000" />
                                    </div>
                                    <h5 class="text-muted key pl-3">Stok Tersedia <b>{{$pr->stok}}</b></h5>
                                    <div class="mx-3 mt-3 mb-2">
                                        @if ($pr->stok<1)
                                            <h4 class="mb-2"><b>OUT OF STOK</b></h4>
                                            <br>
                                        @else
                                        <button type="button" onclick="simpanPromo('{{$pr->idv}}','{{$pr->produk.' '.$pr->warna.'-'.$pr->size}}')" class="btn btn-primary btn-block"><small> <i class="icon-basket"></i>Tambahkan</small></button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection

@push('js_in')
<script src="{{asset('frontend/assets/js/bootstrap-number-input.js')}}"></script>
    <script>
          $('.qty').bootstrapNumber();
          function simpanPromo(id,prod) {
            var qty=$('#qty'+id).val();
            if(qty==''||qty<1){

            }else{
                loadingf();
                $.ajax({
                    url:'katalog/simpan-cart',
                    dataType:'json',
                    type:'post',
                    data:{id:id,qty:qty,prod:prod},
                    success:function(response){
                        if(response.sts=='1'){
                            $('#basket').attr('style','display:inherit');
                            Toast.fire({
                                type: 'success',
                                title: response.msg
                            });
                            countCt(response.item);
                            $('#totalbl').html("Rp. "+numberFormatComma(response.ttal));
                            $('#subttl').html("Rp. "+numberFormatComma(response.ttal));
                            $('#ttl').html("Rp. "+numberFormatComma(response.ttal));
                            stoploadingf();
                        }else{
                            Toast.fire({
                                type: 'warning',
                                title: 'Gagal Menambah Item'
                            });
                        }
                    }
                });
            }
          }
    </script>
@endpush
