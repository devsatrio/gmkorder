<?php
namespace App\Helper;

use Illuminate\Support\Facades\Session;

class cekNotif{
    public static  function cekKeranjang()
    {
        $data=Session::get("cart");
        return $data;
    }
    public static function countKeranjang()
    {
        $data=Session::get("cart");
        if(empty($data)){
            $count="0";
        }else{
            $count=count($data);
        }

        return $count;
    }
}
