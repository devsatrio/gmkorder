<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\DetailTransaksiModel;
use App\models\KategoriModel;
use App\models\ProdukModel;
use App\models\ProdukVarianModel;
use App\models\SliderModel;
use App\models\TransaksiModel;
use App\models\TrxUmumModel;
use App\models\VisitorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontControl extends Controller
{
    public function getvisitor($request){
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $platform = 'Unknown';
        if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            } elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }
            $user_ip=$request->ip();
            $tgl = date('Y-m-d');
            $data = VisitorModel::firstOrNew(['ip' => $user_ip,'date'=>$tgl]);
                $data->ip = $user_ip;
                $data->date = $tgl;
                $data->time = date('h:i:s');
                $data->os = $platform;
                $data->save();
    }

    public function index(Request $request)
    {
        $this->getvisitor($request);
        // kategori
        $kat=KategoriModel::where('status','Aktif')->get();
        // slider
        $slide=SliderModel::where('status','aktif')->inRandomOrder()->get();
        $prod=ProdukModel::where('status','Aktif')->inRandomOrder()->get();
        $promo=ProdukVarianModel::
                leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
                ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
                ->leftjoin('size','size.id','=','produk_varian.size_id')
                ->select(DB::raw('warna.nama as warna,size.nama as size,produk.nama as produk,produk_varian.id as idv ,produk_varian.*'))
                ->where('diskon','!=','0')
                // ->where('stok','!=','0')
                ->get();
        $out=[
            'kat'=>$kat,
            'prod'=>$prod,
            'slide'=>$slide,
            'promo'=>$promo

        ];

        return view('frontend.page.index',$out);
    }
    public function cariKatalog($cari)
    {

    }
    public function listProduk(Request $request,$id)
    {
        $this->getvisitor($request);
        $data=[];
        $ket=[];
        $prod=ProdukModel::where('kategori_produk',$id)->where('status','Aktif')->get();
        $kat=KategoriModel::where('id',$id)->first();
        $print=[
            'prod'=>$prod,
            'kat'=>$kat,
            'ket'=>$ket,
            'data'=>$data,
        ];
        return view('frontend.page.produk',$print);
    }
    public function listBarang(Request $request,$id)
    {
        $this->getvisitor($request);
        // dd($id);
        $data=ProdukVarianModel::leftjoin('warna','warna.id','=','produk_varian.warna_id')
            ->leftjoin('size','size.id','=','produk_varian.size_id')
            ->select(DB::raw('warna.nama as warna,size.nama as size,produk_varian.*'))
            // ->where('stok','>','0')
            // ->where('status','Aktif')
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
        if($data->diskon != '0'){
            $tll=($data->harga*$qty)-($data->harga*$qty*$data->diskon/100);
        }else{
            $tll=($data->harga*$qty);
        }
        if($cart==null){
            $cart=array(
                "id"=>$id,
                "prod"=>$prod,
                "gambar"=>$data->gambar,
                "varian"=>$data->warna .' - ' .$data->size,
                "qty"=>$qty,
                'diskon'=>$data->diskon,
                "harga"=>$data->harga,
                "total"=>$tll,
            );
            Session::put('cart',[$cart]);
        }else{
            $ncart=array(
                "id"=>$id,
                "prod"=>$prod,
                "gambar"=>$data->gambar,
                "varian"=>$data->warna .' - ' .$data->size,
                "qty"=>$qty,
                'diskon'=>$data->diskon,
                "harga"=>$data->harga,
                "total"=>$tll,
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
        $jnsambil=$request->jns;
        // drop
        $ndrop=$request->pn;
        $aldrop=$request->pal;
        $teldrop=$request->ptlp;
        $ttl=0;
        $data=Session::get('cart');
        $totalsemua=0;
        $subt=0;
        $tpot=0;
        $fk=$this->genFK();
        $tgl=date('Y-m-d');
        foreach ($data as $key => $v) {
            $idvar=$v['id'];
            $qty=$v['qty'];
            $hg=$v['harga'];
            $ttl=$v['total'];
            $ds=$v['diskon'];
            $totalsemua=$totalsemua+$v['total'];
            $subt=$subt+$hg*$qty;
            $tpot=$tpot+($hg*$qty*$ds/100);

            // simpan ke detail trx
            DetailTransaksiModel::create([
                'kode_transaksi'=>$fk,
                'produk_id'=>$idvar,
                'jumlah'=>$qty,
                'harga'=>$hg,
                'diskon'=>$ds,
                'subtotal'=>$ttl,
                'tgl'=>$tgl,
            ]);
        }
        // // simpan ke trx
        // if($alamat='ambil di toko'){
        //     $jns='Toko';
        // }else{
        //     $jns='Kirim';
        // }
        $simpan=TrxUmumModel::create([
            'faktur'=>$fk,
            'tgl'=>$tgl,
            'nama'=>$nama,
            'telp'=>$telp,
            'alamat'=>$alamat,
            'subtotal'=>$subt,
            'diskon'=>$tpot,
            'total'=>$totalsemua,
            'jns_ambil'=>$jnsambil,
            'nama_penerima'=>$ndrop,
            'alamat_penerima'=>$aldrop,
            'telp_penerima'=>$teldrop,
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
    public function cariProduk(Request $request)
    {
        // $data=[];
        // $ket=[];
        $cari=$request->cproduk;
        $prod=ProdukModel::where('nama','like','%'.$cari.'%')->where('status','Aktif')->get();
        // $kat=KategoriModel::where('id',$id)->first();
        $print=[
            'prod'=>$prod,
            // 'kat'=>$kat,
            'ket'=>$cari,
            // 'data'=>$data,
        ];
        return view('frontend.page.umum_produk',$print);
    }
}
