<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdukExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        $export =DB::table('produk')
        ->select(DB::raw('id,kode,nama,deskripsi,status'))
        ->orderby('id','desc')
        ->get();
        return $export;
    }
    public function headings(): array
    {
        return [
            'id',
            'kode',
            'nama',
            'deskripsi',
            'status',
        ];
    }
}
