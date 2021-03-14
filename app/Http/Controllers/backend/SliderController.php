<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SliderModel;
use Image;
use File;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = SliderModel::orderby('id','desc')->get();
        return view('backend.slider.index',['data'=>$data]);
    }

    //=================================================================
    public function store(Request $request)
    {
        if($request->hasFile('gambar')) {

            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();

            $destinationPath = public_path('images/slider/thumbnail');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }
            //$destinationPath = base_path('../klikdesa/images/slider/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/slider');
            //$destinationPath = base_path('../klikdesa/images/slider');
            $image->move($destinationPath, $input['imagename']);

        }
        SliderModel::insert([
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'link'=>$request->link,
            'link_text'=>$request->link_text,
            'gambar'=>$input['imagename'],
            'status'=>$request->status,
            'selected'=>$request->active,
        ]);
        return redirect('backend/slider')->with('status','Sukses menyimpan data');

    }

    //=================================================================
    public function update(Request $request, $id)
    {
        if($request->hasFile('gambar')) {
            $data = SliderModel::where('id',$id)->first();
            if($data->gambar != ''){
                File::delete('images/slider/'.$data->gambar);
                File::delete('images/slider/thumbnail/'.$data->gambar);
            }
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
            $destinationPath = public_path('images/slider/thumbnail');
            //$destinationPath = base_path('../klikdesa/images/slider/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/slider');
            //$destinationPath = base_path('../klikdesa/images/slider');
            $image->move($destinationPath, $input['imagename']);

            SliderModel::where('id',$id)
            ->update([
                'judul'=>$request->judul,
                'isi'=>$request->isi,
                'link'=>$request->link,
                'link_text'=>$request->link_text,
                'gambar'=>$input['imagename'],
                'status'=>$request->status,
                'selected'=>$request->active,
            ]);
        }else{
            SliderModel::where('id',$id)
            ->update([
                'judul'=>$request->judul,
                'isi'=>$request->isi,
                'link'=>$request->link,
                'link_text'=>$request->link_text,
                'status'=>$request->status,
                'selected'=>$request->active,
            ]);

        }
        return redirect('backend/slider')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        $data = SliderModel::where('id',$id)->first();
            if($data->gambar != ''){
                File::delete('images/slider/'.$data->gambar);
                File::delete('images/slider/thumbnail/'.$data->gambar);
            }
        SliderModel::where('id',$id)->delete();
        return redirect('backend/slider')->with('status','Sukses menghapus data');
    }
}
