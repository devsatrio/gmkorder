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
                    <h1 class="m-0 text-dark"> Laporan Detail Per barang</h1>
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
                            <h3 class="card-title">Laporan Detail Per barang {{$_GET['finaltgl']}}</h3>
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
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th colspan="2">Barang</th>
                                            <th>Jumlah Terjual</th>
                                            <th colspan="4" class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        $total=0;
                                        @endphp
                                        @foreach($data as $row)
                                        @php
                                        $total += $row->grandtotal;
                                        @endphp
                                        <tr class="table-primary">
                                            <td>{{$i++}}</td>
                                            <td colspan="2">{{$row->namaproduk}} ({{$row->namawarna}} -
                                                {{$row->namasize}})</td>
                                            <td>{{$row->jumlahtotal}} Pcs</td>
                                            <td colspan="3" class="text-right">
                                                {{"Rp ". number_format($row->grandtotal,0,',','.')}}
                                            </td>
                                        </tr>
                                        @php
                                        $newtgl = explode('|',$_GET['finaltgl']);
                                        $datadetail = DB::table('thumb_detail_transaksi')
                                        ->whereBetween('tgl', array($newtgl[0], $newtgl[1]))
                                        ->where('produk_id',$row->produk_id)
                                        ->get();
                                        @endphp
                                        @foreach($datadetail as $dtl)
                                        <tr class="table-secondary">
                                            <td class="pb-0 pt-0"></td>
                                            <td class="pb-0 pt-0">{{$dtl->kode_transaksi}}</td>
                                            <td class="pb-0 pt-0">{{$dtl->tgl}}</td>
                                            <td class="pb-0 pt-0">{{$dtl->jumlah}} Pcs</td>
                                            <td class="text-right pb-0 pt-0">
                                                {{"Rp ". number_format($dtl->harga,0,',','.')}}</td>
                                            <td class="pb-0 pt-0">{{$dtl->diskon}} %</td>
                                            <td class="text-right pb-0 pt-0">
                                                {{"Rp ". number_format($dtl->subtotal,0,',','.')}}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        <tr>
                                            <td colspan="6"><b>Total</b></td>
                                            <td class="text-right"><b>{{"Rp ". number_format($total,0,',','.')}}</b>
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
    <table border="1" style="border-collapse: collapse;border: 1px solid black;" width="100%">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;" colspan="2">Barang</th>
                <th style="border: 1px solid black;">Jumlah Terjual</th>
                <th style="border: 1px solid black;" colspan="4" align="center">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            $total=0;
            @endphp
            @foreach($data as $row)
            @php
            $total += $row->grandtotal;
            @endphp
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">{{$i++}}</td>
                <td style="border: 1px solid black;" colspan="2">{{$row->namaproduk}} ({{$row->namawarna}} - {{$row->namasize}})</td>
                <td style="border: 1px solid black;">{{$row->jumlahtotal}} Pcs</td>
                <td style="border: 1px solid black;" colspan="3" align="right">{{"Rp ". number_format($row->grandtotal,0,',','.')}}
                </td>
            </tr>
            @php
            $newtgl = explode('|',$_GET['finaltgl']);
            $datadetail = DB::table('thumb_detail_transaksi')
            ->whereBetween('tgl', array($newtgl[0], $newtgl[1]))
            ->where('produk_id',$row->produk_id)
            ->get();
            @endphp
            @foreach($datadetail as $dtl)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;">{{$dtl->kode_transaksi}}</td>
                <td style="border: 1px solid black;">{{$dtl->tgl}}</td>
                <td style="border: 1px solid black;">{{$dtl->jumlah}} Pcs</td>
                <td style="border: 1px solid black;">
                    {{"Rp ". number_format($dtl->harga,0,',','.')}}</td>
                <td style="border: 1px solid black;">{{$dtl->diskon}} %</td>
                <td style="border: 1px solid black;" align="right">
                    {{"Rp ". number_format($dtl->subtotal,0,',','.')}}</td>
            </tr>
            @endforeach
            @endforeach
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;" colspan="6"><b>Total</b></td>
                <td style="border: 1px solid black;" align="right"><b>{{"Rp ". number_format($total,0,',','.')}}</b>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/tableexport/tableExport.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(document).ready(function() {
    $("#exportexcel").click(function() {
        $('#list-data').tableExport({
            format: 'xls',
            filename: 'Laporan Detail Per Barang',
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