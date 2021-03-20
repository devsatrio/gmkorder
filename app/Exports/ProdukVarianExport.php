<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdukVarianExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        $export =DB::table('produk_varian')
        ->select(DB::raw('produk_varian.id,produk.nama,warna.nama as namawaran,size.nama as namasize,produk_varian.stok,produk_varian.diskon,produk_varian.harga'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->orderby('id','desc')
        ->get();
        return $export;
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
            'warna',
            'size',
            'stok',
            'diskon',
            'harga jual',
        ];
    }
}
