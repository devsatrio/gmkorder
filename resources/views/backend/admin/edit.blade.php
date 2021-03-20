@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Admin</h1>
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
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <form method="POST" onsubmit="return validasiinput();" role="form" enctype="multipart/form-data"
                            action="{{url('backend/admin/'.$data->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="{{$data->name}}"
                                                required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{$data->username}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{$data->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No. Telp</label>
                                            <input type="text" class="form-control" name="telp" value="{{$data->telp}}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <img src="{{asset('img/admin/'.$data->gambar)}}" alt="">
                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Gambar Baru*</label>
                                            <input type="file" class="form-control" name="gambar" accept="image/*">
                                            <input type="hidden" name="gambar_lama" value="{{$data->gambar}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Level</label>
                                            <select name="level" class="form-control">
                                                <option value="Admin" @if($data->level=="Admin") selected @endif>Admin
                                                </option>
                                                <option value="Super Admin" @if($data->level=="Super Admin") selected
                                                    @endif>Super
                                                    Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status Customer Service</label>
                                            <select name="status_cs" class="form-control">
                                                <option value="Non Aktif" @if($data->status_cs=="Non Aktif") selected @endif>Non Aktif</option>
                                                <option value="Aktif" @if($data->status_cs=="Aktif") selected @endif>Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password Baru*</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Konfirmasi Password Baru*</label>
                                            <input type="password" class="form-control" id="kpassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-dark float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script src="{{asset('customjs/backend/admin_input.js')}}"></script>
@endpush