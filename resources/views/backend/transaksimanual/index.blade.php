@extends('layouts/base')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2 mt-3">
            <div class="col-sm-12 text-center">
                <h1 class="m-0 text-dark"> Transaksi Manual</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluit">
        <div class="row pl-4 pr-4">
            <div class="col-12">
                @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
        <form method="POST" class="row pl-4 pr-4" enctype="multipart/form-data" onsubmit="return validform()"
            action="{{url('transaksi-manual')}}">
            <div class="col-md-5">
                <div class="card card-outline card-dark" id="panelnya">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Transaksi</label>
                                    <input type="text" class="form-control" name="resi" id="resi" value="{{$kode}}"
                                        readonly autofocus>
                                    <input type="hidden" name="admin" value="{{Auth::user()->id}}" id="admin">
                                    <input type="hidden" name="statusadmin" value="{{Auth::user()->level}}"
                                        id="statusadmin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin</label>
                                    <input type="text" class="form-control" name="admin"
                                        value="{{Auth::user()->username}}" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Pelanggan</label>
                                <select name="produk" class="form-control select2">
                                    @foreach($pelanggan as $plg)
                                    <option value="{{$plg->id}}">{{$plg->nama}}</option>
                                    @endforeach
                                </select>

                                <button class="btn btn-dark btn-sm" id="add-pelanggan" type="button">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Pelanggan
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Produk</label>
                                <div class="nk-int-st">
                                    <select name="produk" id="produk" class="form-control select2">
                                        @foreach($barang as $brg)
                                        <option value="{{$brg->id}}">{{$brg->kode}} - {{$brg->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Stok</label>
                                <div class="nk-int-st">
                                    <input type="number" readonly class="form-control" name="stok" id="stok">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Jumlah</label>
                                <div class="nk-int-st">
                                    <input type="number" min="0" class="form-control" id="jumlah" name="jumlah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Harga</label>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" id="btnsimpan" class="btn btn-dark float-right">Tambah Produk <i
                                class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-outline card-dark" id="paneldua">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Produk</th>
                                        <th>Varian</th>
                                        <th>Harga</th>
                                        <th class="text-center">Qty</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody id="tubuh">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6"><b>Total</b></td>
                                        <td class="text-center"><span id="totalpcs"></span></td>
                                        <td class="text-right"><span id="total"></span></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-lg btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                        <button class="btn btn-lg btn-dark" type="submit" id="simpanbtn">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('loading/jquery.loading.js')}}"></script>
@endpush

@push('customscripts')
<script src="{{asset('customjs/backend/transaksimanual.js')}}"></script>
@endpush