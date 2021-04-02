<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ProdukVarianModel;
use Batch;
use Hash;
use DataTables;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //==================================================================
    public function simpantransaksi(Request $request)
    {
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
                'status'=>'Menjual Via Online',
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
        DB::table('thumb_detail_transaksi')->where('kode_transaksi',$request->resi)->delete();
        DB::table('thumb_detail_transaksi')->insert($datanya);
        $this->checkstatusproduk(Auth::user()->id);
        DB::table('stok_log')->insert($datalog);
        DB::table('trx_umum')
        ->where('id',$request->kodetrx)
        ->update([
            'faktur'=>$request->resi,
            'tgl'=>date('Y-m-d'),
            'id_pengguna'=>$request->pembeli,
            'nama'=>$request->pembeli,
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
            'sts_notif'=>'y'
        ]);

        $data = DB::table('trx_umum')->where('id',$request->kodetrx)->get();
        foreach($data as $row){
            $telp = $row->telp;
            $nama = $row->nama;
            $caripengguna = DB::table('pengguna')->where('telp',$telp)->count();
            if($caripengguna<1){
                DB::table('pengguna')->insert([
                    'nama'=>$nama,
                    'username'=>$nama,
                    'telp'=>$telp,
                    'password'=>Hash::make($nama.'12345'),
                ]);
            }
        }
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
        $data = DB::table('trx_umum')->where('id',$kode)->get();
        foreach($data as $row){
            $telp = $row->telp;
            $nama = $row->nama;
            $caripengguna = DB::table('pengguna')->where('telp',$telp)->count();
            if($caripengguna<1){
                DB::table('pengguna')->insert([
                    'nama'=>$nama,
                    'username'=>$nama,
                    'telp'=>$telp,
                    'password'=>Hash::make($nama.'12345'),
                ]);
            }
        }
        DB::table('trx_umum')
        ->where('id',$kode)
        ->update([
            'sts'=>'sudah',
            'admin_acc'=>Auth::user()->id,
        ]);
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
   //==================================================================
   public function checkstatusproduk($userid){
    $getdetailproduk =DB::table('thumb_transaksi_manual')->where('user_id',Auth::user()->id)->get();
    foreach($getdetailproduk as $row){
        $detailbarang = DB::table('produk')
        ->select(DB::raw('produk.*,(select sum(produk_varian.stok) from produk_varian where produk_varian.produk_kode = produk.kode) as totalstok'))
        ->leftjoin('produk_varian','produk_varian.produk_kode','=','produk.kode')
        ->where('kode',$row->produk_kode)
        ->groupby('produk.kode')
        ->get();
        foreach($detailbarang as $rowdua){
            if($rowdua->totalstok<=1){
                DB::table('produk')
                ->where('kode',$rowdua->kode)
                ->update([
                    'status'=>'Habis'
                ]);
            }
        }
    }
}
}