@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Setting Web</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit setting web</h3>
                        </div>
                        @if($jumlah > 0)
                        @foreach($data as $row)
                        <form method="POST" role="form" enctype="multipart/form-data" action="{{url('backend/setting-web')}}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Program</label>
                                    <input type="text" class="form-control" value="{{$row->nama}}" name="nama" required
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Singkatan Nama Program</label>
                                    <input type="text" class="form-control" value="{{$row->singkatan}}" name="singkatan"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea name="deskripsi"
                                        class="form-control textarea">{!!$row->deskripsi!!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Promo</label>
                                    <textarea name="promot"
                                        class="form-control textarea">{!!$row->promo!!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Motto</label>
                                    <textarea name="moto" class="form-control">{{$row->moto}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta</label>
                                    <textarea name="meta" class="form-control">{{$row->meta}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" value="{{$row->email}}" name="email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. telpon Pertama</label>
                                    <input type="text" class="form-control" value="{{$row->telp_satu}}" name="telp_satu"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. telpon Kedua</label>
                                    <input type="text" class="form-control" value="{{$row->telp_dua}}" name="telp_dua"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Facebook</label>
                                    <input type="text" class="form-control" value="{{$row->link_fb}}" name="link_fb">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Instagram</label>
                                    <input type="text" class="form-control" value="{{$row->link_ig}}" name="link_ig">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Youtbe</label>
                                    <input type="text" class="form-control" value="{{$row->link_youtube}}"
                                        name="link_youtube">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Android</label>
                                    <input type="text" class="form-control" value="{{$row->link_android}}"
                                        name="link_android">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Apple</label>
                                    <input type="text" class="form-control" value="{{$row->link_iphone}}"
                                        name="link_iphone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Logo</label><br>
                                    <img src="{{asset('images/setting/'.$row->logo)}}" alt="" width="150px"
                                        class="img-thumbnail"><br>
                                    <input type="file" class="form-control" name="logo" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Favicon</label><br>
                                    <img src="{{asset('images/setting/'.$row->favicon)}}" alt="" width="150px"
                                        class="img-thumbnail"><br>
                                    <input type="file" class="form-control" name="favicon" accept="image/*">
                                    <input type="hidden" name="kode" value="{{$row->id}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-dark float-right">Simpan</button>
                            </div>
                        </form>
                        @endforeach
                        @else
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>Info!</h4>
                                Tambahkan 1 data manual pada tabel <b>web_setting</b>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
@endpush

@push('customscripts')

<script>
$(function() {
    $('.textarea').summernote({
        height: 200,
    });
})
</script>
@endpush
