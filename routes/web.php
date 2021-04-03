<?php

use Illuminate\Support\Facades\Route;
//==================================================================================index
Route::get('/', 'frontend\FrontControl@index')->name('beranda');
// ==================================================================================frontend
Route::prefix('katalog')->group(function(){
    Route::get('cari-katalog/{cari}','frontend\FrontControl@cariKatalog')->name('cari.katalog');
    Route::get('produk-list/{id}/{ktg}','frontend\FrontControl@listProduk')->name('produk');
    Route::get('load-barang/{id}','frontend\FrontControl@listBarang')->name('loadb');
    Route::post('simpan-cart','frontend\FrontControl@simpanCart');
    Route::get('list-cart','frontend\FrontControl@listCart')->name('cart');
});
Route::get('ambil-basket','frontend\FrontControl@ambilBasket');
Route::get('hapus-item/{key}','frontend\FrontControl@hapusItem');
// simpan belanja
Route::post('simpan-belanja','frontend\FrontControl@simpanBelanja')->name('belanja');
// sukses
Route::get('sukses-page','frontend\FrontControl@suksesPage')->name('sukses');
// Route::get('gen-fk','frontend\FrontControl@genFK');
// cari produk
Route::get('cari-produk','frontend\FrontControl@cariProduk')->name('cari-produk');
//==================================================================================auth
Auth::routes();
Route::get('user-login','Auth\PenggunaLoginController@showLoginForm');
Route::post('user-login', ['as' => 'pengguna-login', 'uses' => 'Auth\PenggunaLoginController@login']);
Route::get('user-register', 'Auth\PenggunaLoginController@showRegisterPage');
Route::post('user-register', 'Auth\PenggunaLoginController@register')->name('pengguna.register');

//==================================================================================frontend
Route::get('/profil-saya', 'frontend\HomeController@profilsaya')->name('profil-saya');

//==================================================================================backend
Route::prefix('backend')->group(function(){
    Route::get('/dashboard', 'backend\HomeController@index')->name('dashboard');
    Route::get('cek-transaksi-baru','backend\HomeController@cektransaksi');
    Route::get('bersih-notif','backend\HomeController@bersihnotif');
    Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
    Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

    //admin
    Route::get('/data-admin','backend\AdminController@listdata');
    Route::resource('/admin','backend\AdminController');

    //pengguna
    
    Route::get('/data-pengguna','backend\PenggunaController@listdata');
    Route::get('/import-export/pengguna','backend\PenggunaController@importexport');
    Route::get('/import-export/pengguna/export','backend\PenggunaController@exportpengguna');
    Route::post('/import-export/pengguna/import','backend\PenggunaController@importpengguna');
    Route::resource('/pengguna','backend\PenggunaController');

    //kategori produk
    Route::get('/data-kategori-produk','backend\KategoriProdukController@listdata');
    Route::resource('/kategori-produk','backend\KategoriProdukController');

    //vocher produk
    Route::get('/data-vocher-produk','backend\VoucherController@listdata');
    Route::resource('/data-vocher','backend\VoucherController');

    //import produk
    Route::get('/import-export/produk','backend\ProdukController@importexport');
    Route::post('/import-export/produk/import','backend\ProdukController@importproduk');
    Route::post('/import-export/produk/import-varian','backend\ProdukController@importvarianproduk');
    Route::get('/import-export/produk/export','backend\ProdukController@exportproduk');
    Route::get('/import-export/produk-kategori/export','backend\ProdukController@exportprodukkategori');
    Route::get('/import-export/produk-warna/export','backend\ProdukController@exportprodukwarna');
    Route::get('/import-export/produk-size/export','backend\ProdukController@exportproduksize');

    //produk
    Route::get('/produk-kosong','backend\ProdukController@produkkosong');
    Route::get('/data-produk','backend\ProdukController@listdata');
    Route::resource('/produk','backend\ProdukController');

    //Gambar produk
    Route::post('/produk/add-gambar-produk','backend\ProdukController@addgambar');
    Route::delete('/produk/hapus-gambar/{id}','backend\ProdukController@hapusgambar');

    //Varian produk
    Route::post('/produk/add-varian-produk','backend\ProdukController@addvarian');
    Route::put('/produk/edit-varian-produk/{id}','backend\ProdukController@editvarian');
    Route::delete('/produk/hapus-varian/{id}','backend\ProdukController@hapusvarian');

    //penyesuaian stok
    Route::get('/data-log-stok','backend\PenyesuaianStokController@listdata');
    Route::get('/export-varian-produk','backend\PenyesuaianStokController@exportprodukvarian');
    Route::get('/penyesuaian-stok/import-export','backend\PenyesuaianStokController@importexport');
    Route::get('/penyesuaian-stok/export','backend\PenyesuaianStokController@export');
    Route::post('/penyesuaian-stok/produk/export','backend\PenyesuaianStokController@import');
    Route::get('/penyesuaian-stok/cari-detail-barang/{id}','backend\PenyesuaianStokController@detailbarang');
    Route::resource('/penyesuaian-stok','backend\PenyesuaianStokController');

    //slider
    Route::resource('/slider','backend\SliderController');

    //Warna
    Route::resource('/warna','backend\WarnaController');

    //Warna
    Route::resource('/size','backend\SizeController');

    //setting web
    Route::resource('/setting-web','backend\SettingwebController');

    //Transaksi Manual
    Route::get('/transaksi-manual','backend\TransaksiManualController@index');
    Route::get('/transaksi-manual/get-data-produk','backend\TransaksiManualController@getdataproduk');
    Route::post('/transaksi-manual/add-new-pengguna','backend\TransaksiManualController@addpengguna');
    Route::post('/transaksi-manual/simpan-transaksi','backend\TransaksiManualController@simpantransaksi');
    Route::post('/transaksi-manual/add-detail-produk','backend\TransaksiManualController@adddetailproduk');
    Route::get('/transaksi-manual/caripelanggan','backend\TransaksiManualController@caripelanggan');
    Route::get('/transaksi-manual/cari-produk','backend\TransaksiManualController@cariproduk');
    Route::delete('/transaksi-manual/hapusproduk/{id}','backend\TransaksiManualController@hapusproduk');
    Route::get('/transaksi-manual/caridetail-pelanggan/{id}','backend\TransaksiManualController@caridetailpelanggan');
    Route::get('/transaksi-manual/cari-detail-vocher/{id}','backend\TransaksiManualController@caridetailvocher');
    Route::get('/transaksi-manual/cari-detail-barang/{id}','backend\TransaksiManualController@caridetailbarang');

    //List Transaksi
    Route::get('/list-transaksi','backend\TransaksiController@index');
    Route::get('/data-list-transaksi','backend\TransaksiController@listdata');
    Route::get('/list-transaksi/get-detail/{kode}','backend\TransaksiController@getdetail');

    //List Order
    Route::get('/list-order','backend\OrderController@index');
    Route::get('/transaki-online/{kode}','backend\OrderController@edittrx');
    Route::get('/data-list-order','backend\OrderController@listdata');
    Route::post('/data-list-order/cancel-trx/{kode}','backend\OrderController@canceltrx');
    Route::post('/data-list-order/acc-trx/{kode}','backend\OrderController@acctrx');
    Route::post('/transaksi-online/simpan-transaksi','backend\OrderController@simpantransaksi');
   
     //Laporan
     Route::get('/laporan-transaksi','backend\LaporanController@index');
     Route::get('/laporan-transaksi/tampil','backend\LaporanController@tampiltransaksi');
     Route::get('/laporan-detail-transaksi','backend\LaporanController@caridetailtransaksi');
     Route::get('/laporan-detail-transaksi/tampil','backend\LaporanController@tampildetailtransaksi');
     Route::get('/laporan-penjualan-perbarang','backend\LaporanController@caripenjualanbarang');
     Route::get('/laporan-penjualan-perbarang/tampil','backend\LaporanController@tampilpenjualanbarang');
     Route::get('/laporan-detail-penjualan-perbarang','backend\LaporanController@caridetailpenjualanbarang');
     Route::get('/laporan-detail-penjualan-perbarang/tampil','backend\LaporanController@tampildetailpenjualanbarang');
     Route::get('/laporan-transaksi-peradmin','backend\LaporanController@caritransaksiperadmin');
     Route::get('/laporan-transaksi-peradmin/tampil','backend\LaporanController@tampiltransaksiperadmin');
     Route::get('/laporan-shift-peradmin','backend\LaporanController@carishiftperadmin');
     Route::get('/laporan-shift-peradmin/tampil','backend\LaporanController@tampilshiftperadmin');
});
