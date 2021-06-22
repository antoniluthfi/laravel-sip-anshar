<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pembayaran::all()
        ]);
    }

    public function getDataByNoBukti($no_bukti)
    {
        $pembayaran = Pembayaran::where('no_bukti', $no_bukti)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pembayaran
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $pembayaran = Pembayaran::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $pembayaran
        ], 200);
    }

    public function update(Request $request, $no_bukti)
    {
        $input = $request->all();
        $pembayaran = Pembayaran::where('no_bukti', $no_bukti)->first();
        $pembayaran->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pembayaran
        ], 200);  
    }

    public function delete($no_bukti)
    {
        $pembayaran = Pembayaran::where('no_bukti', $no_bukti)->first();
        $pembayaran->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);
    }
}
