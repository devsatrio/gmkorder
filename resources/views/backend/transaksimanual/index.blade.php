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
        <div class="row pl-4 pr-4">
            <div class="col-md-5">
                <div class="card card-outline card-dark" id="panelnya">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No. Transaksi</label>
                                    <input type="text" class="form-control" name="resi" id="resi" value="{{$kode}}"
                                        readonly>
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
                                <select name="pelanggan" id="caripelanggan" class="form-control select2">
                                    @foreach($pelanggan as $plg)
                                    <option value="{{$plg->id}}">{{$plg->nama}}</option>
                                    @endforeach
                                </select>

                                <button class="btn btn-dark btn-sm mt-2" id="add-pelanggan" type="button">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Pelanggan
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Produk</label>
                                <div class="nk-int-st">
                                    <select name="produk" id="produk" class="form-control select2">
                                        @foreach($barang as $brg)
                                        <option value="{{$brg->id}}">{{$brg->produk_kode}} - {{$brg->nama}} ||
                                            {{$brg->namawarna}} || {{$brg->namasize}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <label>Diskon</label>
                                <div class="nk-int-st">
                                    <div class="input-group mb-3">
                                        <input type="number" readonly class="form-control" name="diskon" id="diskon">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Stok</label>
                                <div class="nk-int-st">
                                    <input type="number" readonly class="form-control" name="stok" id="stok">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Harga</label>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="harga" id="harga">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Jumlah</label>
                                <div class="nk-int-st">
                                    <input type="number" min="0" class="form-control" id="jumlah" name="jumlah">
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
                                        <th>Diskon</th>
                                        <th class="text-center">Qty</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody id="tubuh">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5"><b>Total</b></td>
                                        <td class="text-center"><b><span id="totalpcs"></span></b></td>
                                        <td><b><span id="total"></span></b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="subtotal" id="subtotal">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Metode Pengiriman</label>
                                        <div class="nk-int-st">
                                            <select name="metode" id="metode" onchange="gantimetode()"
                                                class="form-control">
                                                <option value="Toko">Ambil Di Toko</option>
                                                <option value="Kirim">Kirim Paket</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="formkirim" style="display:none;">
                                        <div class="form-group">
                                            <label>Kurir</label>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="kurir" id="kurir">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Telp Penerima</label>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="telppenerima"
                                                    id="telppenerima">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penerima</label>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="namapenerima"
                                                    id="namapenerima">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Penerima</label>
                                            <div class="nk-int-st">
                                                <textarea name="alamat" id="alamat" cols="5"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <div class="nk-int-st">
                                            <textarea name="alamat" id="keterangan" cols="5"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Potongan</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" min="0" value="0" onchange="hitungtotal()"
                                            name="potongan" id="potongan">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ongkir</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" min="0" value="0" onchange="hitungtotal()" name="ongkir"
                                            id="ongkir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dibayar Cash</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" min="0" value="0" onchange="hitungtotal()" name="cash"
                                            id="cash">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dibayar Vocher</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" min="0" value="0" onchange="hitungtotal()" name="vocher"
                                            id="vocher">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dibayar Transfer</label>
                                    <div class="nk-int-st">
                                        <input type="number" class="form-control" min="0" value="0" onchange="hitungtotal()" name="transfer"
                                            id="transfer">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Subtotal</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5><b><span id="tampilsubtotal">RP. 0</span></b></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Potongan</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5><b><span id="tampilpotongan">RP. 0</span></b></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ongkir</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5><b><span id="tampilongkir">RP. 0</span></b></h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h3><b><span id="totalakhir">RP. 0</span></b></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Dibayar</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5><b><span id="tampildibayar">RP. 0</span></b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                    <input type="hidden" name="datatotalnya" value="0" id="datatotalnya">
                    <input type="hidden" name="datadibayarnya" value="0" id="datadibayarnya">
                        <button class="btn btn-lg btn-danger" type="button" onclick="history.go(-1)">Kembali</button>
                        <button class="btn btn-lg btn-dark" type="submit" id="simpanbtn">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addpelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text" class="form-control" id="usernamepelanggan">
                </div>
                <div class="form-group">
                    <label for="email">Nama</label>
                    <input type="text" class="form-control" id="namapelanggan">
                </div>
                <div class="form-group">
                    <label for="pwd">Alamat</label>
                    <input type="text" class="form-control" id="alamatpelanggan">
                </div>
                <div class="form-group">
                    <label for="pwd">No.Telp</label>
                    <input type="text" class="form-control" id="telppelanggan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="simpanpelanggan" class="btn btn-dark">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div id="hidden_div" style="display:none;">
    <table width="50%">
        <tr>
            <td width="100%">
                <span style="font-size:10px;">Grosir Murah Kediri</span><br>
                <hr style="border-top: 1px dashed;">
                <span style="font-size:10px;">{{date('Y/m/d')}}</span><br>
                <span style="font-size:10px;">{{$kode}}</span>
                <hr style="border-top: 1px dashed;">
                <table width="100%">
                    <tr>
                        <td><span style="font-size:10px;">Nama</span></td>
                        <td><span style="font-size:10px;">qty</span></td>
                        <td><span style="font-size:10px;">Harga</span></td>
                        <td><span style="font-size:10px;">Diskon</span></td>
                        <td><span style="font-size:10px;">Subtotal</span></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <hr style="border-top: 1px dashed;">
                        </td>
                    </tr>
                    <tbody id="cetaktabel">
                    </tbody>
                    <tr>
                        <td colspan="6">
                            <hr style="border-top: 1px dashed;">
                        </td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Subtotal</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notasubtotal"></span></td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Potongan/Diskon</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notapotongan"></span></td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Ongkir</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notaongkir"></span></td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Total</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notatotal"></span></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <hr style="border-top: 1px dashed;">
                        </td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Dibayar Cash</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notacash"></span></td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Dibayar Vocher</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notavocher"></span></td>
                    </tr>
                    <tr>
                        <td><span style="font-size:10px;">Dibayar Transfer</span></td>
                        <td><span style="font-size:10px;" colspan="5" id="notatransfer"></span></td>
                    </tr>
                </table>
                <hr style="border-top: 1px dashed;">
                <span style="font-size:10px;">Terima kasih atas kunjungan anda <br> Barang yang telah di beli tidak bisa di tukar atau dikembalikan</span>
            </td>
        </tr>
    </table>
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