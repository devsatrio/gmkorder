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
        $kat=KategoriModel::where('status','Aktif')->get();
        $prod=ProdukModel::where('status','Aktif')->inRandomOrder()->take('10')->get();
        $out=[
            'kat'=>$kat,
            'prod'=>$prod,
        ];

        return view('frontend.page.index',$out);
    }
    public function cariKatalog($cari)
    {

    }
    public function listProduk($id)
    {
        $prod=ProdukModel::where('kategori_produk',$id)->get();
        $kat=KategoriModel::where('id',$id)->first();
        $print=[
            'prod'=>$prod,
            'kat'=>$kat,
        ];
        return view('frontend.page.produk',$print);
    }
}
