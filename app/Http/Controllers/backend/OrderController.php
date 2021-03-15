<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.order.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('trx_umum')->where('sts','belum')->orderby('id','desc')->get())->make(true);
    }

    //=================================================================
    public function canceltrx(Request $request, $kode)
    {
        DB::table('trx_umum')->where('id',$kode)->update(['sts'=>'cancel']);
    }

    //=================================================================
    public function acctrx(Request $request, $kode)
    {
        DB::table('trx_umum')->where('id',$kode)->update(['sts'=>'sudah']);
    }

    //=================================================================
    public function edittrx($kode)
    {
        DB::table('thumb_transaksi_manual')->where('user_id',Auth::user()->id)->orderby('id','desc')->delete();
        $data = DB::table('trx_umum')->where('id',$kode)->get();

        foreach($data as $row){
            $datatrx = DB::table('thumb_detail_transaksi')
            ->select(DB::raw('thumb_detail_transaksi.*,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama as namaproduk,warna.nama as namawarna,size.nama as namasize'))
            ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
            ->leftjoin('produk','produk.kode','=','produk_kode')
            ->leftjoin('warna','warna.id','=','warna_id')
            ->leftjoin('size','size.id','=','size_id')
            ->where('thumb_detail_transaksi.kode_transaksi',$row->faktur)
            ->get();
            foreach($datatrx as $rowtrx){
                DB::table('thumb_transaksi_manual')
                ->insert([
                    'user_id'=>Auth::user()->id,
                    'produk_id'=>$rowtrx->produk_id,
                    'produk_kode'=>$rowtrx->produk_kode,
                    'nama'=>$rowtrx->namaproduk,
                    'varian'=>$rowtrx->namawarna." - ".$rowtrx->namasize,
                    'harga'=>$rowtrx->harga,
                    'diskon'=>$rowtrx->diskon,
                    'jumlah'=>$rowtrx->jumlah,
                    'subtotal'=>$rowtrx->subtotal,
                ]);
            }
        }

        $barang = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.id,warna.nama as namawarna,size.nama as namasize,produk_varian.stok,produk_varian.produk_kode,produk.nama,produk.status'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->where('status','Aktif')
        ->orderby('produk_varian.id','desc')
        ->get();
        return view('backend.transaksi.transaksionline',compact('data','barang'));
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
