<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PengirimanPesanan;

class PengirimanPesananController extends Controller
{
    public function index()
    {
        $pengirimanPesanan = PengirimanPesanan::with('pesananPenjualan', 'fakturPenjualan', 'user', 'ekspedisi', 'cabang')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function getDataById($id)
    {
        $pengirimanPesanan = PengirimanPesanan::with('pesananPenjualan', 'fakturPenjualan', 'user', 'ekspedisi', 'cabang')->where('id_pesanan_penjualan', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function getDataByIdMarKeting($id_marketing)
    {
        $pengirimanPesanan = PengirimanPesanan::with('pesananPenjualan', 'fakturPenjualan', 'user', 'ekspedisi', 'cabang')->where('id_marketing', $id_marketing)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function create(Request $request)
    {
        $data = DB::select("SELECT id_pesanan_penjualan FROM pengiriman_pesanan ORDER BY id_pesanan_penjualan DESC LIMIT 1");
        if(count($data) !== 0) {
            $id = $data[0]->id_pesanan_penjualan + 1;
        } else {
            $id = 1;
        }

        $input = $request->all();

        date_default_timezone_set('Asia/Jakarta');
        $input['kode_pengiriman'] = "DO." . date('Ymd') . ".$id";
        $pengirimanPesanan = PengirimanPesanan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pengirimanPesanan = PengirimanPesanan::where('id_pesanan_penjualan', $id)->first();
        $input = $request->all();
        $pengirimanPesanan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function delete($id)
    {
        $pengirimanPesanan = PengirimanPesanan::where('id_pesanan_penjualan', $id)->first();
        $pengirimanPesanan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
