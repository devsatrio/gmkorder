<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\models\KategoriModel;
use App\models\ProdukModel;
use Illuminate\Http\Request;

class FrontControl extends Controller
{
    public function index()
    {
        $kat=KategoriModel::get();
        $prod=ProdukModel::take('10')->get();
        $out=[
            'kat'=>$kat,
            'prod'=>$prod,
        ];
        
        return view('frontend.index',$out);
    }
    public function cariKatalog($cari)
    {
        
    }
}
