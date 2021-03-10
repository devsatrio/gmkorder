<?php
namespace App\Helper;

use App\models\AdminModel;
use App\models\SettingwebModel;
use App\User;
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
    public static function getNoTelp()
    {
        $data=User::inRandomOrder()->first();
        return $data;
    }
    public static function namaWeb()
    {
        $set=SettingwebModel::first();
        return $set;
    }
}
