<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\DetailTransaksiModel;
use App\models\KategoriModel;
use App\models\ProdukModel;
use App\models\ProdukVarianModel;
use App\models\TransaksiModel;
use App\models\TrxUmumModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontControl extends Controller
{
    public function index()
    {
        $kat=KategoriModel::where('status','Aktif')->get();
        $prod=ProdukModel::where('status','Aktif')->inRandomOrder()->get();
        $out=[
            'kat'=>$kat,
            'prod'=>$prod,
        ];

        return view('frontend.page.index',$out);
    }
    public function cariKatalog($cari)
    {

    }
    public function listProduk($id)
    {
        $data=[];
        $ket=[];
        $prod=ProdukModel::where('kategori_produk',$id)->get();
        $kat=KategoriModel::where('id',$id)->first();
        $print=[
            'prod'=>$prod,
            'kat'=>$kat,
            'ket'=>$ket,
            'data'=>$data,
        ];
        return view('frontend.page.produk',$print);
    }
    public function listBarang($id)
    {
        // dd($id);
        $data=ProdukVarianModel::leftjoin('warna','warna.id','=','produk_varian.warna_id')
            ->leftjoin('size','size.id','=','produk_varian.size_id')
            ->select(DB::raw('warna.nama as warna,size.nama as size,produk_varian.*'))
            ->where('produk_kode',$id)->get();
        $ket=ProdukModel::where('kode',$id)->get();
        $print=[
            'data'=>$data,
            'ket'=>$ket,
        ];
        // dd($data);
        return view('frontend.page.detail_produk',$print);
    }
    public function simpanCart(Request $request)
    {
        $id=$request->id;
        $qty=$request->qty;
        $prod=$request->prod;
        //
        $data=ProdukVarianModel::leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->select(DB::raw('warna.nama as warna,size.nama as size,produk_varian.*'))
        ->where('produk_varian.id',$id)->first();
        $cart=Session::get("cart");
        if($cart==null){
            $cart=array(
                "id"=>$id,
                "prod"=>$prod,
                "gambar"=>$data->gambar,
                "varian"=>$data->warna .' - ' .$data->size,
                "qty"=>$qty,
                "harga"=>$data->harga,
                "total"=>$data->harga * $qty,
            );
            Session::put('cart',[$cart]);
        }else{
            $ncart=array(
                "id"=>$id,
                "prod"=>$prod,
                "gambar"=>$data->gambar,
                "varian"=>$data->warna .' - ' .$data->size,
                "qty"=>$qty,
                "harga"=>$data->harga,
                "total"=>$data->harga * $qty,
            );
            // $cart=array_push($cart,$ncart);
            Session::push('cart',$ncart);
        }
        $dcount=Session::get("cart");
        $tl=0;
        foreach($dcount as $key=>$itm){
            $tl=$tl+$itm['total'];
        }
        $count=count($dcount);
        $print=[
            'sts'=>"1",
            'item'=>$count,
            'msg'=>'Barang Berhasil Ditambahkan! ',
            'ttal'=>$tl,
        ];
        return response()->json($print);
    }
    public function listCart()
    {
        return view('frontend.page.checkout');
    }
    public function ambilBasket()
    {
        return view('frontend.page.checkout');
    }
    public function hapusItem($ky)
    {
        $data=Session::get('cart');
    // //    dd($data[$ky]);
    //     // Session::forget($data[$ky]);
        unset($data[$ky]);
        Session::put('cart',$data);

        $dcount=Session::get("cart");
        $tl=0;
        foreach($dcount as $key=>$itm){
            $tl=$tl+$itm['total'];
        }
        $count=count($dcount);
        $print=[
            'sts'=>"1",
            'item'=>$count,
            'msg'=>'Item Berhasil Dihapus! ',
            'ttal'=>$tl,
        ];
        return response()->json($print);
    }
    public function simpanBelanja(Request $request)
    {
        $nama=$request->nama;
        $telp=$request->telp;
        $alamat=$request->alamat;
        $ttl=0;
        $data=Session::get('cart');
        $totalsemua=0;
        $fk=$this->genFK();
        $tgl=date('Y-m-d');
        foreach ($data as $key => $v) {
            $idvar=$v['id'];
            $qty=$v['qty'];
            $hg=$v['harga'];
            $ttl=$v['total'];
            $totalsemua=$totalsemua+$v['total'];


            // simpan ke detail trx
            DetailTransaksiModel::create([
                'kode_transaksi'=>$fk,
                'produk_id'=>$idvar,
                'jumlah'=>$qty,
                'harga'=>$hg,
                'subtotal'=>$ttl,
                'tgl'=>$tgl,
            ]);
        }
        // simpan ke trx
        $simpan=TrxUmumModel::create([
            'faktur'=>$fk,
            'tgl'=>$tgl,
            'nama'=>$nama,
            'telp'=>$telp,
            'alamat'=>$alamat,
            'subtotal'=>$totalsemua,
            'diskon'=>'0',
            'total'=>$totalsemua,
        ]);
        $print=[
            'sts'=>'1',
        ];
        // session pindah ke wa
        Session::put('cwa',$data);
        // session detail pembeli
        Session::put('pembeli',$nama);
        Session::put('telp',$telp);
        Session::put('alamat',$alamat);
        Session::forget('cart');
        Session::put('fk',$fk);
        return response()->json($print);

    }
    public function genFK()
    {
        $tgl=date('Y-m-d');
        $fk='TRX.'.date('Y/m/d');
        $c=TrxUmumModel::where('faktur', 'like', '%'.$fk.'%')->where(['tgl'=>$tgl])->max('faktur');
        // dd($c);
        if ($c) {
            $xp=(int)strtok($c,'-');
            $xp++;
            // dd($xp);
            $nml=sprintf("%05s", $xp).'-'.$fk;
        } else {
            $nml='00001'.'-'.$fk;
        }
        // dd($nml);
        return $nml;
    }
    public function suksesPage()
    {
        // Session::flush();
        return view('frontend.page.sukses_page');
    }
}
