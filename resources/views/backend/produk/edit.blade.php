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
                @foreach($barang as $row)
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Produk</h3>
                        </div>
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{url('backend/produk/'.$row->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode</label>
                                            <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                                value="{{$row->kode}}" name="kode" required autofocus>
                                            @error('kode')
                                            <span class="text-danger">Error : {{ $message }}</span><br>
                                            @enderror
                                            <span class="text-muted">Pastikan Kode produk unik / tidak sama dengan kode
                                                produk
                                                lainnya</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kategori Produk</label>
                                            <select name="kategori" class="form-control">
                                                @foreach($kategori as $kat)
                                                <option value="{{$kat->id}}" @if($row->kategori_produk==$kat->id)
                                                    selected
                                                    @endif>{{$kat->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Produk</label>
                                            <input type="text" class="form-control" value="{{$row->nama}}" name="nama"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Aktif" @if($row->status=='Aktif') selected @endif>Aktif</option>
                                                <option value="Non Aktif" @if($row->status=='Non Aktif') selected @endif>Non Aktif</option>
                                                <option value="Habis" @if($row->status=='Habis') selected @endif>Habis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">HPP</label>
                                            <input type="number" class="form-control" value="{{$row->hpp}}" name="hpp"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga Jual</label>
                                            <input type="number" class="form-control" value="{{$row->harga_jual}}"
                                                name="harga_jual" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"
                                        rows="8">{{$row->deskripsi}}</textarea>
                                </div>
                                @if($row->gambar_utama!='')
                                <br>
                                <img src="{{asset('img/produk/'.$row->gambar_utama)}}" alt="" class="img-thumbnail"
                                    width="150px;">
                                <br>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar Utama</label>
                                    <input type="file" class="form-control" name="gambar" accept="image/*">
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{url('backend/produk')}}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-dark float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Detail Gambar Produk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                    data-target="#tambah-gambar"><i class="fas fa-plus"></i>
                                    Tambah
                                    Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (session('statusimage'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h4>Info!</h4>
                                        {{ session('statusimage') }}
                                    </div>
                                </div>
                                @endif
                                @foreach($gambarbarang as $gmr)
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <img src="{{asset('img/gambarproduk/'.$gmr->nama)}}" alt=""
                                                class="img-thumbnail">
                                        </div>
                                        <form action="{{url('backend/produk/hapus-gambar/'.$gmr->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <div class="card-footer">
                                                <button type="submit" onclick="return confirm('Hapus Gambar ?')" class="btn btn-danger btn-block"><i class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="tambah-gambar" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h4 class="modal-title">Tambah Gambar</h4>

                            </div>
                            <form action="{{url('backend/produk/add-gambar-produk')}}" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="kode" value="{{$row->kode}}">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gambar</label>
                                        <input type="file" class="form-control" name="gambarproduk" accept="image/*"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection