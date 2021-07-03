<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\DetailStokBarang;

class StokBarangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => StokBarang::with('kategori', 'paketBarang')->get()
        ], 200);
    }

    public function getDataById($id)
    {
        $stok = StokBarang::with('kategori', 'paketBarang', 'detailStokBarang')->where('id', $id)->first();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function getDataAvailable($id_cabang)
    {
        $id_cabang = $id_cabang ? $id_cabang : Auth::user()->id_cabang;
        $stok = StokBarang::all();
        $arr = [];
        foreach ($stok as $key => $val) {
            $arr[] = [
                'id' => $val->id,
                'nama_barang' => $val->nama_barang,
                'harga_user' => $val->harga_user,
                'harga_reseller' => $val->harga_reseller,
                'detail' => DetailStokBarang::with('cabang')->select('stok_tersedia', 'stok_dapat_dijual', 'id_cabang')
                            ->where('id_barang', $val->id)
                            ->where('id_cabang', $id_cabang)
                            ->where('stok_tersedia', '!=', 0)
                            ->get()
            ];

            if(count($arr[$key]['detail']) == 0) {
                unset($arr[$key]);
            }
        }
        
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $arr
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

        $input = [];
        $details = (array) $request->detail;
        foreach($details as $detail) {
            $input = [
                'id_barang' => $stok->id,
                'id_cabang' => $detail['id_cabang'],
                'stok_tersedia' => $detail['stok_tersedia'],
                'stok_dapat_dijual' => $detail['stok_dapat_dijual']
            ];

            DetailStokBarang::create($input);
        }

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

        $detailStokBarang = DetailStokBarang::where('id_barang', $id)->get();
        foreach ($detailStokBarang as $detail) {
            $detail->delete();
        }

        $input = [];
        $details = (array) $request->detail;
        foreach($details as $detail) {
            $input = [
                'id_barang' => $id,
                'id_cabang' => $detail['id_cabang'],
                'stok_tersedia' => $detail['stok_tersedia'],
                'stok_dapat_dijual' => $detail['stok_dapat_dijual']
            ];

            DetailStokBarang::create($input);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $stok
        ], 200);
    }

    public function delete($id)
    {
        $stok = StokBarang::find($id);
        $stok->delete();

        $detailStokBarang = DetailStokBarang::where('id_barang', $id)->get();
        foreach ($detailStokBarang as $barang) {
            $barang->delete();
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
            'result' => null
        ], 200);
    }
}
