@extends('frontend.index')
@section('content')
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading">
                    @foreach ($ket as $k)
                    <h2 class="text-info">{{$k->nama}}</h2>
                    <input type="hidden" id="prod" value="{{$k->nama}}">
                    <p>{{$k->deskripsi}}</p>
                    @endforeach
                </div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="gallery">
                                    <div class="sp-wrap">
                                        @foreach ($data as $p)
                                            <a href="{{asset('img/gambarproduk/'.$p->gambar)}}" ><img class="img-fluid d-block mx-auto" src="{{asset('img/gambarproduk/'.$p->gambar)}}"></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info">
                                    <h3>Pilihan Varian : <div class="badge badge-warning" id="pil"></div></h3>
                                    <div class="row">
                                        @foreach ($data as $item)
                                            <div class="col-md-2 col-lg-2 col-2">
                                                <form class="inline">
                                                    <div class="form-group">
                                                        <button type="button" onclick="setPilihan('{{$item->id}}')" class="btn btn-outline-info btn-sm">{!!$item->warna.' </br> '. $item->size!!}</button>
                                                        <input type="hidden" id="j{{$item->id}}" value="{!!$item->warna.' - '. $item->size!!}">
                                                        <input type="hidden" id="h{{$item->id}}" value="{{number_format($item->harga)}}">
                                                        <input type="hidden" id="s{{$item->id}}" value="{!!$item->stok!!}">
                                                        <input type="hidden" id="i{{$item->id}}" value="{!!$item->id!!}">
                                                    </div>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="price">
                                        <h3>Harga : Rp. <span id="hr">0</span></h3>
                                        <h3>Stok  : <span id="st">0</span></h3>
                                        <input type="hidden" id="idp">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah :</label>
                                                    <input id="qty" class="form-control" type="number" value="1" min="1" max="100" />
                                                </div>
                                            </div>
                                        </div>
                                    </div><button class="btn btn-primary" onclick="simpan()" type="button"><i class="icon-basket"></i>Tambahkan</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
@push('js_in')
<script src="{{asset('frontend/assets/js/bootstrap-number-input.js')}}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });
        function setPilihan(id) {
            var jn=$('#j'+id).val();
            $('#pil').html(jn);
            var hr=$('#h'+id).val();
            $('#hr').html(hr);
            var st=$('#s'+id).val();
            $('#st').html(st);
            var idp=$('#i'+id).val();
            $('#idp').val(idp);
        }
        // input qty
        $('#qty').bootstrapNumber();

        function simpan() {
            var id=$('#idp').val();
            var jn=$('#j'+id).val();
            if(id<=0){
                alert('Anda Belum memilih Varian' + id);
            }else{
                var prod=$('#prod').val();
                var qty=$('#qty').val();
                $.ajax({
                    url:'/katalog/simpan-cart/',
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
                            countC(response.item);
                            $('#totalbl').html("Rp. "+numberFormatComma(response.ttal));
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
        function countC(nom) {
            $('#countC').html(nom);
        }
        function numberFormatComma(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",");
        }
        function hapusItem(key) {
            $.ajax({
                url:'/hapus-item/'+key,
                dataType:'json',
                type:'get',
                success:function(response){
                    if(response==1){
                        if(response.sts=='1'){
                            $('#basket').attr('style','display:inherit');
                            Toast.fire({
                                type: 'success',
                                title: response.msg
                            });
                            countC(response.item);
                            $('#totalbl').html("Rp. "+numberFormatComma(response.ttal));

                        }else{
                            Toast.fire({
                                type: 'warning',
                                title: 'Gagal Menghapus Item'
                            });
                        }
                    }
                }
            })
        }
        function basketAll() {
            $.ajax({
                 url:'/ambil-basket',
                 dataType:'html',
                 type:'get',
                 success:function (data) {
                    $('#loadbasket').empty().html(data);
                    // $('#modalbasket').modal('show');
                 }
             });
        }
    </script>
@endpush