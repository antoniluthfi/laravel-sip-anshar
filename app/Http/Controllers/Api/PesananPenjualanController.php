<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PesananPenjualan;
use App\Models\DetailPesananPenjualan;
use App\Models\StokBarang;
use App\Models\DetailStokBarang;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PesananPenjualanController extends Controller
{
    public function index()
    {
        $pesananPenjualan = PesananPenjualan::with('detailPesananPenjualan', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran', 'cabang')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function getDataById($id)
    {
        $pesananPenjualan = PesananPenjualan::with('detailPesananPenjualan', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran', 'cabang')->where('kode_pesanan', $id)->first();

        foreach ($pesananPenjualan->detailPesananPenjualan as $key => $val) {
            $detailStok = DetailStokBarang::where('id_barang', $val->id_barang)
                        ->where('id_cabang', $pesananPenjualan->id_cabang)
                        ->first();

            $pesananPenjualan->detailPesananPenjualan[$key]->stok_tersedia = $detailStok->stok_tersedia;
            $pesananPenjualan->detailPesananPenjualan[$key]->stok_dapat_dijual = $detailStok->stok_dapat_dijual;
        }

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function getDataByUserId($id)
    {
        $pesananPenjualan = PesananPenjualan::with('detailPesananPenjualan', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran', 'cabang')->where('id_penjual', $id)->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function getListKodePesanan()
    {
        $pesananPenjualan = PesananPenjualan::select('kode_pesanan AS kode')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function create(Request $request)
    {
        // otentikasi user
        $user = User::findOrFail($request->user_id);

        // generate kode pesanan
        $kode_pesanan = IdGenerator::generate([
            'table' => 'pesanan_penjualan',
            'length' => 10,
            'prefix' => 'SO.',
            'field' => 'kode_pesanan'
        ]);

        // proses input detail pesanan penjualan
        $total_harga_keseluruhan = 0;
        $total_berat = 0;
        foreach ($request->barang as $barang) {
            // cek stok barang
            $stok_barang = StokBarang::findOrFail($barang['id_barang']);

            // cek user atau reseller untuk tentukan harga
            if($user->hak_akses === 'user') {
                $harga = $stok_barang->harga_user;
            } else {
                $harga = $stok_barang->harga_reseller;
            }

            // hitung total harga
            $total_harga = (int) $barang['kuantitas'] * (int) $harga;
            $total_harga_keseluruhan += (int) $total_harga;

            // hitung total berat barang
            $total_berat += (int) $barang['berat'];
    
            // cek stok barang sesuai cabang
            $get_detail_stok = DB::select("SELECT * FROM `detail_stok_barang` WHERE id_barang=" . $barang['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            // update stok cabang
            $stok_tersedia = (int) $get_detail_stok[0]->stok_tersedia - (int) $barang['kuantitas'];
            $stok_dapat_dijual = (int) $get_detail_stok[0]->stok_dapat_dijual - (int) $barang['kuantitas'];

            DB::select("UPDATE `detail_stok_barang` SET `stok_tersedia`=" . $stok_tersedia . ",`stok_dapat_dijual`=" . $stok_dapat_dijual . " WHERE id_barang=" . $barang['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            // buat detail pesanan penjualan
            $input = [
                'kode_pesanan' => $kode_pesanan,
                'id_barang' => $barang['id_barang'],
                'kuantitas' => $barang['kuantitas'],
                'total_harga' => $total_harga
            ];

            DetailPesananPenjualan::create($input);
        }

        $harga_diskon = 0;
        $diskon = $request->diskon;
        if($request->tipe_diskon === 'persen') {
            $harga_diskon = (int) $total_harga_keseluruhan / 100 * (int) $request->diskon;
            $total_harga_keseluruhan -= (int) $harga_diskon;
        }

        if($request->tipe_diskon === 'langsung') {
            $harga_diskon = $request->diskon;
            $total_harga_keseluruhan -= (int) $harga_diskon;
        }

        $input = [];
        $input = [
            'kode_pesanan' => $kode_pesanan,
            'user_id' => $user->id,
            'diskon' => $harga_diskon,
            'total_harga' => $total_harga_keseluruhan,
            'id_penjual' => Auth::user()->id,
            'id_syarat_pembayaran' => $request->id_syarat_pembayaran,
            'id_cabang' => $request->id_cabang,
            'total_berat' => $total_berat,
            'keterangan' => $request->keterangan
        ];

        $pesananPenjualan = PesananPenjualan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($request->user_id);
        $detailPesananPenjualan = DetailPesananPenjualan::where('kode_pesanan', $id)->get();

        foreach ($detailPesananPenjualan as $detail) {
            $data_stok = DB::select("SELECT * FROM `detail_stok_barang` WHERE id_barang=" . $detail['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            $stok_tersedia = (int) $data_stok[0]->stok_tersedia + (int) $detail->kuantitas;
            $stok_dapat_dijual = (int) $data_stok[0]->stok_dapat_dijual + (int) $detail->kuantitas;
            
            DB::select("UPDATE `detail_stok_barang` SET `stok_tersedia`=" . $stok_tersedia . ",`stok_dapat_dijual`=" . $stok_dapat_dijual . " WHERE id_barang=" . $detail['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            $detail->delete();
        }

        $total_harga_keseluruhan = 0;
        foreach ($request->barang as $barang) {
            if($user->hak_akses === 'user') {
                $harga = $barang['harga_user'];
            } else {
                $harga = $barang['harga_reseller'];
            }

            $total_harga = (int) $barang['kuantitas'] * (int) $harga;
            $total_harga_keseluruhan += (int) $total_harga;

            $data_stok = DB::select("SELECT * FROM `detail_stok_barang` WHERE id_barang=" . $barang['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            $stok_tersedia = (int) $data_stok[0]->stok_tersedia - (int) $barang['kuantitas'];
            $stok_dapat_dijual = (int) $data_stok[0]->stok_dapat_dijual - (int) $barang['kuantitas'];
            
            DB::select("UPDATE `detail_stok_barang` SET `stok_tersedia`=" . $stok_tersedia . ",`stok_dapat_dijual`=" . $stok_dapat_dijual . " WHERE id_barang=" . $barang['id_barang'] . " AND id_cabang=" . $request->id_cabang);

            $input = [
                'kode_pesanan' => $id,
                'id_barang' => $barang['id_barang'],
                'kuantitas' => $barang['kuantitas'],
                'total_harga' => $total_harga
            ];
            DetailPesananPenjualan::create($input);
        }
        
        $harga_diskon = 0;
        $diskon = $request->diskon;
        if($request->tipe_diskon === 'persen') {
            $harga_diskon = (int) $total_harga_keseluruhan / 100 * (int) $request->diskon;
            $total_harga_keseluruhan -= (int) $harga_diskon;
        }

        if($request->tipe_diskon === 'langsung') {
            $harga_diskon = $request->diskon;
            $total_harga_keseluruhan -= (int) $harga_diskon;
        }

        $input = [];
        $input = [
            'user_id' => $user->id,
            'diskon' => $harga_diskon,
            'total_harga' => $total_harga_keseluruhan,
            'id_penjual' => Auth::user()->id,
            'id_syarat_pembayaran' => $request->id_syarat_pembayaran,
            'id_cabang' => $request->id_cabang,
            'keterangan' => $request->keterangan
        ];

        $pesananPenjualan = PesananPenjualan::where('kode_pesanan', $id)->first();
        $pesananPenjualan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $id
        ], 200);
    }

    public function delete($id)
    {
        $detailPesananPenjualan = DetailPesananPenjualan::where('kode_pesanan', $id)->get();
        foreach ($detailPesananPenjualan as $detail) {
            $detail->delete();
        }

        $pesananPenjualan = PesananPenjualan::where('kode_pesanan', $id)->first();
        $pesananPenjualan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
