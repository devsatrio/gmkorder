@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
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
                <div class="col-lg-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Laporan Detail Transaksi {{$_GET['finaltgl']}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-default btn-sm" id="printtable"><i
                                        class="fas fa-print"></i>
                                    Print
                                </button>
                                <button type="button" class="btn btn-default btn-sm" id="exportexcel"><i
                                        class="fas fa-file-excel"></i>
                                    Export Excel
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Pembeli</th>
                                            <th>Admin</th>
                                            <th>Subtotal</th>
                                            <th>Potongan</th>
                                            <th>Ongkir</th>
                                            <th>Cash</th>
                                            <th>Vocher</th>
                                            <th>Transfer</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        $total=0;
                                        @endphp
                                        @foreach($data as $row)
                                        @php
                                        $total += $row->total;
                                        @endphp
                                        <tr class="table-primary">
                                            <td><b>{{$i++}}</b></td>
                                            <td><b>{{$row->faktur}}</b></td>
                                            <td><b>{{$row->tgl}}</b></td>
                                            <td><b>{{$row->nama}}</b></td>
                                            <td><b>{{$row->username}}</b></td>
                                            <td class="text-right">
                                                <b>{{"Rp ". number_format($row->subtotal,0,',','.')}}</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{"Rp ". number_format($row->diskon,0,',','.')}}</b>
                                            </td>
                                            <td class="text-right">
                                                <b>{{"Rp ". number_format($row->ongkir,0,',','.')}}</b>
                                            </td>
                                            <td class="text-right"><b>
                                                    {{"Rp ". number_format($row->dibayar_cash,0,',','.')}}</b></td>
                                            <td class="text-right"><b>
                                                    {{"Rp ". number_format($row->dibayar_voucher,0,',','.')}}</b></td>
                                            <td class="text-right"><b>
                                                    {{"Rp ". number_format($row->dibayar_transfer,0,',','.')}}</b></td>
                                            <td class="text-right">
                                                <b>{{"Rp ". number_format($row->total,0,',','.')}}</b>
                                            </td>
                                        </tr>
                                        @php
                                        $datadetail = DB::table('thumb_detail_transaksi')
                                        ->select(DB::raw('thumb_detail_transaksi.*,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama
                                        as namaproduk,warna.nama as namawarna,size.nama as namasize'))
                                        ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
                                        ->leftjoin('produk','produk.kode','=','produk_kode')
                                        ->leftjoin('warna','warna.id','=','warna_id')
                                        ->leftjoin('size','size.id','=','size_id')
                                        ->where('thumb_detail_transaksi.kode_transaksi',$row->faktur)
                                        ->get();
                                        @endphp
                                        @foreach($datadetail as $dtl)
                                        <tr class="table-secondary">
                                            <td colspan="2" class="pb-0 pt-0">{{$dtl->namaproduk}} ({{$dtl->namawarna}}
                                                - {{$dtl->namasize}})</td>
                                            <td class="pb-0 pt-0">{{$dtl->jumlah}} Pcs</td>
                                            <td class="text-right pb-0 pt-0">
                                                {{"Rp ". number_format($dtl->harga,0,',','.')}}</td>
                                            <td class="pb-0 pt-0">{{$dtl->diskon}} %</td>
                                            <td class="text-right pb-0 pt-0">
                                                {{"Rp ". number_format($dtl->subtotal,0,',','.')}}</td>
                                            <td colspan="6" class="pb-0 pt-0"></td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        <tr>
                                            <td colspan="9"><b>Total</b></td>
                                            <td colspan="3" class="text-right">
                                                <b>{{"Rp ". number_format($total,0,',','.')}}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cetaktabel" style="display:none;">
    <table border="1" style="border-collapse: collapse;border: 1px solid black;">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Faktur</th>
                <th style="border: 1px solid black;">Tanggal</th>
                <th style="border: 1px solid black;">Pembeli</th>
                <th style="border: 1px solid black;">Admin</th>
                <th style="border: 1px solid black;">Subtotal</th>
                <th style="border: 1px solid black;">Potongan</th>
                <th style="border: 1px solid black;">Ongkir</th>
                <th style="border: 1px solid black;">Cash</th>
                <th style="border: 1px solid black;">Vocher</th>
                <th style="border: 1px solid black;">Transfer</th>
                <th style="border: 1px solid black;">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            $total=0;
            @endphp
            @foreach($data as $row)
            @php
            $total += $row->total;
            @endphp
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"><b>{{$i++}}</b></td>
                <td style="border: 1px solid black;"><b>{{$row->faktur}}</b></td>
                <td style="border: 1px solid black;"><b>{{$row->tgl}}</b></td>
                <td style="border: 1px solid black;"><b>{{$row->nama}}</b></td>
                <td style="border: 1px solid black;"><b>{{$row->username}}</b></td>
                <td style="border: 1px solid black;" alignt="right">
                    <b>{{"Rp ". number_format($row->subtotal,0,',','.')}}</b>
                </td>
                <td style="border: 1px solid black;" alignt="right">
                    <b>{{"Rp ". number_format($row->diskon,0,',','.')}}</b>
                </td>
                <td style="border: 1px solid black;" alignt="right">
                    <b>{{"Rp ". number_format($row->ongkir,0,',','.')}}</b>
                </td>
                <td class="text-right"><b>
                        {{"Rp ". number_format($row->dibayar_cash,0,',','.')}}</b></td>
                <td class="text-right"><b>
                        {{"Rp ". number_format($row->dibayar_voucher,0,',','.')}}</b></td>
                <td class="text-right"><b>
                        {{"Rp ". number_format($row->dibayar_transfer,0,',','.')}}</b></td>
                <td style="border: 1px solid black;" alignt="right">
                    <b>{{"Rp ". number_format($row->total,0,',','.')}}</b>
                </td>
            </tr>
            @php
            $datadetail = DB::table('thumb_detail_transaksi')
            ->select(DB::raw('thumb_detail_transaksi.*,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama
            as namaproduk,warna.nama as namawarna,size.nama as namasize'))
            ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
            ->leftjoin('produk','produk.kode','=','produk_kode')
            ->leftjoin('warna','warna.id','=','warna_id')
            ->leftjoin('size','size.id','=','size_id')
            ->where('thumb_detail_transaksi.kode_transaksi',$row->faktur)
            ->get();
            @endphp
            @foreach($datadetail as $dtl)
            <tr style="border: 1px solid black;">
                <td colspan="2" style="border: 1px solid black;">{{$dtl->namaproduk}} ({{$dtl->namawarna}} -
                    {{$dtl->namasize}})</td>
                <td style="border: 1px solid black;">{{$dtl->jumlah}} Pcs</td>
                <td style="border: 1px solid black;" alignt="right">{{"Rp ". number_format($dtl->harga,0,',','.')}}</td>
                <td style="border: 1px solid black;">{{$dtl->diskon}} %</td>
                <td style="border: 1px solid black;" alignt="right">{{"Rp ". number_format($dtl->subtotal,0,',','.')}}
                </td>
                <td colspan="6" style="border: 1px solid black;"></td>
            </tr>
            @endforeach
            @endforeach
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;" colspan="9"><b>Total</b></td>
                <td style="border: 1px solid black;" colspan="3" alignt="right">
                    <b>{{"Rp ". number_format($total,0,',','.')}}</b>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/tableexport/tableExport.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/tableexport/jquery.base64.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(document).ready(function() {
    $("#exportexcel").click(function() {
        $('#list-data').tableExport({
            format: 'xls',
            filename: 'Laporan Detail Transaksi',
        });
    });

    $("#printtable").click(function() {
        var divToPrint = document.getElementById('cetaktabel');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print();window.close()">' + divToPrint
            .innerHTML + '</body></html>');
        newWin.document.close();
    });
});
</script>
@endpush