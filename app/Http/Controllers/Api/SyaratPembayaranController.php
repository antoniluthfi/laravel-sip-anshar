<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyaratPembayaran;

class SyaratPembayaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK', 
            'errors' => null,
            'result' => SyaratPembayaran::all()
        ], 200);
    }

    public function getDataById($id)
    {
        $syaratPembayaran = SyaratPembayaran::find($id);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $syaratPembayaran
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $syaratPembayaran = SyaratPembayaran::create($input);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil ditambahkan',
            'result' => $syaratPembayaran
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $syaratPembayaran = SyaratPembayaran::find($id);
        $syaratPembayaran->fill($request->all())->save();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil diupdate',
            'result' => $syaratPembayaran
        ], 200);
    }

    public function delete($id)
    {
        $syaratPembayaran = SyaratPembayaran::find($id);
        $syaratPembayaran->delete();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'message' => 'Data berhasil dihapus',
            'result' => null
        ], 200);
    }
}
