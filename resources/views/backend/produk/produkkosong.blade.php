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
                    <h1 class="m-0 text-dark"> Produk</h1>
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
                            <h3 class="card-title">List Data Produk Habis</h3>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Stok (Pcs)</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->kode}}</td>
                                            <td>{{$row->nama}}</td>
                                            <td>{{$row->totalstok}}</td>
                                            <td class="text-center">{{$row->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Stok (Pcs)</th>
                                            <th class="text-center">Status</th>
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
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(function () {
    $('#list-data').DataTable();
});
</script>
@endpush