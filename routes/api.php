<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CabangController;
use App\Http\Controllers\Api\StokBarangController;
use App\Http\Controllers\Api\KategoriBarangController;
use App\Http\Controllers\Api\LogAktifitasController;
use App\Http\Controllers\Api\PesananPenjualanController;
use App\Http\Controllers\Api\PengirimanPesananController;
use App\Http\Controllers\Api\EkspedisiController;
use App\Http\Controllers\Api\SyaratPembayaranController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\FakturPenjualanController;
use App\Http\Controllers\Api\PaketBarangController;
use App\Http\Controllers\Api\SandiTransaksiController;
use App\Http\Controllers\Api\PenerimaanController;
use App\Http\Controllers\Api\PengerjaanController;
use App\Http\Controllers\Api\DetailPengerjaanController;
use App\Http\Controllers\Api\PengembalianController;
use App\Http\Controllers\Api\ArusKasController;
use App\Http\Controllers\Api\RajaOngkirController;
use App\Http\Controllers\Api\BarangJasaController;
use App\Http\Controllers\Api\MerekTipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logoutall', [AuthController::class, 'logoutall']);

    Route::get('user', [UsersController::class, 'index']);
    Route::get('user/my/profile', [UsersController::class, 'getCurrentUser']);
    Route::get('user/{id}', [UsersController::class, 'getUserById']);
    Route::get('user/name/{name}', [UsersController::class, 'getUserByName']);
    Route::get('user/role/{role}', [UsersController::class, 'getUserByRole']);
    Route::get('user/cabang/{cabang}/role/{role}', [UsersController::class, 'getUserByRole']);
    Route::post('user', [UsersController::class, 'create']);
    Route::put('user/{id}', [UsersController::class, 'update']);
    Route::delete('user/{id}', [UsersController::class, 'delete']);

    Route::get('cabang', [CabangController::class, 'index']);
    Route::get('cabang/{id}', [CabangController::class, 'getDataById']);
    Route::post('cabang', [CabangController::class, 'create']);
    Route::put('cabang/{id}', [CabangController::class, 'update']);
    Route::delete('cabang/{id}', [CabangController::class, 'delete']);

    Route::get('stok-barang', [StokBarangController::class, 'index']);
    Route::get('stok-barang/data/available/{id_cabang}', [StokBarangController::class, 'getDataAvailable']);
    Route::get('stok-barang/jenis/non-paket', [StokBarangController::class, 'getDataNonPaket']);
    Route::get('stok-barang/{id}', [StokBarangController::class, 'getDataById']);
    Route::post('stok-barang', [StokBarangController::class, 'create']);
    Route::put('stok-barang/{id}', [StokBarangController::class, 'update']);
    Route::delete('stok-barang/{id}', [StokBarangController::class, 'delete']);

    Route::get('kategori-barang', [KategoriBarangController::class, 'index']);
    Route::get('kategori-barang/{id}', [KategoriBarangController::class, 'getDataById']);
    Route::post('kategori-barang', [KategoriBarangController::class, 'create']);
    Route::put('kategori-barang/{id}', [KategoriBarangController::class, 'update']);
    Route::delete('kategori-barang/{id}', [KategoriBarangController::class, 'delete']);

    Route::get('log-aktifitas', [LogAktifitasController::class, 'index']);
    Route::get('log-aktifitas/{id}', [LogAktifitasController::class, 'getDataById']);
    Route::post('log-aktifitas', [LogAktifitasController::class, 'create']);
    Route::put('log-aktifitas/{id}', [LogAktifitasController::class, 'update']);
    Route::delete('log-aktifitas/{id}', [LogAktifitasController::class, 'delete']);

    Route::get('pesanan-penjualan', [PesananPenjualanController::class, 'index']);
    Route::get('pesanan-penjualan/{id}', [PesananPenjualanController::class, 'getDataById']);
    Route::get('pesanan-penjualan/user/{id}', [PesananPenjualanController::class, 'getDataByUserId']);
    Route::post('pesanan-penjualan', [PesananPenjualanController::class, 'create']);
    Route::put('pesanan-penjualan/{id}', [PesananPenjualanController::class, 'update']);
    Route::delete('pesanan-penjualan/{id}', [PesananPenjualanController::class, 'delete']);

    Route::get('pengiriman-pesanan', [PengirimanPesananController::class, 'index']);
    Route::get('pengiriman-pesanan/{id}', [PengirimanPesananController::class, 'getDataById']);
    Route::get('pengiriman-pesanan/marketing/{id_marketing}', [PengirimanPesananController::class, 'getDataByIdMarketing']);
    Route::post('pengiriman-pesanan', [PengirimanPesananController::class, 'create']);
    Route::put('pengiriman-pesanan/{id}', [PengirimanPesananController::class, 'update']);
    Route::delete('pengiriman-pesanan/kode-pesanan/{id}', [PengirimanPesananController::class, 'deletePesananPenjualan']);
    Route::delete('pengiriman-pesanan/{id}', [PengirimanPesananController::class, 'delete']);

    Route::get('ekspedisi', [EkspedisiController::class, 'index']);
    Route::get('ekspedisi/{id}', [EkspedisiController::class, 'getDataById']);
    Route::post('ekspedisi', [EkspedisiController::class, 'create']);
    Route::put('ekspedisi/{id}', [EkspedisiController::class, 'update']);
    Route::delete('ekspedisi/{id}', [EkspedisiController::class, 'delete']);

    Route::get('syarat-pembayaran', [SyaratPembayaranController::class, 'index']);
    Route::get('syarat-pembayaran/{id}', [SyaratPembayaranController::class, 'getDataById']);
    Route::post('syarat-pembayaran', [SyaratPembayaranController::class, 'create']);
    Route::put('syarat-pembayaran/{id}', [SyaratPembayaranController::class, 'update']);
    Route::delete('syarat-pembayaran/{id}', [SyaratPembayaranController::class, 'delete']);

    Route::get('bank', [BankController::class, 'index']);
    Route::get('bank/{id}', [BankController::class, 'getDataById']);
    Route::post('bank', [BankController::class, 'create']);
    Route::put('bank/{id}', [BankController::class, 'update']);
    Route::delete('bank/{id}', [BankController::class, 'delete']);

    Route::get('faktur-penjualan', [FakturPenjualanController::class, 'index']);
    Route::get('faktur-penjualan/{no_faktur}', [FakturPenjualanController::class, 'getDataById']);
    Route::get('faktur-penjualan/marketing/{marketing_id}', [FakturPenjualanController::class, 'getDataByMarketingId']);
    Route::get('faktur-penjualan/pemasukan/{kategori}/{marketing_id}', [FakturPenjualanController::class, 'getDataPemasukanByMarketingId']);
    Route::get('faktur-penjualan/pemasukan/per/kategori-barang/{marketing_id}', [FakturPenjualanController::class, 'getDataPemasukanByKategori']);
    Route::post('faktur-penjualan', [FakturPenjualanController::class, 'create']);
    Route::put('faktur-penjualan/{no_faktur}', [FakturPenjualanController::class, 'update']);
    Route::delete('faktur-penjualan/{no_faktur}', [FakturPenjualanController::class, 'delete']);

    Route::get('paket-barang', [PaketBarangController::class, 'index']);
    Route::post('paket-barang', [PaketBarangController::class, 'create']);
    Route::delete('paket-barang/{id}', [PaketBarangController::class, 'delete']);

    Route::get('sandi-transaksi', [SandiTransaksiController::class, 'index']);
    Route::get('sandi-transaksi/{id}', [SandiTransaksiController::class, 'getDataById']);
    Route::post('sandi-transaksi', [SandiTransaksiController::class, 'create']);
    Route::put('sandi-transaksi/{id}', [SandiTransaksiController::class, 'update']);
    Route::delete('sandi-transaksi/{id}', [SandiTransaksiController::class, 'delete']);

    Route::get('penerimaan', [PenerimaanController::class, 'index']);
    Route::get('penerimaan/{no_service}', [PenerimaanController::class, 'getDataByNoService']);
    Route::get('penerimaan/user/{id}', [PenerimaanController::class, 'getDataByIdAdmin']);
    Route::post('penerimaan', [PenerimaanController::class, 'create']);
    Route::put('penerimaan/{no_service}', [PenerimaanController::class, 'update']);
    Route::delete('penerimaan/{no_service}', [PenerimaanController::class, 'delete']);

    Route::get('pengerjaan', [PengerjaanController::class, 'index']);
    Route::get('pengerjaan/teknisi/{id}', [PengerjaanController::class, 'getDataByIdTeknisi']);
    Route::get('pengerjaan/total/pendingan/{id}', [PengerjaanController::class, 'getTotalPendingan']);
    Route::get('pengerjaan/{no_pengerjaan}', [PengerjaanController::class, 'getDataByNoPengerjaan']);
    Route::post('pengerjaan', [PengerjaanController::class, 'create']);
    Route::put('pengerjaan/{no_pengerjaan}', [PengerjaanController::class, 'update']);
    Route::delete('pengerjaan/{no_pengerjaan}', [PengerjaanController::class, 'delete']);

    Route::get('detail-pengerjaan', [DetailPengerjaanController::class, 'index']);
    Route::post('detail-pengerjaan', [DetailPengerjaanController::class, 'create']);
    Route::put('detail-pengerjaan/{no_pengerjaan}', [DetailPengerjaanController::class, 'update']);
    Route::delete('detail-pengerjaan/{no_pengerjaan}', [DetailPengerjaanController::class, 'delete']);

    Route::get('pengembalian', [PengembalianController::class, 'index']);
    Route::get('pengembalian/{no_pengembalian}', [PengembalianController::class, 'getDataByNoPengembalian']);
    Route::post('pengembalian', [PengembalianController::class, 'create']);
    Route::put('pengembalian/{no_pengembalian}', [PengembalianController::class, 'update']);
    Route::put('pengembalian/reset/{no_pengembalian}', [PengembalianController::class, 'reset']);
    Route::delete('pengembalian/{no_pengembalian}', [PengembalianController::class, 'delete']);

    Route::get('arus-kas', [ArusKasController::class, 'index']);
    Route::get('arus-kas/{id}', [ArusKasController::class, 'getDataById']);
    Route::post('arus-kas', [ArusKasController::class, 'create']);
    Route::put('arus-kas/{id}', [ArusKasController::class, 'update']);
    Route::delete('arus-kas/{id}', [ArusKasController::class, 'delete']);

    Route::get('rajaongkir/provinsi', [RajaOngkirController::class, 'getProvinsi']);
    Route::get('rajaongkir/kota/{id_provinsi}', [RajaOngkirController::class, 'getKotaByIdProvinsi']);
    Route::post('rajaongkir/ongkir', [RajaOngkirController::class, 'getOngkir']);

    Route::get('barang-jasa', [BarangJasaController::class, 'index']);
    Route::get('barang-jasa/{id}', [BarangJasaController::class, 'getDataById']);
    Route::get('barang-jasa/jenis/{jenis}', [BarangJasaController::class, 'getDataByJenis']);
    Route::post('barang-jasa', [BarangJasaController::class, 'create']);
    Route::put('barang-jasa/{id}', [BarangJasaController::class, 'update']);
    Route::delete('barang-jasa/{id}', [BarangJasaController::class, 'delete']);

    Route::get('merek-tipe', [MerekTipeController::class, 'index']);
    Route::get('merek-tipe/{id}', [MerekTipeController::class, 'getDataById']);
    Route::get('merek-tipe/kategori/{id}', [MerekTipeController::class, 'getDataByKategori']);
    Route::post('merek-tipe', [MerekTipeController::class, 'create']);
    Route::put('merek-tipe/{id}', [MerekTipeController::class, 'update']);
    Route::delete('merek-tipe/{id}', [MerekTipeController::class, 'delete']);
});
