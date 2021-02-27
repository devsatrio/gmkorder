<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Exports\ProdukExport;
use App\Exports\KategoriProdukExport;
use App\Exports\WarnaExport;
use App\Exports\SizeExport;
use App\Imports\ProdukImport;
use App\Imports\VarianProdukImport;
use Illuminate\Http\Request;
use DataTables;
use Session;
use Image;
use Hash;
use File;
use Auth;
use Excel;
use DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.produk.index');
    }
    
    //=================================================================
    public function listdata(){
        return Datatables::of(
        DB::table('produk')
        ->select(DB::raw('produk.*,(select sum(produk_varian.stok) from produk_varian where produk_varian.produk_kode = produk.kode) as totalstok'))
        ->leftjoin('produk_varian','produk_varian.produk_kode','=','produk.kode')
        ->groupby('produk.kode')
        ->get())
        ->make(true);
    }

    //=================================================================
    public function create()
    {
        $warna = DB::table('warna')->orderby('id','desc')->get();
        $size = DB::table('size')->orderby('id','desc')->get();
        $kategori=DB::table('kategori_produk')->orderby('id','desc')->get();
        return view('backend.produk.create',compact('kategori','warna','size'));
    }

    //=================================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:produk',
        ]);

        $namafile ='';
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
            $destinationPath = public_path('img/produk/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint){$constraint->aspectRatio();})
            ->save($destinationPath.'/'.$input['imagename']);
            $destinationPath = public_path('img/produk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
        }

        $imgdata = [];
        foreach ($request->file('gambarlain') as $photos) {
            $namaexs = $photos->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $destination = public_path('img/gambarproduk');
            $photos->move($destination,$namagambar);
            $imgdata[] = [
                'kode_produk' => $request->kode,
                'nama' => $namagambar
            ];
        }

        $i=0;
        $data_varian = [];
        foreach ($request->file('gambar_warna') as $photoswarna) {

            $namaexs = $photoswarna->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $destination = public_path('img/gambarproduk');
            $photoswarna->move($destination,$namagambar);
           
            $data_varian[] =[
                'produk_kode'=>$request->kode,
                'warna_id'=>$request->warna[$i],
                'size_id'=>$request->size[$i],
                'hpp'=>$request->hpp[$i],
                'harga'=>$request->harga_jual[$i],
                'gambar'=>$namagambar
            ];
        $i++;
        }

        DB::table('gambar_produk')->insert($imgdata);
        DB::table('produk')->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'status'=>$request->status,
            'slug'=>str_replace(' ','-',strtolower($request->nama)),
            'kategori_produk'=>$request->kategori,
            'gambar_utama'=>$namafile,
            'deskripsi'=>$request->deskripsi,
        ]);
        DB::table('produk_varian')->insert($data_varian);
        
        return redirect('backend/produk')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function edit($id)
    {
        $kodebarang = '';
        $barang = DB::table('produk')->where('id',$id)->get();
        foreach($barang as $row){
            $kodebarang = $row->kode;
        }
        $varian = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.*,size.nama as namasize, warna.nama as namawarna'))
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->where('produk_varian.produk_kode',$kodebarang)
        ->orderby('produk_varian.id','desc')
        ->get();
        $warna = DB::table('warna')->orderby('id','desc')->get();
        $size = DB::table('size')->orderby('id','desc')->get();
        $gambarbarang = DB::table('gambar_produk')->where('kode_produk',$kodebarang)->get();
        $kategori=DB::table('kategori_produk')->orderby('id','desc')->get();
        return view('backend.produk.edit',compact('kategori','barang','gambarbarang','varian','warna','size'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        $olddata = DB::table('produk')->where('id',$id)->first();

        if($olddata->kode != $request->kode){
            $validated = $request->validate([
                'kode' => 'required|unique:produk',
            ]);
        }

        $namafile ='';
        if($request->hasFile('gambar')) {
            
            File::delete('img/produk/'.$olddata->gambar_utama);
            File::delete('img/produk/thumbnail/'.$olddata->gambar_utama);

            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('img/produk/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint){$constraint->aspectRatio();})
            ->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('img/produk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];

            DB::table('produk')
            ->where('id',$id)
            ->update([
                'kode'=>$request->kode,
                'nama'=>$request->nama,
                'status'=>$request->status,
                'slug'=>str_replace(' ','-',strtolower($request->nama)),
                'kategori_produk'=>$request->kategori,
                'deskripsi'=>$request->deskripsi,
                'gambar_utama'=>$namafile,
            ]);
        }else{
            DB::table('produk')
            ->where('id',$id)
            ->update([
                'kode'=>$request->kode,
                'nama'=>$request->nama,
                'status'=>$request->status,
                'slug'=>str_replace(' ','-',strtolower($request->nama)),
                'kategori_produk'=>$request->kategori,
                'deskripsi'=>$request->deskripsi,
            ]);
        }
        return redirect('backend/produk')->with('status','Sukses mengedit data');
    }

    //=================================================================
    public function destroy($id)
    {
        $data = DB::table('produk')->where('id',$id)->first();
        $dataimage = DB::table('gambar_produk')->where('kode_produk',$data->kode)->get();
        foreach($dataimage as $oldimg){
            File::delete('img/gambarproduk/'.$oldimg->nama);
        }
        if($data->gambar_utama != ''){
            File::delete('img/produk/'.$data->gambar_utama);
            File::delete('img/produk/thumbnail/'.$data->gambar_utama);
        }
        DB::table('gambar_produk')->where('kode_produk',$data->kode)->delete();
        DB::table('produk')->where('id',$id)->delete();
    }

    //=================================================================
    public function addgambar(Request $request)
    {
        $namafile='';
        if($request->hasFile('gambarproduk')) {
            
            $image = $request->file('gambarproduk');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();

            $destinationPath = public_path('img/gambarproduk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
        }
        DB::table('gambar_produk')
        ->insert([
            'nama'=>$namafile,
            'kode_produk'=>$request->kode
        ]);
        return back()->with('statusimage','Gambar berhasil disimpan');
    }

    //=================================================================
    public function hapusgambar(Request $request, $id)
    {
    $dataimage = DB::table('gambar_produk')->where('id',$id)->get();
    foreach($dataimage as $oldimg){
        File::delete('img/gambarproduk/'.$oldimg->nama);
    } 
    DB::table('gambar_produk')->where('id',$id)->delete();
    return back()->with('statusimage','Gambar berhasil dihapus');
    }

    //=================================================================
    public function importexport()
    {
        return view('backend.produk.importexport');
    }

    //=================================================================
    public function exportproduk()
    {
        $namafile = "Data_Produk.xls";   
        return Excel::download(new ProdukExport(),$namafile);
    }

    //=================================================================
    public function exportprodukkategori()
    {
        $namafile = "Data_kategori_Produk.xls";   
        return Excel::download(new KategoriProdukExport(),$namafile);
    }

    //=================================================================
    public function exportprodukwarna()
    {
        $namafile = "Data_warna_Produk.xls";   
        return Excel::download(new WarnaExport(),$namafile);
    }

    //=================================================================
    public function exportproduksize()
    {
        $namafile = "Data_size_Produk.xls";   
        return Excel::download(new SizeExport(),$namafile);
    }

    //=================================================================
    public function importproduk(Request $request)
    {
        try {
            if($request->hasFile('file_excel')){
                $error = Excel::import(new ProdukImport, request()->file('file_excel'));
                return redirect('backend/produk')->with('status','Berhasil Import Data');
             }else{
                Session::flash('errorexcel', 'error uploading data');
                return redirect('backend/produk');
             }
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorexcel', $failures);
             return back();
        }
    }

    //=================================================================
    public function importvarianproduk(Request $request)
    {
        try {
            if($request->hasFile('file_excel')){
                $error = Excel::import(new VarianProdukImport, request()->file('file_excel'));
                return redirect('backend/produk')->with('status','Berhasil Import Data');
             }else{
                Session::flash('errorvarianexcel', 'error uploading data');
                return redirect('backend/produk');
             }
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorvarianexcel', $failures);
             return back();
        }
    }

    //=================================================================
    public function addvarian(Request $request)
    {
        if($request->hasFile('gambar_warna')) {
            
            $image = $request->file('gambar_warna');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();

            $destinationPath = public_path('img/gambarproduk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
        }
        DB::table('produk_varian')
        ->insert([
            'produk_kode'=>$request->kode,
            'warna_id'=>$request->warna,
            'size_id'=>$request->size,
            'hpp'=>$request->hpp,
            'harga'=>$request->harga_jual,
            'gambar'=>$namafile,
        ]);
        return back()->with('statusvarian','Varian berhasil disimpan');
    }

    //=================================================================
    public function hapusvarian(Request $request, $id)
    {
    $datavar = DB::table('produk_varian')
    ->select(DB::raw('produk_varian.*, produk.nama as namaproduk, size.nama as namasize, warna.nama as namawarna'))
    ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
    ->leftjoin('size','size.id','=','produk_varian.size_id')
    ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
    ->where('produk_varian.id',$id)
    ->orderby('produk_varian.id','desc')
    ->first();

    $stoktotal = DB::table('produk_varian')
    ->where('produk_kode','=',$datavar->produk_kode)
    ->sum('stok');

    DB::table('stok_log')
    ->insert([
        'kode_produk'=>$datavar->produk_kode,
        'user_id'=>Auth::user()->id,
        'status'=>'Penyesuaian Stok',
        'aksi'=>'Mengurangi',
        'deskripsi'=>'Menghapus varian produk '.$datavar->produk_kode.' - '.$datavar->namaproduk.' warna '.$datavar->namawarna.' size '.$datavar->namasize,
        'jumlah'=>$datavar->stok,
        'jumlah_akhir'=>$stoktotal-$datavar->stok,
        'tanggal'=>date('Y-m-d H:i:s')
    ]);

    $dataimage = DB::table('produk_varian')->where('id',$id)->get();
    foreach($dataimage as $oldimg){
        File::delete('img/gambarproduk/'.$oldimg->gambar);
    } 
    DB::table('produk_varian')->where('id',$id)->delete();
    
    return back()->with('statusvarian','Varian berhasil dihapus');
    }

    //=================================================================
    public function editvarian(Request $request,$id)
    {
        if($request->hasFile('gambar_warna')) {
            $dataimage = DB::table('produk_varian')->where('id',$id)->get();
            foreach($dataimage as $oldimg){
                File::delete('img/gambarproduk/'.$oldimg->gambar);
            }

            $image = $request->file('gambar_warna');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
            $destinationPath = public_path('img/gambarproduk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
            DB::table('produk_varian')
            ->where('id',$id)
            ->update([
                'warna_id'=>$request->warna,
                'size_id'=>$request->size,
                'hpp'=>$request->hpp,
                'harga'=>$request->harga_jual,
                'gambar'=>$namafile,
            ]);
        }else{
            DB::table('produk_varian')
            ->where('id',$id)
            ->update([
                'warna_id'=>$request->warna,
                'size_id'=>$request->size,
                'hpp'=>$request->hpp,
                'harga'=>$request->harga_jual,
            ]);
        }
        return back()->with('statusvarian','Varian berhasil diupdate');
    }
    
}