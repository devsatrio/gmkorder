<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="/">{{CekNotif::namaWeb()->nama}}</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link active" href="{{route('beranda')}}">Katalog</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="service-page.html">Tentang</a></li> --}}
                <li class="nav-item"><a class="nav-link" href="https://api.whatsapp.com/send?phone={{CekNotif::getNoTelp()->telp}}&text=%2A%2AASK%2A%2A">Hubungi Kami</a></li>
                <li class="nav-item float-right">
                    <form class="form-inline" method="GET" action="{{route('cari-produk')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="cproduk" class="form-control mr-2" placeholder="Cari Keperluanmu Disini !">
                            <button  type="submit" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
