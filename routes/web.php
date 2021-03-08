<?php

use Illuminate\Support\Facades\Route;
//==================================================================================index
Route::get('/', 'frontend\FrontControl@index');
// ==================================================================================frontend
Route::prefix('katalog')->group(function(){
    Route::get('cari-katalog/{cari}','frontend\FrontControl@cariKatalog')->name('cari.katalog');
    ROute::get('produk-list/{id}/{ktg}','frontend\FrontControl@listProduk')->name('produk');
});
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
    Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
    Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

    //admin
    Route::get('/data-admin','backend\AdminController@listdata');
    Route::resource('/admin','backend\AdminController');

    //pengguna
    Route::get('/data-pengguna','backend\PenggunaController@listdata');
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
    Route::get('/transaksi-manual/cari-detail-barang/{id}','backend\TransaksiManualController@caridetailbarang');
    Route::resource('/transaksi-manual','backend\TransaksiManualController');
});
