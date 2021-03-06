@extends('frontend.index')
@section('content')
    <div class="page catalog-page">
            <section class="clean-block clean-services dark">
                <div class="container">
                    @include('frontend.panelcari')
                    <div class="block-heading">
                        <h2 class="text-info">Hasil Pencarian</h2>
                    </div>
                    <div class="row">
                        @foreach ($data as $pr)
                        <div class="col-md-4 col-lg-4">
                            <div class="card">
                                @if ($pr->stok<1)
                                <div class="product-discount-label">Barang Habis</div>
                                @endif
                                @if ($pr->diskon !="0")
                                    <div class="product-new-label">Diskon {{$pr->diskon}}%</div>
                                @endif
                                <img src="{{asset('assets/img/loader.gif')}}" data-src="{{asset('img/gambarproduk/'.$pr->gambar)}}" class="lazy card-img-top" width="100%">
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
                                        @if ($pr->diskon !="0")
                                            <div class="d-flex flex-column"><small class="text-muted mb-1">  <b>Diskon {{$pr->diskon}}% </b> </small>
                                                <div class="d-flex flex-row">
                                                    @php
                                                        $hdisk=($pr->harga)-($pr->harga*$pr->diskon)/100;
                                                    @endphp
                                                    <div class="d-flex flex-column ml-1" style="color: red"><h5> <b> Rp. {{number_format($hdisk)}}</b></h5></div>
                                                </div>
                                            </div>
                                        @endif
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
                <div class="d-flex justify-content-center">
                    {{$data->links()}}
                </div>
            </section>
        </div>
    </div>
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
        (function () {
        var ll = new LazyLoad({
          threshold: 0,
        });
      })();
    </script>
@endpush
