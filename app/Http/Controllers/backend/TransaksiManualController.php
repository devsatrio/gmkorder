<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TrxUmumModel;
use App\models\ProdukVarianModel;
use Batch;
use Hash;
use Auth;
use DB;

class TransaksiManualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        DB::table('thumb_transaksi_manual')->where('user_id',Auth::user()->id)->orderby('id','desc')->delete();
        $kode = $this->carikode();
        $barang = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.id,warna.nama as namawarna,size.nama as namasize,produk_varian.stok,produk_varian.produk_kode,produk.nama'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->where('status','Aktif')
        ->orderby('produk_varian.id','desc')
        ->get();
        $pelanggan = DB::table('pengguna')->orderby('id','desc')->get();
        return view('backend.transaksimanual.index',compact('barang','kode','pelanggan'));
    }

    //==================================================================
    public function carikode(){
        $tgl=date('Y-m-d');
        $fk='TRXM.'.date('Y/m/d');
        $c=TrxUmumModel::where('faktur', 'like', '%'.$fk.'%')->where(['tgl'=>$tgl])->max('faktur');
        if ($c) {
            $xp=(int)strtok($c,'-');
            $xp++;
            $nml=sprintf("%05s", $xp).'-'.$fk;
        } else {
            $nml='00001'.'-'.$fk;
        }
        return $nml;
    }

    //==================================================================
    public function caridetailbarang($kode)
    {
        $barang = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.*,produk.status'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->where([['produk_varian.id',$kode],['produk_varian.stok','>=',1],['status','=','Aktif']])->get();
        return response()->json($barang);
    }

    //==================================================================
    public function addpengguna(Request $request)
    {
        DB::table('pengguna')
        ->insert([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat,
            'password'=>Hash::make($request->username.'12345'),
        ]);
    }

    //==================================================================
    public function caripelanggan(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pengguna')
                    ->select('nama','id',)
                    ->where('nama','like','%'.$cari.'%')
                    ->get();
            return response()->json($data);
        }
    }

    //==================================================================
    public function adddetailproduk(Request $request)
    {
        $barang = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.id,warna.nama as namawarna,size.nama as namasize,produk_varian.stok,produk_varian.produk_kode,produk.nama'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->orderby('produk_varian.id','desc')
        ->where('produk_varian.id',$request->produk)
        ->first();

        if($request->diskon!='' || $request->diskon!=0){
            $harga = $request->harga - ($request->harga*$request->diskon/100);
        }else{
            $harga = $request->harga;
        }

        DB::table('thumb_transaksi_manual')
        ->insert([
            'user_id'=>Auth::user()->id,
            'produk_id'=>$request->produk,
            'produk_kode'=>$barang->produk_kode,
            'nama'=>$barang->nama,
            'varian'=>$barang->namawarna." - ".$barang->namasize,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'jumlah'=>$request->jumlah,
            'subtotal'=>$request->jumlah*$harga,
        ]);
    }

    //==================================================================
    public function getdataproduk()
    {
        $data = DB::table('thumb_transaksi_manual')->where('user_id',Auth::user()->id)->orderby('id','desc')->get();
        return response()->json($data);
    }

    //==================================================================
    public function caridetailpelanggan($kode)
    {
        $data = DB::table('pengguna')->where('id',$kode)->get();
        return response()->json($data);
    }

    //==================================================================
    public function hapusproduk(Request $request,$kode)
    {
        DB::table('thumb_transaksi_manual')->where([['user_id',Auth::user()->id],['id','=',$kode]])->orderby('id','desc')->delete();
    }

    //==================================================================
    public function cariproduk(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('produk_varian')
                    ->select(DB::raw('produk_varian.id,warna.nama as namawarna,size.nama as namasize,produk_varian.stok,produk_varian.produk_kode,produk.nama as nama'))
                    ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
                    ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
                    ->leftjoin('size','size.id','=','produk_varian.size_id')
                    ->where('produk_varian.produk_kode','like','%'.$cari.'%')
                    ->get();
            return response()->json($data);
        }
    }

    //==================================================================
    public function simpantransaksi(Request $request)
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
        $this->checkstatusproduk(Auth::user()->id);
        DB::table('stok_log')->insert($datalog);
        DB::table('trx_umum')
        ->insert([
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
            'sts_notif'=>'y'
        ]);
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