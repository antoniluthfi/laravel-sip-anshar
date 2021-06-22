<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriBarang;

class KategoriBarangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => KategoriBarang::with('purchasing')->get()
        ], 200);
    }

    public function getDataById($id)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => KategoriBarang::with('purchasing')->first()
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $kategori = KategoriBarang::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $kategori
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriBarang::where('id', $id)->first();
        $input = $request->all();
        $kategori->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $kategori
        ], 200);
    }

    public function delete($id)
    {
        $kategori = KategoriBarang::where('id', $id)->first();
        $kategori->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
