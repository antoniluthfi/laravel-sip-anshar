<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArusKas;
use App\Models\SandiTransaksi;
use Illuminate\Http\Request;

class ArusKasController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => ArusKas::with('admin', 'cabang')->get()
        ], 200);
    }

    public function getDataById($id)
    {
        $arusKas = ArusKas::with('admin', 'cabang')->where('id', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $arusKas
        ], 200);
    }

    public function create(Request $request)
    {
        $sandi_transaksi = SandiTransaksi::findOrFail($request->id_sandi_transaksi);

        $input = $request->all();
        $input['masuk'] = $sandi_transaksi->jenis_transaksi;
        $arusKas = ArusKas::create($input);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dibuat',
            'result' => $arusKas
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $arusKas = ArusKas::findOrFail($id);
        $arusKas->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil diupdate',
            'result' => $arusKas
        ], 200);
    }

    public function delete($id)
    {
        $arusKas = ArusKas::findOrFail($id);
        $arusKas->delete();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dibuat',
            'result' => null
        ], 200);
    }
}
