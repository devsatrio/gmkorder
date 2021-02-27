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
                        <div class="col-md-6 col-lg-4">
                            <div class="card"><img class="card-img-top w-100 d-block" height="450" src="{{asset('img/produk/'.$p->gambar_utama)}}">
                                <div class="card-body">
                                    <h4 class="card-title">{{$p->nama}}</h4>
                                </div>
                                <div><button class="btn btn-outline-primary btn-sm" type="button"><i class="fa fa-shopping-cart"></i></button></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
