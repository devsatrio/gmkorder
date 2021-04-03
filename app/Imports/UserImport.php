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
use DB;

class UserImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;
    public function collection(Collection $collection)
    {
        $value=[];
        foreach ($collection as $row){
            $value[] =[
                'nama'=>$row['nama'],
                'username'=>$row['username'],
                'email'=>$row['email'],
                'telp'=>$row['telp'],
                'alamat'=>$row['alamat'],
            ];
        }
        DB::table('pengguna')->insert($value);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'telp' => 'required|numeric',
            'alamat' => 'required|string',
        ];
    }
}
