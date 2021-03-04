@extends('frontend.index')
@section('css')
    <style>
        .round-image, .card{
            border-radius: 10%;
        }

        .text-title{
            text-align: center;
            font-size: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
<main class="page catalog-page">
    <section class="clean-block clean-catalog dark">
        <div class="container">
            <div class="block-heading">
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner">
                        <div class="carousel-item active"><img class="w-100 d-block" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                            data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
            <section class="clean-block clean-services ">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">Katalog GMK</h2>
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
            {{-- <section class="clean-block clean-services dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">Promo gmk</h2>
                    </div>

                </div>
            </section> --}}
        </div>
    </section>
</main>

@endsection
