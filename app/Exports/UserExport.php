<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        $export =DB::table('pengguna')
        ->select(DB::raw('username,nama,email,telp,alamat'))
        ->orderby('id','desc')
        ->get();
        return $export;
    }
    public function headings(): array
    {
        return [
            'username',
            'nama',
            'email',
            'telp',
            'alamat',
        ];
    }
}
