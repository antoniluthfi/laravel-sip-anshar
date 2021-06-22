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


Route::get('/laporan/barang/{tipeLaporan}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/pelanggan/{tipeLaporan}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/pelanggan/{tipeLaporan}/role/{role}', [CetakLaporanController::class, 'cetakLaporan']);
Route::get('/laporan/transaksi/{tipeLaporan}/id/{id}', [CetakLaporanController::class, 'cetakLaporan']);