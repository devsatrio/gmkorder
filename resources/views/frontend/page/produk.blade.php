@extends('frontend.index')
@section('content')
    <main class="page service-page">
        <section class="clean-block clean-services dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">{{$kat->nama}}</h2>
                </div>
                <div class="row">
                    @foreach ($prod as $p)
                    <div class="col-12 col-md-3 col-lg-3">
                            <a href="{{route('loadb',[$p->kode])}}">
                                <div class="card">
                                    <div class="gallery">
                                        {{-- <div class="sp-wrap"> --}}
                                            <img class="card-img-top img-fluid d-block mx-auto w-100"  src="{{asset('img/produk/'.$p->gambar_utama)}}">
                                        {{-- </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{$p->nama}}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    {{-- <div class="col-12 col-md-12 col-lg-12 text-center">
                        <div><button class="btn btn-outline-primary btn-sm" type="button"> <span style="display: none" class="spinner-border spinner-border-sm" id="loading" role="status" aria-hidden="true"></span> Tampilkan Lebih Banyak</button></div>
                    </div> --}}
                </div>
            </div>
        </section>
    </main>
    {{-- modal --}}
    {{-- <div class="modal fade" id="mdl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Detail Produk</div>
                    <button type="button" class="btn-close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="container_barang">
                        @include('frontend.page.detail_produk')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script>

        function sModal(id) {
            //load container barang
            $.ajax({
                url:'/katalog/load-barang/'+id,
                type:'get',
                dataType:'html',
            }).done(function(data) {
                $('#container_barang').empty().html(data);
                $('#mdl').modal('show');
            }).fail(function(x,y,z){

            });
        }
    </script>
@endsection

