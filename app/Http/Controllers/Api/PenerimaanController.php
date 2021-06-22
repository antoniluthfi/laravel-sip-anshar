<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penerimaan;

class PenerimaanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'data' => Penerimaan::all()
        ]);
    }

    public function getDataByNoService($no_service)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'data' => Penerimaan::where('no_service', $no_service)->first()
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $penerimaan = Penerimaan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $penerimaan
        ], 200);
    }

    public function update(Request $request, $no_service)
    {
        $penerimaan = Penerimaan::where('no_service', $no_service)->first();
        $input = $request->all();
        $penerimaan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $bank
        ], 200);   
    }

    public function delete($no_service)
    {
        $penerimaan = Penerimaan::where('no_service', $no_service)->first();
        $penerimaan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
