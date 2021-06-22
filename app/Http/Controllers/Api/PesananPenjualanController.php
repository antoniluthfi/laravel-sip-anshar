<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PesananPenjualan;

class PesananPenjualanController extends Controller
{
    public function index()
    {
        $pesananPenjualan = PesananPenjualan::with('barang', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function getDataById($id)
    {
        $pesananPenjualan = PesananPenjualan::with('barang', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran')->where('id', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function getDataByUserId($id)
    {
        $pesananPenjualan = PesananPenjualan::with('barang', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran')->where('id_penjual', $id)->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function create(Request $request)
    {
        $data = PesananPenjualan::orderBy('id', 'desc')->first();
        if($data) {
            $id = $data->id + 1;
        } else {
            $id = 1;
        }

        $input = $request->all();

        date_default_timezone_set('Asia/Jakarta');
        $input['kode_pesanan'] = "SO." . date('Ymd') . ".$id";
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
        $pesananPenjualan = PesananPenjualan::where('id', $id)->first();
        $input = $request->all();
        $pesananPenjualan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pesananPenjualan
        ], 200);
    }

    public function delete($id)
    {
        $pesananPenjualan = PesananPenjualan::where('id', $id)->first();
        $pesananPenjualan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
