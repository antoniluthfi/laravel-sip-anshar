<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketBarang;

class PaketBarangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => PaketBarang::with('paket', 'barang')->get()
        ], 200);
    }

    public function create(Request $request)
    {
        $payload = $request->payload;
        for ($i = 0; $i < count($payload); $i++) { 
            $input = [];
            $input['id_paket'] = $payload[$i]['id_paket'];
            $input['id_barang'] = $payload[$i]['id_barang'];
            $list = PaketBarang::create($input);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $request
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $paketBarang = PaketBarang::where('id_paket', $id)->get();
        for ($i = 0; $i < count($paketBarang); $i++) { 
            $paketBarang[$i]->delete();
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);
    }
}