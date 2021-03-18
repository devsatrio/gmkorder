<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //==================================================================
    public function index()
    {
        return view('backend.laporan.transaksi');
    }

    //==================================================================
    public function tampiltransaksi(Request $request)
    {
        $newtgl = explode('|',$request->finaltgl);
        $data = DB::table('trx_umum')
        ->select(DB::raw('trx_umum.*,users.username'))
        ->leftjoin('users','users.id','=','admin_acc')
        ->whereBetween('tgl', array($newtgl[0], $newtgl[1]))
        ->where('sts','sudah')
        ->get();
        return view('backend.laporan.viewtransaksi',compact('data'));
    }

    //==================================================================
    public function caridetailtransaksi()
    {
        return view('backend.laporan.detailtransaksi');
    }

    //==================================================================
    public function tampildetailtransaksi(Request $request)
    {
        $newtgl = explode('|',$request->finaltgl);
        $data = DB::table('trx_umum')
        ->select(DB::raw('trx_umum.*,users.username'))
        ->leftjoin('users','users.id','=','admin_acc')
        ->whereBetween('tgl', array($newtgl[0], $newtgl[1]))
        ->where('sts','sudah')
        ->get();
        return view('backend.laporan.viewdetailtransaksi',compact('data'));
    }

    //==================================================================
    public function caripenjualanbarang()
    {
        return view('backend.laporan.penjualanbarang');
    }

    //==================================================================
    public function tampilpenjualanbarang(Request $request)
    {
        $newtgl = explode('|',$request->finaltgl);
        $data = DB::table('thumb_detail_transaksi')
        ->select(DB::raw('thumb_detail_transaksi.*,trx_umum.sts,sum(jumlah) as jumlahtotal,sum(thumb_detail_transaksi.subtotal) as grandtotal,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama as namaproduk,warna.nama as namawarna,size.nama as namasize'))
        ->leftjoin('trx_umum','trx_umum.faktur','=','thumb_detail_transaksi.kode_transaksi')
        ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
        ->leftjoin('produk','produk.kode','=','produk_kode')
        ->leftjoin('warna','warna.id','=','warna_id')
        ->leftjoin('size','size.id','=','size_id')
        ->whereBetween('thumb_detail_transaksi.tgl', array($newtgl[0], $newtgl[1]))
        ->where('sts','sudah')
        ->groupby('produk_id')
        ->get();
        return view('backend.laporan.viewpenjualanbarang',compact('data'));
    }

    //==================================================================
    public function caridetailpenjualanbarang()
    {
        return view('backend.laporan.detailpenjualanbarang');
    }
    
    //==================================================================
    public function tampildetailpenjualanbarang(Request $request)
    {
        $newtgl = explode('|',$request->finaltgl);
        $data = DB::table('thumb_detail_transaksi')
        ->select(DB::raw('thumb_detail_transaksi.*,trx_umum.sts,sum(jumlah) as jumlahtotal,sum(thumb_detail_transaksi.subtotal) as grandtotal,produk_varian.warna_id,produk_varian.size_id,produk_varian.produk_kode,produk.nama as namaproduk,warna.nama as namawarna,size.nama as namasize'))
        ->leftjoin('trx_umum','trx_umum.faktur','=','thumb_detail_transaksi.kode_transaksi')
        ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
        ->leftjoin('produk','produk.kode','=','produk_kode')
        ->leftjoin('warna','warna.id','=','warna_id')
        ->leftjoin('size','size.id','=','size_id')
        ->whereBetween('thumb_detail_transaksi.tgl', array($newtgl[0], $newtgl[1]))
        ->where('sts','sudah')
        ->groupby('produk_id')
        ->get();
        return view('backend.laporan.viewdetailpenjualanbarang',compact('data'));
    }

    //==================================================================
    public function caritransaksiperadmin()
    {
        $data = DB::table('users')->get();
        return view('backend.laporan.transaksiperadmin',compact('data'));
    }
    
    //==================================================================
    public function tampiltransaksiperadmin(Request $request)
    {
        $newtgl = explode('|',$request->finaltgl);
        $data = DB::table('trx_umum')
        ->select(DB::raw('trx_umum.*,users.username'))
        ->leftjoin('users','users.id','=','admin_acc')
        ->whereBetween('tgl', array($newtgl[0], $newtgl[1]))
        ->where('sts','sudah')
        ->where('admin_acc',$request->user)
        ->get();
        return view('backend.laporan.viewtransaksiperadmin',compact('data'));
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
