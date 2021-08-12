<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArusKas;
use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pengembalian::with('penerimaan')->get()
        ]);
    }

    public function getDataByNoPengembalian($no_pengembalian)
    {
        $pengembalian = Pengembalian::with('penerimaan')->where('no_pengembalian', $no_pengembalian)->first();
    
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengembalian
        ], 200);
    }

    public function getListNoService()
    {
        $pengembalian = Pengembalian::select('no_service AS kode')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $pengembalian
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $pengembalian = Pengembalian::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $pengembalian
        ], 200);
    }    

    public function update(Request $request, $no_pengembalian)
    {
        $arusKas = ArusKas::create([
            'id_sandi_transaksi' => $request->id_sandi_transaksi, 
            'id_admin' => $request->id_admin,
            'id_cabang' => $request->id_cabang,
            'nominal' => $request->nominal,
            'total_biaya' => $request->nominal,
            'sisa_biaya' => 0,
            'status_pembayaran' => 1,
            'masuk' => 1,
            'keterangan' => 'Pembayaran servis'
        ]);

        $pengembalian = Pengembalian::where('no_pengembalian', $no_pengembalian)->first();
        $pengembalian->update([
            'id_arus_kas' => $arusKas->id,
            'status_pengembalian' => $request->status_pengembalian
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pengembalian
        ], 200); 
    }

    public function reset($no_pengembalian)
    {
        $pengembalian = Pengembalian::where('no_pengembalian', $no_pengembalian)->first();
        $pengembalian->update([
            'status_pengembalian' => 0,
            'id_arus_kas' => 0
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil direset',
            'errors' => null,
        ], 200);
    }

    public function delete($no_pengembalian)
    {
        $pengembalian = Pengembalian::where('no_pengembalian', $no_pengembalian)->first();
        $pengembalian->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);
    }
}
