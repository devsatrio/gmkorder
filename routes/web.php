<?php

use Illuminate\Support\Facades\Route;
//==================================================================================index
Route::get('/', 'frontend\HomeController@index');

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

    //import produk
    Route::get('/import-export/produk','backend\ProdukController@importexport');
    Route::post('/import-export/produk/import','backend\ProdukController@importproduk');
    Route::get('/import-export/produk/export','backend\ProdukController@exportproduk');
    Route::get('/import-export/produk-kategori/export','backend\ProdukController@exportprodukkategori');

    //produk
    Route::get('/data-produk','backend\ProdukController@listdata');
    Route::resource('/produk','backend\ProdukController');

    //Gambar produk
    Route::post('/produk/add-gambar-produk','backend\ProdukController@addgambar');
    Route::delete('/produk/hapus-gambar/{id}','backend\ProdukController@hapusgambar');

    //penyesuaian stok 
    Route::get('/data-log-stok','backend\PenyesuaianStokController@listdata');
    Route::get('/penyesuaian-stok/import-export','backend\PenyesuaianStokController@importexport');
    Route::get('/penyesuaian-stok/export','backend\PenyesuaianStokController@export');
    Route::post('/penyesuaian-stok/produk/export','backend\PenyesuaianStokController@import');
    Route::get('/penyesuaian-stok/cari-detail-barang/{id}','backend\PenyesuaianStokController@detailbarang');
    Route::resource('/penyesuaian-stok','backend\PenyesuaianStokController');


    Route::resource('/slider','backend\SliderController');
    Route::resource('/setting-web','backend\SettingwebController');
    
});
