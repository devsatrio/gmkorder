@extends('layouts/base')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @if(session('status'))
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('status') }}
                    </div>
                </div>
                @endif
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$jumlahpengguna}}</h3>
                            <p>Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-child text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$jumlahproduk}}</h3>
                            <p>Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tshirt text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$jumlahtransaksi}}</h3>

                            <p>Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$totalpengunjung}}</h3>

                            <p>Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-dark">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Grafik Transaksi Mingguan</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="sales-chart" height="400"
                                    style="display: block; height: 200px; width: 306px;" width="612"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark">
                        <div class="card-header border-0">
                            <h3 class="card-title">Produk Stok Kosong</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="max-height: 215px;">
                            <table class="table table-striped table-valign-middle">
                                <tbody>
                                    @foreach($produkhabis as $pdh)
                                    <tr>
                                        <td>
                                            <img src="{{asset('img/produk/'.$pdh->gambar_utama)}}" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            {{$pdh->kode}} - {{$pdh->nama}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{url('backend/produk-kosong')}}" class="uppercase">Lihat {{$jumlahprodukhabis}} Produk Stok Kosong Lainya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark text-center">
                        <div class="card-header">
                            <span>Jumlah Produk Terjual Perkategori</span>
                        </div>
                        <div class="card-body text-center">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 306px;"
                                width="612" height="500" class="chartjs-render-monitor mb-4"></canvas>
                            <p>Jumlah Produk Terjual Per kategori Di Bulan <br> <b>{{date('m')}} ({{date('M')}})</b></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Pengunjung Website Mingguan</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="visitors-chart" height="400" width="612" class="chartjs-render-monitor"
                                    style="display: block; height: 200px; width: 306px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('customjs')
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(function() {
    'use strict'
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $visitorsChart = $('#visitors-chart');
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: [<?php echo $tglpengunjung; ?>],
            datasets: [{
                type: 'line',
                data: [<?php echo $jumlahpengunjung; ?>],
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
    var pieData = {
        labels: [<?php echo $kategorinya; ?>],
        datasets: [{
            data: [<?php echo $jumlahnyadua; ?>],
            backgroundColor: [<?php echo $color; ?>],
        }]
    }
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

    var $salesChart = $('#sales-chart')
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: [<?php echo $tglnya; ?>],
            datasets: [{
                backgroundColor: '#252729',
                borderColor: '#007bff',
                data: [<?php echo $jumlahnya; ?>]
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '2px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {

                            return value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})
</script>
@endpush