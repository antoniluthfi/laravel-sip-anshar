<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Cabang;
use App\Models\Pengerjaan;
use App\Models\TeknisiPJ;

class PenerimaanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Penerimaan::with('pengerjaan', 'admin', 'customer', 'cabang', 'barangJasa', 'barang')->get()
        ]);
    }

    public function getDataByIdAdmin($id)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Penerimaan::with('pengerjaan', 'admin', 'customer', 'cabang', 'barangJasa', 'barang')->where('id_admin', $id)->get()
        ]);
    }

    public function getDataByNoService($no_service)
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Penerimaan::with('pengerjaan', 'admin', 'customer', 'cabang', 'barangJasa', 'barang', 'teknisiPj')->where('no_service', $no_service)->first()
        ]);
    }

    public function create(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $cabang = Cabang::findOrFail($request->id_cabang);
        $singkatan = $cabang->singkatan;

        $input = $request->all();
        
        $last_data = Penerimaan::orderBy('created_at', 'desc')->first();
        if($last_data) {
            // generate nomor service
            $no_service = preg_replace( '/[^0-9]/', '', $last_data->no_service);
            $no_service = (int) $no_service + 1;
            $input['no_service'] = "S." . $singkatan . "." . $no_service;

            // generate nomor pengerjaan
            $no_pengerjaan = (int) $last_data->no_pengerjaan + 1;
            $input['no_pengerjaan'] = $no_pengerjaan;
        } else {
            $input['no_service'] = "S." . $singkatan . "." . 1;
            $input['no_pengerjaan'] = 1;
        }

        unset($input['teknisi']);
        Penerimaan::create($input);

        Pengerjaan::create([
            'no_pengerjaan' => $input['no_pengerjaan'],
            'waktu_mulai' => date('Y-m-d H:i:s')
        ]);

        if(count($request->teknisi) > 1) {
            foreach($request->teknisi as $teknisi) {
                TeknisiPJ::create([
                    'no_pengerjaan' => $input['no_pengerjaan'],
                    'id_teknisi' => $teknisi['id']
                ]);
            }
        } else {
            TeknisiPJ::create([
                'no_pengerjaan' => $input['no_pengerjaan'],
                'id_teknisi' => $request->teknisi[0]['id']
            ]);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $request->teknisi[0]['id']
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
            'result' => $penerimaan
        ], 200);
    }

    public function delete($no_service)
    {
        $penerimaan = Penerimaan::where('no_service', $no_service)->first();
        $pengerjaan = Pengerjaan::where('no_pengerjaan', $penerimaan->no_pengerjaan)->first();
        $teknisi_pj = TeknisiPJ::where('no_pengerjaan', $penerimaan->no_pengerjaan)->get();

        foreach ($teknisi_pj as $teknisi) {
            $teknisi->delete();
        }

        $pengerjaan->delete();
        $penerimaan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);
    }
}
