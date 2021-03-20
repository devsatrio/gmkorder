<?php

namespace App\Imports;
use App\models\ProdukVarianModel;
use Illuminate\Support\Collection;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Batch;
use Auth;
use DB;

class StokProdukImport implements ToCollection, WithHeadingRow, WithValidation
{

    use Importable;
    public function collection(Collection $collection)
    {
        $value=[];
        $datalog=[];
        foreach ($collection as $row){
            $kproduk = $row['kode_produk'];
            $barang = DB::table('produk_varian')
            ->select(DB::raw('produk_varian.*, produk.nama as namaproduk, size.nama as namasize, warna.nama as namawarna'))
            ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
            ->leftjoin('size','size.id','=','produk_varian.size_id')
            ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
            ->where('produk_varian.id',$kproduk)
            ->orderby('produk_varian.id','desc')
            ->first();
            if($row['aksi']=='Tambah'){
                $value[] = [
                    'id' => $row['kode_produk'],
                    'stok' => $barang->stok + $row['jumlah'],
                ];
                $datalog[] =[
                    'kode_produk'=>$barang->produk_kode.' - '.$barang->namaproduk.' - '.$barang->namawarna.' - '.$barang->namasize,
                    'user_id'=>Auth::user()->id,
                    'status'=>'Import Penyesuaian Stok',
                    'aksi'=>'Menambahkan',
                    'deskripsi'=>'Mengedit stok produk',
                    'keterangan'=>$row['deskripsi'],
                    'jumlah'=>$row['jumlah'],
                    'jumlah_akhir'=>$barang->stok + $row['jumlah'],
                    'tanggal'=>date('Y-m-d H:i:s')
                ];
            }else{
                $value[] = [
                    'id' => $row['kode_produk'],
                    'stok' => $barang->stok - $row['jumlah'],
                ];
                $datalog[] =[
                    'kode_produk'=>$barang->produk_kode.' - '.$barang->namaproduk.' - '.$barang->namawarna.' - '.$barang->namasize,
                    'user_id'=>Auth::user()->id,
                    'status'=>'Import Penyesuaian Stok',
                    'aksi'=>'Mengurangi',
                    'deskripsi'=>'Mengedit stok produk',
                    'keterangan'=>$row['deskripsi'],
                    'jumlah'=>$row['jumlah'],
                    'jumlah_akhir'=>$barang->stok - $row['jumlah'],
                    'tanggal'=>date('Y-m-d H:i:s')
                ];
            }
        }
        $userInstance = new ProdukVarianModel;
        $index = 'id';
        Batch::update($userInstance, $value, $index);
        DB::table('stok_log')->insert($datalog);
    }

    public function rules(): array
    {
        return [
            'kode_produk' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'aksi' => 'required|in:Tambah,Kurangi',
            'deskripsi' => 'required|string',
        ];
    }
}