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
        return view('backend.dashboard.index');
    }

    //==================================================================
    public function cektransaksi(){
        $datanotif = DB::table('trx_umum')->where('sts_notif','n')->orderby('id','desc')->get();
        $datanew = DB::table('trx_umum')->where('sts','belum')->orderby('id','desc')->limit(10)->get();
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
