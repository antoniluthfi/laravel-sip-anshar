<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FakturPenjualan;
use App\Models\Cabang;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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

    public function getDataById($no_faktur)
    {
        $fakturPenjualan = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')->where('no_faktur', $no_faktur)->first();

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
                $fakturPenjualan = FakturPenjualan::where('id_marketing', $marketing_id)
                                                ->whereMonth('created_at', date('m'))
                                                ->sum('nominal');
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
                    stok_barang.nama_barang, 
                    SUM(faktur_penjualan.nominal) AS pemasukan, 
                    SUM(pesanan_penjualan.kuantitas) AS total_penjualan, 
                    stok_barang.kategori, 
                    DATE_FORMAT(faktur_penjualan.Created_At,'%Y-%m') AS month FROM `faktur_penjualan` 
                LEFT JOIN pesanan_penjualan ON faktur_penjualan.id_pesanan_penjualan = pesanan_penjualan.id 
                GROUP BY month, faktur_penjualan.id_marketing, stok_barang.kategori 
                ORDER BY month DESC"
            );
        } else {
            $fakturPenjualan = FakturPenjualan::with('detailPesananPenjualan')
                            ->select('nominal', 'kode_pesanan')
                            ->where('id_marketing', $marketing_id)
                            ->whereMonth('created_at', date('m'))
                            ->get();
        }

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function getListNoFaktur()
    {
        $fakturPenjualan = FakturPenjualan::select('no_faktur AS kode')->get();
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function create(Request $request)
    {
        $cabang = Cabang::findOrFail($request->id_cabang);

        $no_faktur = IdGenerator::generate([
            'table' => 'faktur_penjualan',
            'length' => 15,
            'prefix' => 'TS' . $cabang->singkatan . '.',
            'field' => 'no_faktur'
        ]);

        $input = $request->all();
        $input['no_faktur'] = $no_faktur;
        $fakturPenjualan = FakturPenjualan::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function update(Request $request, $no_faktur)
    {
        $fakturPenjualan = FakturPenjualan::where('no_faktur', $no_faktur)->first();

        $input = $request->all();
        $fakturPenjualan->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $fakturPenjualan
        ], 200);
    }

    public function delete($no_faktur)
    {
        $fakturPenjualan = FakturPenjualan::where('no_faktur', $no_faktur)->first();
        $fakturPenjualan->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
