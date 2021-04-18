@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="pl-2 pr-2">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Laporan Transaksi Per Shift Admin</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="pl-2 pr-2">
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
                                            <th>Jumlah Transaksi</th>
                                            <th>Total Cash</th>
                                            <th>Total Vocher</th>
                                            <th>Total Transfer</th>
                                            <th>Total Kembalian</th>
                                            <th>Total Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        $total=0;
                                        $final_jumlahtrx=0;
                                        $final_totalcash=0;
                                        $final_totalvocher=0;
                                        $final_totaltransfer=0;
                                        $final_jumlahtrx=0;
                                        $final_jumlahkembalian=0;
                                        $final_jumlahpenjualan=0;
                                        @endphp
                                        @foreach($data as $row)
                                        @php
                                        $total += 1;
                                        @endphp
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->username}}</td>
                                            <td>{{$row->tgl}}</td>
                                            <td>{{$row->jam_login}}</td>
                                            <td>{{$row->jam_logout}}</td>
                                            @php
                                            $startdate = $row->tgl.' '.$row->jam_login;
                                            $enddate = $row->tgl.' '.$row->jam_logout;
                                            $totalcash=0;
                                            $totalvocher=0;
                                            $totaltransfer=0;
                                            $jumlahtrx=0;
                                            $jumlahkembalian=0;
                                            $jumlahpenjualan=0;

                                            $datatrx
                                            =DB::table('trx_umum')->whereBetween('created_at',[$startdate,$enddate])->where('sts','sudah')->get();
                                            @endphp
                                            @foreach($datatrx as $dtrx)
                                            @php
                                            $jumlahtrx+=1;
                                            $totalcash+=$dtrx->dibayar_cash;
                                            $totalvocher+=$dtrx->dibayar_voucher;
                                            $totaltransfer+=$dtrx->dibayar_transfer;
                                            $jumlahkembalian+=$dtrx->kembalian;
                                            $jumlahpenjualan+=$dtrx->total;
                                            @endphp
                                            @endforeach
                                            @php
                                            $final_totalvocher+=$totalvocher;
                                            $final_totaltransfer+=$totaltransfer;
                                            $final_jumlahkembalian+=$jumlahkembalian;
                                            $final_jumlahpenjualan+=$jumlahpenjualan;
                                            $final_totalcash+=$totalcash;
                                            $final_jumlahtrx+=$jumlahtrx;
                                            @endphp
                                            <td>{{$jumlahtrx}} Transaksi</td>
                                            <td class="text-right">{{"Rp ". number_format($totalcash,0,',','.')}}</td>
                                            <td class="text-right">{{"Rp ". number_format($totalvocher,0,',','.')}}</td>
                                            <td class="text-right">{{"Rp ". number_format($totaltransfer,0,',','.')}}
                                            </td>
                                            <td class="text-right">{{"Rp ". number_format($jumlahkembalian,0,',','.')}}
                                            </td>
                                            <td class="text-right">{{"Rp ". number_format($jumlahpenjualan,0,',','.')}}
                                            </td>
                                        </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="text-right">Total</td>
                                            <td>{{$final_jumlahtrx}} Transaksi</td>
                                            <td class="text-right">{{"Rp ". number_format($final_totalcash,0,',','.')}}
                                            </td>
                                            <td class="text-right">
                                                {{"Rp ". number_format($final_totalvocher,0,',','.')}}</td>
                                            <td class="text-right">
                                                {{"Rp ". number_format($final_totaltransfer,0,',','.')}}</td>
                                            <td class="text-right">
                                                {{"Rp ". number_format($final_jumlahkembalian,0,',','.')}}</td>
                                            <td class="text-right">
                                                {{"Rp ". number_format($final_jumlahpenjualan,0,',','.')}}</td>
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
    <p>Laporan Transaksi Per Shift Admin ({{$dataadmin->username}}) {{$_GET['finaltgl']}}</p>
    <table border="1" style="border-collapse: collapse;border: 1px solid black;" width="100%">
        <thead>
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Admin</th>
                <th style="border: 1px solid black;">Tanggal</th>
                <th style="border: 1px solid black;">Jam Login</th>
                <th style="border: 1px solid black;">Jam Logout</th>
                <th style="border: 1px solid black;">Jumlah Transaksi</th>
                <th style="border: 1px solid black;">Total Cash</th>
                <th style="border: 1px solid black;">Total Vocher</th>
                <th style="border: 1px solid black;">Total Transfer</th>
                <th style="border: 1px solid black;">Total Kembalian</th>
                <th style="border: 1px solid black;">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            $total=0;
            $final_jumlahtrx=0;
            $final_totalcash=0;
            $final_totalvocher=0;
            $final_totaltransfer=0;
            $final_jumlahtrx=0;
            $final_jumlahkembalian=0;
            $final_jumlahpenjualan=0;
            @endphp
            @foreach($data as $row)
            @php
            $total += 1;
            @endphp
            <tr>
                <td style="border: 1px solid black;">{{$i++}}</td>
                <td style="border: 1px solid black;">{{$row->username}}</td>
                <td style="border: 1px solid black;">{{$row->tgl}}</td>
                <td style="border: 1px solid black;">{{$row->jam_login}}</td>
                <td style="border: 1px solid black;">{{$row->jam_logout}}</td>
                @php
                $startdate = $row->tgl.' '.$row->jam_login;
                $enddate = $row->tgl.' '.$row->jam_logout;
                $totalcash=0;
                $totalvocher=0;
                $totaltransfer=0;
                $jumlahtrx=0;
                $jumlahkembalian=0;
                $jumlahpenjualan=0;

                $datatrx
                =DB::table('trx_umum')->whereBetween('created_at',[$startdate,$enddate])->where('sts','sudah')->get();
                @endphp
                @foreach($datatrx as $dtrx)
                @php
                $jumlahtrx+=1;
                $totalcash+=$dtrx->dibayar_cash;
                $totalvocher+=$dtrx->dibayar_voucher;
                $totaltransfer+=$dtrx->dibayar_transfer;
                $jumlahkembalian+=$dtrx->kembalian;
                $jumlahpenjualan+=$dtrx->total;
                @endphp
                @endforeach
                @php
                $final_totalvocher+=$totalvocher;
                $final_totaltransfer+=$totaltransfer;
                $final_jumlahkembalian+=$jumlahkembalian;
                $final_jumlahpenjualan+=$jumlahpenjualan;
                $final_totalcash+=$totalcash;
                $final_jumlahtrx+=$jumlahtrx;
                @endphp
                <td>{{$jumlahtrx}} Transaksi</td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($totalcash,0,',','.')}}</td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($totalvocher,0,',','.')}}</td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($totaltransfer,0,',','.')}}
                </td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($jumlahkembalian,0,',','.')}}
                </td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($jumlahpenjualan,0,',','.')}}
                </td>
            </tr>

            @endforeach
            <tr>
                <td colspan="5"  style="border: 1px solid black;">Total</td>
                <td>{{$final_jumlahtrx}} Transaksi</td>
                <td style="border: 1px solid black;" align="right">{{"Rp ". number_format($final_totalcash,0,',','.')}}
                </td>
                <td style="border: 1px solid black;" align="right">
                    {{"Rp ". number_format($final_totalvocher,0,',','.')}}</td>
                <td style="border: 1px solid black;" align="right">
                    {{"Rp ". number_format($final_totaltransfer,0,',','.')}}</td>
                <td style="border: 1px solid black;" align="right">
                    {{"Rp ". number_format($final_jumlahkembalian,0,',','.')}}</td>
                <td style="border: 1px solid black;" align="right">
                    {{"Rp ". number_format($final_jumlahpenjualan,0,',','.')}}</td>
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