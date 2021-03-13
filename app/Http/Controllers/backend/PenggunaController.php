<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use File;
use DB;

class PenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.pengguna.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('pengguna')->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        return view ('backend.pengguna.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'telp' => 'required|unique:pengguna',
            'email' => 'required|unique:pengguna',
            'username' => 'required|unique:pengguna',
        ]);

        $nameland=$request->file('gambar')->getClientOriginalname();
        $lower_file_name=strtolower($nameland);
        $replace_space=str_replace(' ', '-', $lower_file_name);
        $finalname=time().'-'.$replace_space;
        $destination=public_path('img/pengguna');
        $request->file('gambar')->move($destination,$finalname);
        
        DB::table('pengguna')->insert([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat,
            'gambar'=>$finalname,
            'password'=>Hash::make($request->password),
        ]);
        
        return redirect('backend/pengguna')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function show($id)
    {
        //
    }
    
    //=================================================================
    public function edit($id)
    {
        $data = DB::table('pengguna')->where('id',$id)->get();
        return view('backend.pengguna.edit',compact('data'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        $datalama = DB::table('pengguna')->where('id',$id)->get();
        foreach($datalama as $row){
            $olduser = $row->username;
            $oldemail = $row->email;
            $oldtelp = $row->telp;
            $oldimage = $row->gambar;
        }

        if($request->username != $olduser){
            $validated = $request->validate([
                'username' => 'required|unique:pengguna',
            ]);
        }

        if($request->email != $oldemail){
            $validated = $request->validate([
                'email' => 'required|unique:pengguna',
            ]);
        }

        if($request->telp != $oldtelp){
            $validated = $request->validate([
                'telp' => 'required|unique:pengguna',
            ]);
        }
        if($request->hasFile('gambar')){
            File::delete('img/pengguna/'.$oldimage);
            $nameland=$request->file('gambar')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/pengguna');
            $request->file('gambar')->move($destination,$finalname);
            if($request->password =='' ){
                DB::table('pengguna')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'alamat'=>$request->alamat,
                    'gambar'=>$finalname,
                ]);
            }else{
                DB::table('pengguna')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'alamat'=>$request->alamat,
                    'gambar'=>$finalname,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }else{
            if($request->password =='' ){
                DB::table('pengguna')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'alamat'=>$request->alamat,
                ]);
            }else{
                DB::table('pengguna')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'alamat'=>$request->alamat,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }
        return redirect('backend/pengguna')->with('status','Sukses Mengedit Data');
    }
    
    //=================================================================
    public function destroy($id)
    {
        $data = DB::table('pengguna')->where('id',$id)->get();
        foreach($data as $row){
            if($row->gambar != ''){
                File::delete('img/pengguna'.$row->gambar);
            }
        }
        DB::table('pengguna')->where('id',$id)->delete();
    }
}
