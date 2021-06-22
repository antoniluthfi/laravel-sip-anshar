<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FakturPenjualan;

class FakturPenjualanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')->get()
        ], 200);
    }

    public function getDataById($no_bukti)
    {
        $fakturPenjualan = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')->where('no_bukti', $no_bukti)->first();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function getDataByMarketingId($marketing_id)
    {
        $fakturPenjualan = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')->where('id_marketing', $marketing_id)->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function getDataPemasukanByMarketingId($kategori, $marketing_id)
    {
        if($marketing_id === 'all') {
            if($kategori === 'harian') {
                $fakturPenjualan = DB::select("SELECT SUM(nominal) AS pemasukan, DATE_FORMAT(Created_At,'%Y-%m-%d') AS day FROM `faktur_penjualan` GROUP BY day, id_marketing HAVING day = curdate()");
            } elseif($kategori === 'bulanan') {
                $fakturPenjualan = DB::select("SELECT SUM(nominal) AS pemasukan, DATE_FORMAT(Created_At,'%Y-%m') AS month FROM `faktur_penjualan` GROUP BY month, id_marketing ORDER BY month DESC LIMIT 1");
            }
        } else {
            if($kategori === 'harian') {
                $fakturPenjualan = DB::select("SELECT SUM(nominal) AS pemasukan, DATE_FORMAT(Created_At,'%Y-%m-%d') AS day FROM `faktur_penjualan` GROUP BY day, id_marketing HAVING day = curdate() AND id_marketing = '$marketing_id'");
            } elseif($kategori === 'bulanan') {
                $fakturPenjualan = DB::select("SELECT SUM(nominal) AS pemasukan, DATE_FORMAT(Created_At,'%Y-%m') AS month FROM `faktur_penjualan` GROUP BY month, id_marketing HAVING id_marketing = '$marketing_id' ORDER BY month DESC LIMIT 1");
            }
        }

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function getDataPemasukanByKategori($marketing_id)
    {
        if($marketing_id === 'all') {
            $fakturPenjualan = DB::select("SELECT 
                    faktur_penjualan.id_marketing, 
                    pesanan_penjualan.id_barang, 
                    stok_barang.nama_barang, 
                    SUM(faktur_penjualan.nominal) AS pemasukan, 
                    SUM(pesanan_penjualan.kuantitas) AS total_penjualan, 
                    stok_barang.kategori, 
                    DATE_FORMAT(faktur_penjualan.Created_At,'%Y-%m') AS month FROM `faktur_penjualan` 
                LEFT JOIN pesanan_penjualan ON faktur_penjualan.id_pesanan_penjualan = pesanan_penjualan.id 
                LEFT JOIN stok_barang ON pesanan_penjualan.id_barang = stok_barang.id 
                GROUP BY month, faktur_penjualan.id_marketing, stok_barang.kategori 
                ORDER BY month DESC"
            );
        } else {
            $fakturPenjualan = DB::select("SELECT 
                    faktur_penjualan.id_marketing, 
                    pesanan_penjualan.id_barang, 
                    stok_barang.nama_barang, 
                    SUM(faktur_penjualan.nominal) AS pemasukan, 
                    COUNT(stok_barang.kategori) AS total_penjualan, 
                    stok_barang.kategori, 
                    DATE_FORMAT(faktur_penjualan.Created_At,'%Y-%m') AS month FROM `faktur_penjualan` 
                LEFT JOIN pesanan_penjualan ON faktur_penjualan.id_pesanan_penjualan = pesanan_penjualan.id 
                LEFT JOIN stok_barang ON pesanan_penjualan.id_barang = stok_barang.id 
                GROUP BY month, faktur_penjualan.id_marketing, stok_barang.kategori 
                HAVING faktur_penjualan.id_marketing = '$marketing_id' 
                ORDER BY month DESC LIMIT 1"
            );
        }

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $input = $request->all();
        if(!array_key_exists('no_faktur', $input)) {
            $data = DB::select("SELECT no_bukti FROM faktur_penjualan ORDER BY no_bukti DESC LIMIT 1");
            if(count($data) === 0) {
                $id = 1;
            } else {
                $id = $data[0]->no_bukti + 1;
            }

            $input['no_faktur'] = date('dmY') . ".$id";
        }

        $fakturPenjualan = FakturPenjualan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function update(Request $request, $no_bukti)
    {
        $fakturPenjualan = FakturPenjualan::where('no_bukti', $no_bukti)->first();

        $input = $request->all();
        $fakturPenjualan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function delete($no_bukti)
    {
        $fakturPenjualan = FakturPenjualan::where('no_bukti', $no_bukti)->first();
        $fakturPenjualan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
