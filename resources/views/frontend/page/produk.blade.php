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
                                            <img class="lazy card-img-top img-fluid d-block mx-auto w-100" src="{{asset('assets/img/loader.gif')}}" data-src="{{asset('img/produk/'.$p->gambar_utama)}}">
                                        {{-- </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{$p->nama}}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
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
@push('js_in')
{{-- <script src="{{asset('assets/dist/js/lazyload.min.js')}}"></script> --}}
    <script>
      (function () {
        var ll = new LazyLoad({
          threshold: 0,
        });
      })();
    </script>
@endpush

