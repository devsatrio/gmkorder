<nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
        <a href="{{url('backend/dashboard')}}" class="navbar-brand">
            <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8"> -->
            <span class="brand-text font-weight-light">GMK-ORDER</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{url('backend/dashboard')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">Master Data</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{url('backend/admin')}}" class="dropdown-item">Admin </a></li>
                        <li><a href="{{url('backend/pengguna')}}" class="dropdown-item">Pengguna</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="{{url('backend/kategori-produk')}}" class="dropdown-item">Kategori Produk</a></li>
                        <li><a href="{{url('backend/warna')}}" class="dropdown-item">Warna / Motif</a></li>
                        <li><a href="{{url('backend/size')}}" class="dropdown-item">Size</a></li>
                        <li><a href="{{url('backend/produk')}}" class="dropdown-item">Produk</a></li>
                        <li><a href="{{url('backend/penyesuaian-stok')}}" class="dropdown-item">Penyesuaian Stok</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">Transaksi</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{url('backend/transaksi-manual')}}" class="dropdown-item">Transaksi Manual </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a href="{{url('backend/list-order')}}" class="dropdown-item">List Order</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="{{url('backend/list-transaksi')}}" class="dropdown-item">List Transaksi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" id="btnbell">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge" id="tandanotif" style="display:none;">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">Order Terbaru</span>
                    <div class="dropdown-divider"></div>
                    <div id="listnotif">
                        @php
                        $notif = DB::table('trx_umum')->where('sts','belum')->orderby('id','desc')->limit(10)->get();
                        @endphp
                        @foreach($notif as $not)
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-shopping-cart mr-2"></i> {{$not->nama}} Membuat Order Baru
                            <br><span class="text-muted text-sm">{{$not->created_at}}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('backend/list-order')}}" class="dropdown-item dropdown-footer">Lihat Semua Order</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{route('editprofile')}}" class="dropdown-item">
                        Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        class="dropdown-item">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </div>
</nav>