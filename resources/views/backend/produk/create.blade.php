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
                            <h3 class="card-title">Tambah Produk</h3>
                        </div>
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{url('backend/produk')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode</label>
                                            <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                                value="{{old('kode')}}" name="kode" required autofocus>
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
                                                <option value="{{$kat->id}}">{{$kat->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Produk</label>
                                            <input type="text" class="form-control" value="{{old('nama')}}" name="nama"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                                <option value="Habis">Habis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"
                                        rows="5">{{old('deskripsi')}}</textarea>
                                </div>
                                <hr>
                                <div id="varianlist">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Warna / Motif</label>
                                                <select name="warna[]" class="form-control">
                                                    @foreach($warna as $wrn)
                                                    <option value="{{$wrn->id}}">{{$wrn->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Size</label>
                                                <select name="size[]" class="form-control">
                                                    @foreach($size as $sz)
                                                    <option value="{{$sz->id}}">{{$sz->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if(Auth::user()->level!='Admin')
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">HPP</label>
                                                <input type="number" class="form-control" value="0" name="hpp[]"
                                                    required>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">HPP</label>
                                                <input type="number" class="form-control" value="0" name="hpp[]"
                                                    readonly>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Harga Jual</label>
                                                <input type="number" class="form-control" value="0" name="harga_jual[]"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Diskon (%)</label>
                                                <input type="number" class="form-control" value="0" max="99"
                                                    name="diskon[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Foto</label>
                                                <input type="file" class="form-control" accept="image/*"
                                                    name="gambar_warna[]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" onclick="new_link()"
                                            class="btn btn-dark btn-sm float-right">Tambah
                                            Varian</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar Utama</label>
                                            <input type="file" class="form-control" name="gambar" accept="image/*"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar Lain</label>
                                            <input type="file" class="form-control" name="gambarlain[]" id="gambarlain"
                                                accept="image/*" multiple required>
                                            <span class="text-muted">Maksimal 3 foto</span>
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
<div id="newvarianlist" style="display:none">
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Warna / Motif</label>
                <select name="warna[]" class="form-control">
                    @foreach($warna as $wrn)
                    <option value="{{$wrn->id}}">{{$wrn->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Size</label>
                <select name="size[]" class="form-control">
                    @foreach($size as $sz)
                    <option value="{{$sz->id}}">{{$sz->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if(Auth::user()->level!='Admin')
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">HPP</label>
                <input type="number" class="form-control" value="0" name="hpp[]" required>
            </div>
        </div>
        @else
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">HPP</label>
                <input type="number" class="form-control" value="0" name="hpp[]" readonly>
            </div>
        </div>
        @endif
        
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Jual</label>
                <input type="number" class="form-control" value="0" name="harga_jual[]" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Diskon (%)</label>
                <input type="number" class="form-control" value="0" max="99" name="diskon[]" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Foto</label>
                <input type="file" class="form-control" value="0" name="gambar_warna[]" required>
            </div>
        </div>
    </div>
</div>
@endsection
@push('customscripts')
<script>
var ct = 1;
var cx = 1;

function new_link() {
    ct++;
    cx++;
    if (cx > 10) {
        alert('Maaf, Max 10 varian');
    } else {
        var div1 = document.createElement('div');
        div1.id = ct;
        var delLink = '<a href="javascript:delIt(' + ct +
            ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Variasi</a><br>';
        div1.innerHTML = document.getElementById('newvarianlist').innerHTML + delLink;
        document.getElementById('varianlist').appendChild(div1);
    }
}

function delIt(eleId) {
    cx -= 1;
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('varianlist');
    parentEle.removeChild(ele);
}

$("#gambarlain").on("change", function() {
    if ($("#gambarlain")[0].files.length > 3) {
        alert("You can select only 3 images");
        $("#gambarlain").val('');
    }
});
</script>
@endpush