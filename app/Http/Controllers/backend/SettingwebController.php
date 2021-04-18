<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SettingwebModel;
use Image;
use File;

class SettingwebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = SettingwebModel::orderby('id','desc')->limit(1)->get();
        $jumlah = SettingwebModel::count();
        return view('backend.setting.index',['data'=>$data,'jumlah'=>$jumlah]);
    }

    //=================================================================
    public function store(Request $request)
    {
        if($request->hasFile('logo') && $request->hasFile('favicon')) {
            $data = SettingwebModel::where('id',$request->kode)->first();
            if($data->logo != ''){
                File::delete('images/setting/'.$data->logo);
            }
            if($data->favicon != ''){
                File::delete('images/setting/'.$data->favicon);
            }

            $namelogo=time().'-'.$request->file('logo')->getClientOriginalname();
            $request->file('logo')->move(public_path('images/setting'),$namelogo);

            $namefavicon=time().'-'.$request->file('favicon')->getClientOriginalname();
            $request->file('favicon')->move(public_path('images/setting'),$namefavicon);

            SettingwebModel::where('id',$request->kode)
            ->update([
                'nama'=>$request->nama,
                'singkatan'=>$request->singkatan,
                'deskripsi'=>$request->deskripsi,
                'moto'=>$request->moto,
                'meta'=>$request->meta,
                'email'=>$request->email,
                'telp_satu'=>$request->telp_satu,
                'telp_dua'=>$request->telp_dua,
                'link_fb'=>$request->link_fb,
                'link_ig'=>$request->link_ig,
                'link_android'=>$request->link_android,
                'link_iphone'=>$request->link_iphone,
                'link_youtube'=>$request->link_youtube,
                'logo'=>$namelogo,
                'promo'=>$request->promot,
                'favicon'=>$namefavicon,
            ]);

        }elseif($request->hasFile('logo')){
            $data = SettingwebModel::where('id',$request->kode)->first();
            if($data->logo != ''){
                File::delete('images/setting/'.$data->logo);
            }

            $image = $request->file('logo');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
            $destinationPath = public_path('images/setting');
            //$destinationPath = base_path('../klikdesa/images/setting');
            $image->move($destinationPath, $input['imagename']);

            SettingwebModel::where('id',$request->kode)
            ->update([
                'nama'=>$request->nama,
                'singkatan'=>$request->singkatan,
                'deskripsi'=>$request->deskripsi,
                'moto'=>$request->moto,
                'meta'=>$request->meta,
                'email'=>$request->email,
                'telp_satu'=>$request->telp_satu,
                'telp_dua'=>$request->telp_dua,
                'link_fb'=>$request->link_fb,
                'link_ig'=>$request->link_ig,
                'link_android'=>$request->link_android,
                'link_iphone'=>$request->link_iphone,
                'link_youtube'=>$request->link_youtube,
                'logo'=>$input['imagename'],
                'promo'=>$request->promot,
            ]);
        }elseif($request->hasFile('favicon')){
            $data = SettingwebModel::where('id',$request->kode)->first();
            if($data->favicon != ''){
                File::delete('images/setting/'.$data->favicon);
            }

            $image = $request->file('favicon');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
            $destinationPath = public_path('images/setting');
            //$destinationPath = base_path('../klikdesa/images/setting');
            $image->move($destinationPath, $input['imagename']);

            SettingwebModel::where('id',$request->kode)
            ->update([
                'nama'=>$request->nama,
                'singkatan'=>$request->singkatan,
                'deskripsi'=>$request->deskripsi,
                'moto'=>$request->moto,
                'meta'=>$request->meta,
                'email'=>$request->email,
                'telp_satu'=>$request->telp_satu,
                'telp_dua'=>$request->telp_dua,
                'link_fb'=>$request->link_fb,
                'link_ig'=>$request->link_ig,
                'link_android'=>$request->link_android,
                'link_iphone'=>$request->link_iphone,
                'link_youtube'=>$request->link_youtube,
                'favicon'=>$input['imagename'],
                'promo'=>$request->promot,
            ]);
        }else{
            SettingwebModel::where('id',$request->kode)
            ->update([
                'nama'=>$request->nama,
                'singkatan'=>$request->singkatan,
                'deskripsi'=>$request->deskripsi,
                'moto'=>$request->moto,
                'meta'=>$request->meta,
                'email'=>$request->email,
                'telp_satu'=>$request->telp_satu,
                'telp_dua'=>$request->telp_dua,
                'link_fb'=>$request->link_fb,
                'link_ig'=>$request->link_ig,
                'link_android'=>$request->link_android,
                'link_iphone'=>$request->link_iphone,
                'link_youtube'=>$request->link_youtube,
                'promo'=>$request->promot,
            ]);
        }
        return redirect('backend/setting-web')->with('status','Berhasil memperbarui setting web');
    }


}
