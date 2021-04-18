<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use File;
use Auth;
use Hash;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $jumlahpengguna = DB::table('pengguna')->count();
        $jumlahproduk = DB::table('produk')->count();
        $totalpengunjung = DB::table('visitor')->count();
        $jumlahtransaksi = DB::table('trx_umum')->where('sts','sudah')->count();
        $datenow = date('Y-m-d');
        
        $jumlahnya ="";
        $tglnya ="";
        for ($i=6; $i >= 0; $i--) { 
            $olddate = date('Y-m-d',(strtotime ( '-'.$i.' day' , strtotime ( $datenow))));
            $trxgrafik = DB::table('trx_umum')->where([['tgl',$olddate],['sts','sudah']])->count();
            $jumlahnya = $jumlahnya.''.$trxgrafik.',';
            $tglnya =$tglnya."'".$olddate."',";
        }
        $produkhabis = DB::table('produk')->where('status','Habis')->limit(8)->get();
        $jumlahprodukhabis = DB::table('produk')->where('status','Habis')->count();
        $dataperkategori = DB::table('thumb_detail_transaksi')
        ->select(DB::raw('thumb_detail_transaksi.*,sum(thumb_detail_transaksi.jumlah) as totaljumlah,produk_varian.produk_kode,produk.kategori_produk,kategori_produk.nama as label'))
        ->leftjoin('produk_varian','produk_varian.id','=','thumb_detail_transaksi.produk_id')
        ->leftjoin('produk','produk.kode','=','produk_kode')
        ->leftjoin('kategori_produk','kategori_produk.id','=','produk.kategori_produk')
        ->groupby('produk.kategori_produk')
        ->whereMonth('thumb_detail_transaksi.tgl', date('m'))
        ->get();
        $jumlahnyadua ="";
        $kategorinya ="";
        $color = "";
        foreach($dataperkategori as $dtakat){
            $jumlahnyadua = $jumlahnyadua.''.$dtakat->totaljumlah.',';
            $kategorinya =$kategorinya."'".$dtakat->label."',";
            $color = $color."'#".substr(md5(rand()), 0, 6)."',";
        }

        $jumlahpengunjung ="";
        $tglpengunjung ="";
        for ($i=6; $i >= 0; $i--) { 
            $olddate = date('Y-m-d',(strtotime ( '-'.$i.' day' , strtotime ( $datenow))));
            $pengunjung = DB::table('visitor')->where('date',$olddate)->count();
            $jumlahpengunjung = $jumlahpengunjung.''.$pengunjung.',';
            $tglpengunjung =$tglpengunjung."'".$olddate."',";
        }

        return view('backend.dashboard.index',compact('jumlahprodukhabis','produkhabis','totalpengunjung','tglpengunjung','jumlahpengunjung','jumlahpengguna','jumlahproduk','jumlahtransaksi','jumlahnya','tglnya','jumlahnyadua','kategorinya','color'));
    }

    //==================================================================
    public function cektransaksi(){
        $datanotif = DB::table('trx_umum')->where('sts_notif','n')->orderby('id','desc')->get();
        $datanew = DB::table('trx_umum')->where('sts','belum')->orderby('id','desc')->limit(6)->get();
        $data=[
            'datanotif'=>$datanotif,
            'datanew'=>$datanew,
        ];
        return response()->json($data);
    }

    //==================================================================
    public function bersihnotif(){
        $data = DB::table('trx_umum')->where('sts_notif','n')->update(['sts_notif'=>'y']);
    }

    //==================================================================
    public function editprofile(){
        $data = User::find(Auth::user()->id);
        return view('backend.dashboard.editprofile',['data'=>$data]);
    }

    //==================================================================
    public function aksieditprofile(Request $request,$id){
        if($request->hasFile('gambar')){
            File::delete('img/admin/'.$request->gambar_lama);
            $nameland=$request->file('gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/admin');
            $request->file('gambar')->move($destination,$finalname);

            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }else{
            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }

        return redirect('backend/dashboard')->with('status','Sukses memperbarui profile');
    }
}