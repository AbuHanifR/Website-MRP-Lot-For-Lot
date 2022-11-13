<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });

//Master Produk
Route::get('master_produk/edit/{id}', 'produk\ProdukController@edit');
Route::post('master_produk/update/{id}', 'produk\ProdukController@update');
Route::resource('master_produk', 'produk\ProdukController');
Route::get('master_produk/destroy/{id}', 'produk\ProdukController@destroy');

//Master Bahan Baku
Route::resource('master_bahan_baku', 'masterbb\masterbahanController');
Route::get('master_bahan_baku/edit/{id}', 'masterbb\masterbahanController@edit');
Route::post('master_bahan_baku/update/{id}', 'masterbb\masterbahanController@update');
Route::get('master_bahan_baku/destroy/{id}', 'masterbb\masterbahanController@destroy');

//Bill Of Material
Route::resource('bom', 'bom\BomController');
Route::get('bom/hapusdata/{id}', 'bom\BomController@hapusdata');
Route::post('bom/simpandata', 'bom\BomController@simpandata');
Route::get('bom/edit/{id}', 'bom\BomController@edit');
Route::get('bom/detail/{id}', 'bom\BomController@detail');
Route::get('bom/destroy/{id}', 'bom\BomController@destroy');
Route::get('detailbom/destroy/{id}', 'bom\detailbomController@destroy')->name('detailbom.hapus');
Route::resource('detailbom', 'bom\detailbomController');

//Penerimaan Pesanan
Route::resource('pesanan', 'pesanan\PesananController');
Route::get('pesanan/hapusdata/{id}', 'pesanan\PesananController@hapusdata');
Route::post('pesanan/simpandata', 'pesanan\PesananController@simpandata');
Route::get('pesanan/edit/{id}', 'pesanan\PesananController@edit');
Route::get('pesanan/detail/{id}', 'pesanan\PesananController@detail');
Route::get('pesanan/destroy/{id}', 'pesanan\PesananController@destroy');
Route::get('detailpesanan/destroy/{id}', 'pesanan\detailpesananController@destroy')->name('detailpesanan.hapus');
Route::resource('detailpesanan', 'pesanan\detailpesananController');

//MPS
Route::get('mps/hapus_session', 'mps\MPSController@hapus_session')->name('mps.hapus_session');
Route::resource('mps', 'mps\MPSController');
Route::post('mps/simpandata', 'mps\MPSController@simpandata');
Route::resource('laporan_mps', 'mps\LaporanMPSController');
Route::get('laporan_mps/detail/{id}', 'mps\LaporanMPSController@detail');


//MRP
Route::get('mrp/hitung', 'mrp\MRPController@hitung')->name('mrp.hitung');
Route::resource('mrp', 'mrp\MRPController');



//Bahan Baku Masuk
Route::resource('bahan_baku_masuk', 'transaksimasuk\TransaksiMasukController');
Route::get('bahan_baku_masuk/hapusdata/{id}', 'transaksimasuk\TransaksiMasukController@hapusdata');
Route::post('bahan_baku_masuk/simpandata', 'transaksimasuk\TransaksiMasukController@simpandata');
Route::get('bahan_baku_masuk/edit/{id}', 'transaksimasuk\TransaksiMasukController@edit');
Route::get('bahan_baku_masuk/detail/{id}', 'transaksimasuk\TransaksiMasukController@detail');
Route::get('bahan_baku_masuk/destroy/{id}', 'transaksimasuk\TransaksiMasukController@destroy');
Route::get('detailbahanbakumasuk/destroy/{id}', 'transaksimasuk\detailmasukController@destroy')->name('detailbahanbakumasuk.hapus');
Route::resource('detailbahanbakumasuk', 'transaksimasuk\detailmasukController');
Route::resource('laporan_masuk', 'transaksimasuk\LaporanMasukController');
Route::post('laporan_masuk/filter', 'transaksimasuk\LaporanMasukController@filter');
// Route::get('laporan_masuk/laporan/{id}', 'transaksimasuk\LaporanMasukController@laporan');



//Bahan Baku Keluar
Route::resource('bahan_baku_keluar', 'transaksikeluar\TransaksiKeluarController');
Route::get('bahan_baku_keluar/hapusdata/{id}', 'transaksikeluar\TransaksiKeluarController@hapusdata');
Route::post('bahan_baku_keluar/simpandata', 'transaksikeluar\TransaksiKeluarController@simpandata');
Route::get('bahan_baku_keluar/edit/{id}', 'transaksikeluar\TransaksiKeluarController@edit');
Route::get('bahan_baku_keluar/detail/{id}', 'transaksikeluar\TransaksiKeluarController@detail');
Route::get('bahan_baku_keluar/destroy/{id}', 'transaksikeluar\TransaksiKeluarController@destroy');
Route::get('detailbahanbakukeluar/destroy/{id}', 'transaksikeluar\detailkeluarController@destroy')->name('detailbahanbakukeluar.hapus');
Route::resource('detailbahanbakukeluar', 'transaksikeluar\detailkeluarController');
Route::resource('laporan_keluar', 'transaksikeluar\LaporanKeluarController');
Route::get('laporan_keluar/laporan/{id}', 'transaksikeluar\LaporanKeluarController@laporan');
Route::post('laporan_keluar/filter', 'transaksikeluar\LaporanKeluarController@filter');

//Dashboard Masuk
Route::resource('dashboard_masuk', 'dashboard\dashboardmasukController');
Route::get('dashboardchart1', 'dashboard\dashboardmasukController@chartku1');
Route::get('dashboardchart2', 'dashboard\dashboardmasukController@chartku2');

//Laporan Perpesanan
Route::resource('laporan_perpesanan', 'laporan\PerpesananController');
Route::post('laporan_perpesanan/filter', 'laporan\PerpesananController@filter');

//Laporan Perbulan
Route::resource('laporan_perbulan', 'laporan\PerbulanController');
Route::post('laporan_perbulan/filter2', 'laporan\PerbulanController@filter2');

//Dashboard PPIC
Route::resource('dashboard_ppic', 'dashboard\dashboardppicController');
Route::get('dashboardchart', 'dashboard\dashboardppicController@chartku');

// Login
Route::get('/','Auth\LoginController@index');
Route::post('/login','Auth\LoginController@authenticate');
Route::post('/logout','Auth\LoginController@logout');

//Cetak Laporan MPS
Route::get("/cetaklaporanmps/{id}", "mps\LaporanMPSController@cetakpdf")->name('cetaklaporanmps');

//Laporan Pemesanan
Route::resource('laporan_pemesanan', 'laporan\PemesananController');
Route::post('laporan_pemesanan/filter3', 'laporan\PemesananController@filter3');

//Kartu Stok
Route::resource('kartu_stok', 'laporan\KartuStokController');