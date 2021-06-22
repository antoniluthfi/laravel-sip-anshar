<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokBarang;

class StokBarangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => StokBarang::with('paketBarang')->get()
        ], 200);
    }

    public function getDataById($id)
    {
        $stok = StokBarang::with('paketBarang')->where('id', $id)->first();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function getDataAvailable()
    {
        $stok = StokBarang::with('paketBarang')
                        ->where('bjb', '!=', 0)
                        ->orWhere('bjm', '!=', 0)
                        ->orWhere('lnu', '!=', 0)
                        ->orWhere('tdc', '!=', 0)
                        ->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function getDataNonPaket(Request $request)
    {
        $stok = StokBarang::with('paketBarang')->where('paket', 0)->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $stok = StokBarang::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $stok = StokBarang::find($id);
        $input = $request->all();
        $stok->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function updateFromPesananPenjualan(Request $request, $id)
    {
        $stok = StokBarang::find($id);
        $input = [];

        if(stripos(strtolower($request->cabang), 'banjarbaru') != -1 || stripos(strtolower($request->cabang), 'bjb') != -1) {
            $cabang = 'bjb';
        } elseif(stripos(strtolower($request->cabang), 'landasan ulin') != -1 || stripos(strtolower($request->cabang), 'lnu') != -1) {
            $cabang = 'lnu';
        } elseif(stripos(strtolower($request->cabang), 'banjarmasin') != -1 || stripos(strtolower($request->cabang), 'bjm') != -1) {
            $cabang = 'bjm';
        } elseif(stripos(strtolower($request->cabang), 'twincom distribution center') != -1 || stripos(strtolower($request->cabang), 'tdc') == 0) {
            $cabang = 'tdc';
        } else {
            $cabang = strtolower($request->cabang);
        }

        $input[$cabang] = $stok[$cabang] - $request->jumlah;
        if($input[$cabang] >= 0) {
            if($cabang !== $request->cabang) {
                $stok->fill($input)->save();
    
                return response()->json([
                    'status' => 'OK',
                    'errors' => null,
                    'message' => 'Data berhasil diupdate',
                    'result' => $stok
                ], 200);
            }

            return response()->json([
                'status' => 'Failed',
                'errors' => null,
                'message' => 'Data gagal diupdate',
                'result' => null
            ], 500);
        }

        return response()->json([
            'status' => 'Failed',
            'errors' => null,
            'message' => 'Data gagal diupdate',
            'result' => null
        ], 500);
    }

    public function delete($id)
    {
        $stok = StokBarang::find($id);
        $stok->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
