<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SandiTransaksi;

class SandiTransaksiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => SandiTransaksi::all()
        ], 200);
    }

    public function getDataById($id)
    {
        $sandi_transaksi = SandiTransaksi::find($id);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $sandi_transaksi
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $sandi_transaksi = SandiTransaksi::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $sandi_transaksi
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $sandi_transaksi = SandiTransaksi::find($id);
        $input = $request->all();
        $sandi_transaksi->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $sandi_transaksi
        ], 200);   
    }

    public function delete($id)
    {
        $sandi_transaksi = SandiTransaksi::find($id);
        $sandi_transaksi->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
