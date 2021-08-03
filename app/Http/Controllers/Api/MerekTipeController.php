<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerekTipe;

class MerekTipeController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK', 
            'errors' => null,
            'result' => MerekTipe::with('barangJasa')->get()
        ], 200);
    }

    public function getDataById($id)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => MerekTipe::with('barangJasa')->where('id', $id)->first()
        ], 200);
    }

    public function getDataByKategori($id)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => MerekTipe::with('barangJasa')->where('id_barang_jasa', $id)->get()
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $merekTipe = MerekTipe::create($input);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dibuat',
            'result' => $merekTipe
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $merekTipe = MerekTipe::findOrFail($id);
        $merekTipe->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil diupdate',
            'result' => $merekTipe
        ], 200);
    }

    public function delete($id)
    {
        $merekTipe = MerekTipe::findOrFail($id);
        $merekTipe->delete();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dihapus',
            'result' => null
        ], 200);
    }
}
