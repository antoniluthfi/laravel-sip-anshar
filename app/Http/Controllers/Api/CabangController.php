<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = Cabang::all();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $cabang
        ], 200);
    }

    public function getDataById($id)
    {
        $cabang = Cabang::where('id', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $cabang
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $cabang = Cabang::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $cabang
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $cabang = Cabang::where('id', $id)->first();
        $input = $request->all();
        $cabang->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $cabang
        ], 200);
    }

    public function delete($id)
    {
        $cabang = Cabang::where('id', $id)->first();
        $cabang->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
