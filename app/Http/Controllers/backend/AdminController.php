<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;
use File;
use Hash;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('users')->orderby('id','desc')->get();
        return view('backend.admin.index',['data'=>$data]);
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(User::all())->make(true);
    }
    
    //=================================================================
    public function create()
    {
        return view('backend.admin.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        $nameland=$request->file('gambar')->getClientOriginalname();
        $lower_file_name=strtolower($nameland);
        $replace_space=str_replace(' ', '-', $lower_file_name);
        $finalname=time().'-'.$replace_space;
        $destination=public_path('img/admin');
        $request->file('gambar')->move($destination,$finalname);
        
        User::insert([
            'name'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'telp'=>$request->telp,
            'level'=>$request->level,
            'status_cs'=>$request->status_cs,
            'gambar'=>$finalname,
            'password'=>Hash::make($request->password),
        ]);
        
        return redirect('backend/admin')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function edit($id)
    {
        $data = User::find($id);
        return view('backend.admin.edit',['data'=>$data]);
    }

    //=================================================================
    public function update(Request $request, $id)
    {
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
                    'level'=>$request->level,
                    'status_cs'=>$request->status_cs,
                    'gambar'=>$finalname,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'level'=>$request->level,
                    'status_cs'=>$request->status_cs,
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
                    'level'=>$request->level,
                    'status_cs'=>$request->status_cs,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'level'=>$request->level,
                    'status_cs'=>$request->status_cs,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }

        return redirect('backend/admin')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        $data = User::find($id);
        if($data->gambar !=''){
            File::delete('img/admin/'.$data->gambar);
        }
        User::destroy($id);
        // return redirect('/admin')->with('status','Sukses menghapus data');
    }
}
