<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.transaksi.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('trx_umum')->where('sts','sudah')->orderby('id','desc')->get())->make(true);
    }

    //=================================================================
    public function getdetail($kode)
    {
        $datatrx = DB::table('trx_umum')
        ->select(DB::raw('trx_umum.*,users.username'))
        ->leftjoin('users','users.id','=','trx_umum.admin_acc')
        ->where('trx_umum.id',$kode)
        ->get();

        foreach($datatrx as $dt){
            $detail = DB::table('thumb_detail_transaksi')
            ->select(DB::raw('thumb_detail_transaksi.*,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama as namaproduk,warna.nama as namawarna,size.nama as namasize'))
            ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
            ->leftjoin('produk','produk.kode','=','produk_kode')
            ->leftjoin('warna','warna.id','=','warna_id')
            ->leftjoin('size','size.id','=','size_id')
            ->where('thumb_detail_transaksi.kode_transaksi',$dt->faktur)
            ->get();
        }
        $data=[
            'trx'=>$datatrx,
            'detail'=>$detail,
        ];
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
