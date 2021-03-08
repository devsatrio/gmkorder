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
    <div class="container">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vocher</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Info!</h4>
                {{ session('status') }}
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Data Vocher</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                    data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah
                                    Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>kode</th>
                                            <th>Jumlah Potongan</th>
                                            <th>Tgl Berlaku</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->kode}}</td>
                                            <td>{{"Rp ". number_format($row->jumlah,0,',','.')}}</td>
                                            <td>{{$row->tgl_mulai}} - {{$row->tgl_selesai}}</td>
                                            <td class="text-center">
                                                <form action="{{url('backend/data-vocher/'.$row->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        data-toggle="modal" data-target="#modal-edit{{$row->id}}">
                                                        <i class="fa fa-wrench"></i>
                                                    </button>
                                                    <button type="submit" onclick="return confirm('Hapus Data ?')"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>kode</th>
                                            <th>Jumlah Potongan</th>
                                            <th>Tgl Berlaku</th>
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
    </section>
</div>
<div class="modal fade" id="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="{{url('backend/data-vocher')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">kode</label>
                        <input type="text" name="kode" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Potongan</label>
                        <input type="number" name="jumlah" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Selesai</label>
                        <input type="date" name="tgl_selesai" class="form-control" require>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($data as $row)
<div class="modal fade" id="modal-edit{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <form action="{{url('backend/data-vocher/'.$row->id)}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode</label>
                        <input type="text" name="kode" value="{{$row->kode}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Potongan</label>
                        <input type="number" name="jumlah" value="{{$row->jumlah}}" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Mulai</label>
                        <input type="date" name="tgl_mulai" value="{{$row->tgl_mulai}}" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Selesai</label>
                        <input type="date" name="tgl_selesai" value="{{$row->tgl_selesai}}" class="form-control" require>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script>
$(function() {
    $('#list-data').DataTable();
});
</script>
@endpush