<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengerjaan;

class PengerjaanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pengerjaan::all()
        ]);
    }

    public function getDataByNoPengerjaan($no_pengerjaan)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pengerjaan::where('no_pengerjaan', $no_pengerjaan)->first()
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $pengerjaan = Pengerjaan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $pengerjaan
        ], 200);
    }

    public function update(Request $request, $no_pengerjaan)
    {
        $input = $request->all();
        $pengerjaan = Pengerjaan::where('no_pengerjaan', $no_pengerjaan)->first();
        $pengerjaan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pengerjaan
        ], 200);   
    }

    public function delete($no_pengerjaan)
    {
        $pengerjaan = Pengerjaan::where('no_pengerjaan', $no_pengerjaan)->first();
        $pengerjaan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
