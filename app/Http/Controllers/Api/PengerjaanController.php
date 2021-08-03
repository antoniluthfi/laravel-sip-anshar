<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Models\Pengerjaan;
use App\Models\TeknisiPJ;

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

    public function getDataByIdTeknisi($id)
    {
        $pengerjaan = TeknisiPJ::with('pengerjaan', 'teknisi', 'penerimaan')->where('id_teknisi', $id)->orderBy('created_at', 'desc')->get();
    
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengerjaan
        ]);
    }

    public function getDataByNoPengerjaan($no_pengerjaan)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pengerjaan::with('penerimaan')->where('no_pengerjaan', $no_pengerjaan)->first()
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
        $pengerjaan = Pengerjaan::where('no_pengerjaan', $no_pengerjaan)->first();

        $input = $request->all();
        if($input['status_pengerjaan'] == 1) {
            $input['waktu_selesai'] = date('Y-m-d H:i:s');

            Pengembalian::create([
                'no_service' => $pengerjaan->penerimaan->no_service
            ]);
        }

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
        if($pengerjaan->status_pengerjaan > 0) {
            $pengembalian = Pengembalian::where('no_service', $pengerjaan->no_service)->first();
            $pengembalian->delete();
        }
        $pengerjaan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
