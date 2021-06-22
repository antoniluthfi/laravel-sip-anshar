<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekspedisi;

class EkspedisiController extends Controller
{
    public function index()
    {
        $ekspedisi = Ekspedisi::all();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $ekspedisi
        ], 200);
    }

    public function getDataById($id)
    {
        $ekspedisi = Ekspedisi::where('id', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $ekspedisi
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $ekspedisi = Ekspedisi::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $ekspedisi
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $ekspedisi = Ekspedisi::where('id', $id)->first();
        $input = $request->all();
        $ekspedisi->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $ekspedisi
        ], 200);
    }

    public function delete($id)
    {
        $ekspedisi = Ekspedisi::where('id', $id)->first();
        $ekspedisi->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
