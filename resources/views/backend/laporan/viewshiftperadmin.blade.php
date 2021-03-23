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
                    <h1 class="m-0 text-dark"> Laporan Transaksi Per Shift Admin</h1>
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
                            <h3 class="card-title">Laporan Transaksi Per Shift Admin ({{$dataadmin->username}})
                                {{$_GET['finaltgl']}}</h3>
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
                                            <th>Admin</th>
                                            <th>Tanggal</th>
                                            <th>Jam Login</th>
                                            <th>Jam Logout</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        $total=0;
                                        @endphp
                                        @foreach($data as $row)
                                        @php
                                        $total += 1;
                                        @endphp
                                        <tr class="table-primary">
                                            <td>{{$i++}}</td>
                                            <td>{{$row->username}}</td>
                                            <td>{{$row->tgl}}</td>
                                            <td>{{$row->jam_login}}</td>
                                            <td>{{$row->jam_logout}}</td>
                                        </tr>
                                        @php
                                        $startdate = $row->tgl.' '.$row->jam_login;
                                        $enddate = $row->tgl.' '.$row->jam_logout;
                                        $datatrx =
                                        DB::table('trx_umum')->whereBetween('created_at',[$startdate,$enddate])->where('sts','sudah')->get();
                                        @endphp
                                        @foreach($datatrx as $dtrx)
                                        <tr class="table-secondary">
                                            <td></td>
                                            <td>{{$dtrx->faktur}}</td>
                                            <td>{{$dtrx->created_at}}</td>
                                            <td>{{$dtrx->nama}}</td>
                                            <td class="text-right">{{"Rp ". number_format($dtrx->total,0,',','.')}}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
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
<p>Laporan Transaksi Per Shift Admin ({{$dataadmin->username}}) {{$_GET['finaltgl']}}</p>
    <table border="1" style="border-collapse: collapse;border: 1px solid black;" width="100%">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Admin</th>
                <th style="border: 1px solid black;">Tanggal</th>
                <th style="border: 1px solid black;">Jam Login</th>
                <th style="border: 1px solid black;">Jam Logout</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            $total=0;
            @endphp
            @foreach($data as $row)
            @php
            $total += 1;
            @endphp
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">{{$i++}}</td>
                <td style="border: 1px solid black;">{{$row->username}}</td>
                <td style="border: 1px solid black;">{{$row->tgl}}</td>
                <td style="border: 1px solid black;">{{$row->jam_login}}</td>
                <td style="border: 1px solid black;">{{$row->jam_logout}}</td>
            </tr>
            @php
            $startdate = $row->tgl.' '.$row->jam_login;
            $enddate = $row->tgl.' '.$row->jam_logout;
            $datatrx =
            DB::table('trx_umum')->whereBetween('created_at',[$startdate,$enddate])->where('sts','sudah')->get();
            @endphp
            @foreach($datatrx as $dtrx)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;">{{$dtrx->faktur}}</td>
                <td style="border: 1px solid black;">{{$dtrx->created_at}}</td>
                <td style="border: 1px solid black;">{{$dtrx->nama}}</td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($dtrx->total,0,',','.')}}</td>
            </tr>
            @endforeach
            @endforeach
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
            filename: 'Laporan Transaksi Per admin',
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