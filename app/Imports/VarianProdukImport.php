<?php

namespace App\Imports;
use App\models\ProdukVarianModel;
use Illuminate\Support\Collection;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class VarianProdukImport implements ToModel, WithHeadingRow,WithValidation
{

    use Importable;
    public function model(array $row)
    {
        return new ProdukVarianModel([
            'produk_kode' => $row['kode_produk'],
            'warna_id'=>$row['warna_id'],
            'size_id'=>$row['size_id'],
            'hpp'=>$row['hpp'],
            'diskon'=>$row['diskon'],
            'harga'=>$row['harga'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_produk' => 'required|string',
            'warna_id' => 'required|numeric',
            'size_id' => 'required|numeric',
            'hpp' => 'required|numeric',
            'diskon' => 'required|numeric',
            'harga' => 'required|numeric',
        ];
    }
}