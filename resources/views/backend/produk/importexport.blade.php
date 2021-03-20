@extends('layouts/base')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Produk</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Import / Export Produk</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <div class="card card-dark card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-two-home-tab"
                                                        data-toggle="pill" href="#custom-tabs-two-home" role="tab"
                                                        aria-controls="custom-tabs-two-home" aria-selected="false">Cara
                                                        Import Produk</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-two-profile-tab"
                                                        data-toggle="pill" href="#custom-tabs-two-profile" role="tab"
                                                        aria-controls="custom-tabs-two-profile"
                                                        aria-selected="true">Cara Import Varian Produk</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <div class="tab-pane fade active show" id="custom-tabs-two-home"
                                                    role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                    <h3><b>Cara Import</b></h3>
                                                    <ol class="pl-4">
                                                        <li>Download Data kategori dengan tekan link <b>Export Data
                                                                Kategori
                                                                Produk</b></li>
                                                        <li>Download template import dengan menekan link <b>Download
                                                                Template
                                                                Import Produk</b> </li>
                                                        <li>Isi semua data di template import sesuai ketentuan.</li>
                                                        <li>Upload template import yang telah di isi di inputan
                                                            <b>Import File
                                                                Produk Excel</b>
                                                        </li>
                                                        <li>Klik <b>simpan</b> untuk menyimpan data</li>
                                                    </ol>
                                                    <h5><b>Ketentuan Pengisian Data</b></h5>
                                                    <ul class="pl-4">
                                                        <li><b>Kode</b> harus diisi dan unik / berbeda dari kode produk
                                                            lain</li>
                                                        <li><b>Nama</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            string</li>
                                                        <li><b>Kategori_id</b> harus di isi dan sesuai dengan id
                                                            kategori yang
                                                            berasal dari file <b>Export Data Kategori Produk</b></li>
                                                        <li><b>Deskripsi</b> harus di isi dan jangan menggunakan karater
                                                            spesial
                                                            selain string</li>

                                                        <li><b>status</b> harus di isi dan memilih salah satu opsi
                                                            status yaitu :
                                                            <b>Aktif</b>, <b>Non Aktif</b>, <b>Habis</b>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                                    aria-labelledby="custom-tabs-two-profile-tab">
                                                    <h3><b>Cara Import</b></h3>
                                                    <ol class="pl-4">
                                                        <li>Download Data Warna & Size dengan tekan link <b>Export Data
                                                                Warna Produk</b> & <b>Export Data Size Produk</b></li>
                                                        <li>Download template import dengan menekan link <b>Download
                                                                Template
                                                                Import Varian Produk</b> </li>
                                                        <li>Isi semua data di template import sesuai ketentuan.</li>
                                                        <li>Upload template import yang telah di isi di inputan
                                                            <b>Import File
                                                                Varian Produk Excel</b>
                                                        </li>
                                                        <li>Klik <b>simpan</b> untuk menyimpan data</li>
                                                    </ol>
                                                    <h5><b>Ketentuan Pengisian Data</b></h5>
                                                    <ul class="pl-4">
                                                        <li><b>kode_produk</b> isikan sesuai dengan kode produk yang
                                                            akan di tambah variannya</li>
                                                        <li><b>warna_id</b> harus di isi dan sesuai dengan id
                                                            warana yang berasal dari file <b>Export Data Warna
                                                                Produk</b></li>
                                                        <li><b>size_id</b> harus di isi dan sesuai dengan id
                                                            warana yang berasal dari file <b>Export Data Size Produk</b>
                                                        </li>
                                                        <li><b>hpp</b> harus di isi menggunakan angka tanpa titik, koma
                                                            dan karakter
                                                            lain (contoh : 25000)</li>
                                                        <li><b>diskon</b> harus diisi presentase diskon antaran 0 sampai
                                                            99</li>
                                                        <li><b>harga_jual</b> harus di isi menggunakan angka tanpa
                                                            titik, koma dan
                                                            karakter lain (contoh : 25000)</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    @if(Session::get('errorexcel'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error Logs :</strong>
                                        <ul>
                                            @foreach (Session::get('errorexcel') as $failure)
                                            @foreach ($failure->errors() as $error)
                                            <li><b>Field {{$failure->attribute()}} error</b> {{ $error }} ( in Line
                                                {{$failure->row()}} ) </li>
                                            @endforeach
                                            @endforeach
                                        </ul>
                                        <hr>
                                        <b>NB : Semua data tidak disimpan ketika error</b>
                                    </div>
                                    @endif
                                    <form class="mb-3" action="{{url('/backend/import-export/produk/import')}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Import File Produk Excel</label>
                                            <input type="file" id="excelfile" class="form-control mb-2"
                                                name="file_excel" required>
                                            <a href="{{asset('assets/Template_Import_Produk.xls')}}"><i
                                                    class="fa fa-file"></i> Download Template Import Produk</a><br>
                                            <a href="{{url('/backend/import-export/produk-kategori/export')}}"><i
                                                    class="fa fa-file"></i> Export Data Kategori Produk</a>
                                        </div>
                                        <button type="submit" id="submitexport"
                                            class="btn btn-dark float-right ml-2">Simpan</button>
                                    </form>
                                    <br>
                                    <br>
                                    <hr>
                                    <br>
                                    @if(Session::get('errorvarianexcel'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error Logs :</strong>
                                        <ul>
                                            @foreach (Session::get('errorvarianexcel') as $failure)
                                            @foreach ($failure->errors() as $error)
                                            <li><b>Field {{$failure->attribute()}} error</b> {{ $error }} ( in Line
                                                {{$failure->row()}} ) </li>
                                            @endforeach
                                            @endforeach
                                        </ul>
                                        <hr>
                                        <b>NB : Semua data tidak disimpan ketika error</b>
                                    </div>
                                    @endif
                                    <form class="mb-3" action="{{url('/backend/import-export/produk/import-varian')}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Import File Varian Produk Excel</label>
                                            <input type="file" id="excelfile" class="form-control mb-2"
                                                name="file_excel" required>
                                            <a href="{{asset('assets/Template_Import_Varian_Produk.xls')}}"><i
                                                    class="fa fa-file"></i> Download Template Import Varian
                                                Produk</a><br>
                                            <a href="{{url('/backend/import-export/produk-warna/export')}}"><i
                                                    class="fa fa-file"></i> Export Data Warna Produk</a><br>
                                            <a href="{{url('/backend/import-export/produk-size/export')}}"><i
                                                    class="fa fa-file"></i> Export Data Size Produk</a>
                                        </div>
                                        <button type="submit" id="submitexport"
                                            class="btn btn-dark float-right ml-2">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <a href="{{url('/backend/import-export/produk/export')}}"
                                class="btn btn-dark float-right"><i class="fa fa-download"></i> Export Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection