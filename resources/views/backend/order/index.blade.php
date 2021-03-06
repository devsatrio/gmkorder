@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> List Order</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">List Data Order Online</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Faktur</th>
                                            <th>Pembeli</th>
                                            <th>Tgl Beli</th>
                                            <th>Metode</th>
                                            <th>Kurir</th>
                                            <th>Total</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center text-white">
                                                <input type="checkbox" class="ckbloket" name="csd" id="csdata" onclick="cekaalldata()">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Faktur</th>
                                            <th>Pembeli</th>
                                            <th>Tgl Beli</th>
                                            <th>Metode</th>
                                            <th>Kurir</th>
                                            <th>Total</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="button" style="display: none" onclick="hapusbanyak()" id="hapusbtn"
                                class="btn mb-2 btn-warning btn-sm float-right mt-3">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center" id="loadingdetail">
                        <span class="text-muted" id="msgdetail">Loading...</span>
                    </div>
                    <div class="col-12" id="tampildetail">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <small id="tampilkode"></small>
                                        <small class="float-right" id="tampiltgl"></small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Pembeli
                                    <address>
                                        <strong id="tampilnamapembeli"></strong><br>
                                        <span id="tampilalamatpembeli"></span><br>
                                        <span id="tampiltelppembeli"></span><br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Dikirim Kepada
                                    <address>
                                        <strong id="tampilnamapenerima"></strong><br>
                                        <span id="tampilalamatpenerima"></span><br>
                                        <span id="tampiltelppenerima"></span><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Admin : </b> <span id="tampiladmin"></span><br>
                                    <b>Metode :</b> <span id="tampilmetode"></span><br>
                                    <b>Kurir :</b> <span id="tampilkurir"></span>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                                <th>Diskon</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tubuhdetailtrx">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p id="tampilketerangan" class="text-muted well well-sm shadow-none"
                                        style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                                        heekya handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td id="tampilsubtotal"></td>
                                                </tr>
                                                <tr>
                                                    <th>Ongkir:</th>
                                                    <td id="tampilongkir"></td>
                                                </tr>
                                                <tr>
                                                    <th>Potongan / Diskon:</th>
                                                    <td id="tampilpotongan"></td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td><b><span id="tampiltotal"></span></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="hidden_div" style="display:none;">
    <table width="100%">
        <tr>
            <td width="100%">
                <span style="font-size:10px;">Grosir Murah Kediri</span><br>
                <hr style="border-top: 1px dashed;">
                <span style="font-size:10px;" id="notafaktur"></span><br>
                <span style="font-size:10px;" id="notatgl"></span>
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
                </table>
                <hr style="border-top: 1px dashed;">
                <span style="font-size:10px;">Terima kasih atas kunjungan anda <br> Barang yang telah di beli tidak bisa
                    di tukar atau dikembalikan</span>
            </td>
        </tr>
    </table>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script src="{{asset('customjs/backend/listorder.js')}}"></script>
@endpush