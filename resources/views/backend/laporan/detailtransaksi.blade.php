@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Laporan Detail Transaksi</h1>
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
                            <h3 class="card-title">Cari Data</h3>
                        </div>
                        <form method="GET" role="form" enctype="multipart/form-data"
                            action="{{url('backend/laporan-detail-transaksi/tampil')}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="tanggal">
                                        <input type="hidden" name="finaltgl" id="finaltgl" value="{{date('Y-m-d')}}|{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Pembayaran</label>
                                    <div class="input-group">
                                        <select name="tipe" class="form-control">
                                            <option value="Semua">Semua</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Vocher">Vocher</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-dark float-right">Tampilkan Laporan</button>
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
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(function() {
  $('#tanggal').daterangepicker({
    "startDate": "{{date('m/d/Y')}}",
    "endDate": "{{date('m/d/Y')}}"
    }, function(start, end, label) {
      $('#finaltgl').val(start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD'));
  });
});
</script>
@endpush