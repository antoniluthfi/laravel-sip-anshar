<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ekspedisi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PengirimanPesanan;
use App\Models\PesananPenjualan;
use App\Models\FakturPenjualan;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
        $pengirimanPesanan = PengirimanPesanan::with('pesananPenjualan', 'fakturPenjualan', 'user', 'ekspedisi', 'cabang')->where('kode_pengiriman', $id)->first();

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
        $kode_pengiriman = IdGenerator::generate([
            'table' => 'pengiriman_pesanan',
            'length' => 10,
            'prefix' => 'DO.',
            'field' => 'kode_pengiriman'
        ]);

        $input = $request->all();
        $input['kode_pengiriman'] = $kode_pengiriman;
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
        $pengirimanPesanan = PengirimanPesanan::where('kode_pesanan', $id)->first();
        $input = $request->all();
        unset($input['total_harga']);
        
        $ekspedisi = Ekspedisi::where('nama_ekspedisi', $request->ekspedisi)->first();
        if($ekspedisi) {
            $input['id_ekspedisi'] = $ekspedisi->id;
            unset($input['ekspedisi']);
        }

        $pengirimanPesanan->fill($input)->save();
        
        $pesananPenjualan = PesananPenjualan::where('kode_pesanan', $id)->first();
        $pesananPenjualan->total_harga = $request->total_harga;
        $pesananPenjualan->update();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pengirimanPesanan
        ], 200);
    }

    public function deletePesananPenjualan($id)
    {
        $pengirimanPesanan = PengirimanPesanan::where('kode_pesanan', $id)->first();
        if($pengirimanPesanan) {
            $pengirimanPesanan->delete();
    
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
                'errors' => null,
                'result' => null
            ], 200);
        }
    }

    public function delete($id)
    {
        $pengirimanPesanan = PengirimanPesanan::where('kode_pengiriman', $id)->first();
        $fakturPenjualan = FakturPenjualan::where('kode_pesanan', $pengirimanPesanan->kode_pesanan)->first();
        
        if($fakturPenjualan) {
            $fakturPenjualan->delete();
        }
        
        $pengirimanPesanan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
