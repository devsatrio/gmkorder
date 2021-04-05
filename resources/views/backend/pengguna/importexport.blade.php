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
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <div class="tab-pane fade active show" id="custom-tabs-two-home"
                                                    role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                    <h3><b>Cara Import</b></h3>
                                                    <ol class="pl-4">
                                                        <li>Download template import dengan menekan link <b>Download
                                                                Template Import Pengguna</b> </li>
                                                        <li>Isi semua data di template import sesuai ketentuan.</li>
                                                        <li>Upload template import yang telah di isi di inputan
                                                            <b>Import File Excel</b>
                                                        </li>
                                                        <li>Klik <b>simpan</b> untuk menyimpan data</li>
                                                    </ol>
                                                    <h5><b>Ketentuan Pengisian Data</b></h5>
                                                    <ul class="pl-4">
                                                        <li><b>Nama</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            string</li>
                                                        <li><b>Username</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            string</li>
                                                        <li><b>Email</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            string</li>
                                                        <li><b>Telp</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            Numeric</li>
                                                        <li><b>Alamat</b> harus di isi dan jangan menggunakan karater
                                                            spesial selain
                                                            string</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
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
                                    <form class="mb-3" action="{{url('/backend/import-export/pengguna/import')}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Import File Excel</label>
                                            <input type="file" id="excelfile" class="form-control mb-2"
                                                name="file_excel" required>
                                            <a href="{{asset('assets/Template_Import_Pengguna.xls')}}"><i
                                                    class="fa fa-file"></i> Download Template Import Pengguna</a>
                                        </div>
                                        <button type="submit" id="submitexport"
                                            class="btn btn-dark float-right ml-2">Simpan</button>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <a href="{{url('/backend/import-export/pengguna/export')}}"
                                class="btn btn-dark float-right"><i class="fa fa-download"></i> Export Data Pengguna</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection