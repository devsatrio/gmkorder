<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\StokProdukExport;
use App\Exports\ProdukVarianExport;
use App\Imports\StokProdukImport;
use Session;
use DataTables;
use Excel;
use Hash;
use File;
use Auth;
use Image;
use DB;


class PenyesuaianStokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.stok.index');
    }
    
    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('stok_log')->select(DB::raw('stok_log.*,users.username'))->leftjoin('users','stok_log.user_id','=','users.id')->get())->make(true);
    }
    //=================================================================
    public function create()
    {
        $barang = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.*, produk.nama as namaproduk, size.nama as namasize, warna.nama as namawarna'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->orderby('produk_varian.id','desc')
        ->get();
        return view('backend.stok.create',compact('barang'));
    }

    //=================================================================
    public function detailbarang($id)
    {
        $barang = DB::table('produk_varian')->where('id',$id)->get();
        return response()->json($barang);
    }
    
    //=================================================================
    public function store(Request $request)
    {
        $dataproduk = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.*, produk.nama as namaproduk, size.nama as namasize, warna.nama as namawarna'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->where('produk_varian.id',$request->produk)
        ->orderby('produk_varian.id','desc')
        ->first();
        if($request->aksi=='Tambah'){
            $newstock = $dataproduk->stok + $request->jumlah;
            DB::table('produk_varian')->where('id',$request->produk)->update(['stok'=>$newstock]);
            DB::table('stok_log')
            ->insert([
                'kode_produk'=>$dataproduk->produk_kode.' - '.$dataproduk->namaproduk.' - '.$dataproduk->namawarna.' - '.$dataproduk->namasize,
                'user_id'=>Auth::user()->id,
                'status'=>'Penyesuaian Stok',
                'aksi'=>'Menambahkan',
                'deskripsi'=>'Mengedit stok produk barang '.$dataproduk->produk_kode.' - '.$dataproduk->namaproduk.' warna '.$dataproduk->namawarna.' size '.$dataproduk->namasize,
                'jumlah'=>$request->jumlah,
                'keterangan'=>$request->keterangan,
                'jumlah_akhir'=>$newstock,
                'tanggal'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $newstock = $dataproduk->stok - $request->jumlah;
            DB::table('produk_varian')->where('id',$request->produk)->update(['stok'=>$newstock]);
            DB::table('stok_log')
            ->insert([
                'kode_produk'=>$dataproduk->produk_kode.' - '.$dataproduk->namaproduk.' - '.$dataproduk->namawarna.' - '.$dataproduk->namasize,
                'user_id'=>Auth::user()->id,
                'status'=>'Penyesuaian Stok',
                'aksi'=>'Mengurangi',
                'deskripsi'=>'Mengedit stok produk barang '.$dataproduk->produk_kode.' - '.$dataproduk->namaproduk.' warna '.$dataproduk->namawarna.' size '.$dataproduk->namasize,
                'jumlah'=>$request->jumlah,
                'keterangan'=>$request->keterangan,
                'jumlah_akhir'=>$newstock,
                'tanggal'=>date('Y-m-d H:i:s')
            ]);
        }
        return redirect('backend/penyesuaian-stok')->with('status','Berhasil mengedit stok produk '.$dataproduk->produk_kode);
    }
    //=================================================================
    public function importexport()
    {
        return view('backend.stok.importexport');
    }

    //=================================================================
    public function export()
    {
        $namafile = "Data_Stok_Produk.xls";   
        return Excel::download(new StokProdukExport(),$namafile);
    }

    //=================================================================
    public function import(Request $request)
    {
        try {
            if($request->hasFile('file_excel')){
                $error = Excel::import(new StokProdukImport, request()->file('file_excel'));
                return redirect('backend/penyesuaian-stok')->with('status','Berhasil Import Data');
             }else{
                return redirect('backend/penyesuaian-stok');
             }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorexcel', $failures);
             return back();
        }
    }

    //=================================================================
    public function exportprodukvarian()
    {
        $namafile = "Data_Produk_varian.xls";   
        return Excel::download(new ProdukVarianExport(),$namafile);
    }
}
