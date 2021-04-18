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
                    <h1 class="m-0 text-dark"> List Transaksi</h1>
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
                            <h3 class="card-title">List Data Transaksi</h3>
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                            <hr>
                                <div class="col-md-4">
                                    <p id="tampilketerangan" class="text-muted well well-sm shadow-none"
                                        style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                                        heekya handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p>
                                </div>
                                <div class="col-md-4">
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
                                                    <th>Potongan:</th>
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
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Cash:</th>
                                                    <td id="tampilcash"></td>
                                                </tr>
                                                <tr>
                                                    <th>Vocher:</th>
                                                    <td id="tampilvocher"></td>
                                                </tr>
                                                <tr>
                                                    <th>Transfer:</th>
                                                    <td id="tampiltransfer"></td>
                                                </tr>
                                                <tr>
                                                    <th>Kembalian:</th>
                                                    <td><b><span id="tampilkembalian"></span></b></td>
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

@endsection

@push('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script src="{{asset('customjs/backend/listtransaksi.js')}}"></script>
@endpush