<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPengerjaan;

class DetailPengerjaanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => DetailPengerjaan::all()
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $detail_pengerjaan = DetailPengerjaan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $detail_pengerjaan
        ], 200);
    }

    public function update(Request $request, $no_pengerjaan)
    {
        $input = $request->all();
        $detail_pengerjaans = DetailPengerjaan::where('no_pengerjaan', $no_pengerjaan)->get();

        foreach ($detail_pengerjaans as $detail_pengerjaan) {
            $detail_pengerjaan->fill($input)->save();
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
        ], 200);   
    }

    public function delete($no_pengerjaan)
    {
        $detail_pengerjaans = DetailPengerjaan::where('no_pengerjaan', $no_pengerjaan)->get();

        foreach ($detail_pengerjaans as $detail_pengerjaan) {
            $detail_pengerjaan->delete();
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
