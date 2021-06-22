<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Pengembalian::all()
        ]);
    }

    public function getDataByNoPengembalian($no_pengembalian)
    {
        $pengembalian = Pengembalian::where('no_pengembalian', $no_pengembalian)->first();
    
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
        $input = $request->all();
        $pengembalian = Pengembalian::where('no_pengembalian', $no_pengembalian)->first();
        $pengembalian->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $pengembalian
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
