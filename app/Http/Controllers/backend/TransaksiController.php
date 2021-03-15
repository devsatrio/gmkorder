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
        return Datatables::of(DB::table('trx_umum')->where('sts','!=','belum')->orderby('id','desc')->get())->make(true);
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

    //==================================================================
    public function simpantransaksi(Request $request,$kode)
    {
        $datapelanggan = DB::table('pengguna')->where('id',$request->pembeli)->first();
        $getdetailproduk = DB::table('thumb_transaksi_manual')->where('user_id',Auth::user()->id)->get();

        //kurangi stok
        $updatestok=[];
        $datanya=[];
        $datalog=[];
        foreach($getdetailproduk as $produk){
            $updatestok[] = [
                'id' => $produk->produk_id,
                'stok' =>['-', $produk->jumlah],
            ];

            $datanya[]=[
                'kode_transaksi'=>$request->resi,
                'produk_id'=>$produk->produk_id,
                'jumlah'=>$produk->jumlah,
                'harga'=>$produk->harga,
                'diskon'=>$produk->diskon,
                'subtotal'=>$produk->subtotal,
                'tgl'=>date('Y-m-d'),
            ];
            $dataproduk = DB::table('produk_varian')->where('id',$produk->produk_id)->first();
            $datalog[] =[
                'kode_produk'=>$produk->produk_kode,
                'user_id'=>Auth::user()->id,
                'status'=>'Menjual Via Offline',
                'aksi'=>'Mengurangi',
                'deskripsi'=>'Menjual produk '.$produk->nama.' ('.$produk->produk_kode.') - '.$produk->varian,
                'jumlah'=>$produk->jumlah,
                'jumlah_akhir'=>$dataproduk->stok - $produk->jumlah,
                'tanggal'=>date('Y-m-d H:i:s')
            ];
        }

        $index = 'id';
        $userInstance = new ProdukVarianModel;
        Batch::update($userInstance, $updatestok, $index);
        DB::table('thumb_detail_transaksi')->insert($datanya);
        DB::table('stok_log')->insert($datalog);
        DB::table('trx_umum')
        ->where('id',$kode)
        ->update([
            'faktur'=>$request->resi,
            'tgl'=>date('Y-m-d'),
            'id_pengguna'=>$request->pembeli,
            'nama'=>$datapelanggan->nama,
            'telp'=>$datapelanggan->telp,
            'alamat'=>$datapelanggan->alamat,
            'jns_ambil'=>$request->metode,
            'subtotal'=>$request->subtotal,
            'ongkir'=>$request->ongkir,
            'diskon'=>$request->potongan,
            'total'=>$request->subtotal+$request->ongkir-$request->potongan,
            'sts'=>'sudah',
            'kurir'=>$request->kurir,
            'nama_penerima'=>$request->namapenerima,
            'alamat_penerima'=>$request->alamat,
            'telp_penerima'=>$request->telppenerima,
            'keterangan'=>$request->keterangan,
            'admin_acc'=>Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
   
}
