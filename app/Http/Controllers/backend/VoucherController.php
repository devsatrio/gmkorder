<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('vocher')->orderby('id','desc')->get();
        return view('backend.vocher.index',compact('data'));
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('vocher')->insert([
            'kode'=>$request->kode,
            'jumlah'=>$request->jumlah,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
        ]);
        return redirect('backend/data-vocher')->with('status','Data berhasil disimpan');
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('vocher')
        ->where('id',$id)
        ->update([
            'kode'=>$request->kode,
            'jumlah'=>$request->jumlah,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
        ]);
        return redirect('backend/data-vocher')->with('status','Data berhasil diperbarui');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('vocher')->where('id',$id)->delete();
        return redirect('backend/data-vocher')->with('status','Data berhasil dihapus');
    }
}
