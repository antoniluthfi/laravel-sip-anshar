<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakLaporanController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/laporan/barang/{tipeLaporan}/user/{user}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/pelanggan/{tipeLaporan}/user/{user}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/pelanggan/{tipeLaporan}/role/{role}/user/{user}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/transaksi/{tipeLaporan}/id/{id}', [CetakLaporanController::class, 'cetakLaporan']);

Route::get('tanda-terima-service/{no_service}', [CetakLaporanController::class, 'tandaTerimaService']);
Route::get('nota-service/{no_pengembalian}', [CetakLaporanController::class, 'notaService']);
Route::get('laporan-pengembalian/{dari}/{sampai}/{cabang}/{admin}', [CetakLaporanController::class, 'laporanPengembalian']);
Route::get('laporan-arus-kas/{dari}/{sampai}/{cabang}/{admin}', [CetakLaporanController::class, 'laporanArusKas']);
Route::get('laporan-penerimaan/{dari}/{sampai}/{cabang}/{admin}', [CetakLaporanController::class, 'laporanPenerimaan']);
Route::get('laporan-faktur-penjualan/{dari}/{sampai}/{marketing}', [CetakLaporanController::class, 'laporanFakturPenjualan']);
Route::get('laporan-pengiriman-pesanan/{dari}/{sampai}/{marketing}', [CetakLaporanController::class, 'laporanPengirimanPesanan']);
Route::get('laporan-pesanan-penjualan/{dari}/{sampai}/{marketing}', [CetakLaporanController::class, 'laporanPesananPenjualan']);
Route::get('surat-jalan/{no_surat_jalan}', [CetakLaporanController::class, 'suratJalan']);