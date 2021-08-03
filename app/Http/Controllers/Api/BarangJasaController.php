<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangJasa;

class BarangJasaController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => BarangJasa::all()
        ], 200);
    }

    public function getDataById($id)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => BarangJasa::findOrFail($id)
        ], 200);
    }

    public function getDataByJenis($jenis)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => BarangJasa::where('jenis', $jenis)->get()
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $bj = BarangJasa::create($input);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dibuat',
            'result' => $bj,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $bj = BarangJasa::findOrFail($id);
        $bj->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil diupdate',
            'result' => $bj
        ], 200);
    }

    public function delete($id)
    {
        $bj = BarangJasa::findOrFail($id);
        $bj->delete();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dihapus',
            'result' => null
        ], 200);
    }
}
