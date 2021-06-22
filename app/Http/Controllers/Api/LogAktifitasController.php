<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogAktifitas;

class LogAktifitasController extends Controller
{
    public function index()
    {
        $log = LogAktifitas::all();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $log
        ], 200);
    }

    public function getDataById($id)
    {
        $log = LogAktifitas::where('id', $id)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $log
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $log = LogAktifitas::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $log
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $log = LogAktifitas::where('id', $id)->first();
        $input = $request->all();
        $log->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $log
        ], 200);
    }

    public function delete($id)
    {
        $log = LogAktifitas::where('id', $id)->first();
        $log->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
