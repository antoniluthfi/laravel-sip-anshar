<?php

namespace App\Http\Controllers;

use App\Models\ArusKas;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\StokBarang;
use App\Models\User;
use App\Models\PesananPenjualan;
use App\Models\PengirimanPesanan;
use App\Models\FakturPenjualan;
use App\Models\Penerimaan;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;
use PDF;

class CetakLaporanController extends Controller
{
    public function cetakLaporan($tipeLaporan, $str = null, $str2 = null) // str = role, str2 = nama user
    {
        // dd($tipeLaporan);
        if($tipeLaporan === 'stok-barang') {
            $data = StokBarang::with('detailStokBarang')->get();
            $array = [
                'nama_admin' => $str,
                'data' => $data,
                'total' => $data->count()
            ];
        } elseif($tipeLaporan === 'data-pelanggan') {
            if($str === 'reseller') {
                $data = User::where('hak_akses', 'reseller')->get();
            } elseif($str === 'user') {
                $data = User::where('hak_akses', 'user')->get();
            } else {
                $data = User::where('hak_akses', 'user')->orWhere('hak_akses', 'reseller')->get();
            }
            
            $array = [
                'nama_admin' => $str2,
                'data' => $data,
                'role' => $str,
                'total' => $data->count()
            ];
        } elseif($tipeLaporan === 'data-pelanggan2') {
            $data = User::where('hak_akses', 'reseller')
                        ->orWhere('hak_akses', 'user')
                        ->get();
            // dd($data);
            $array = [
                'nama_admin' => $str,
                'data' => $data,
                'total' => $data->count()
            ];
        } elseif($tipeLaporan === 'pesanan-penjualan') {
            $data = PesananPenjualan::with('detailPesananPenjualan', 'pelanggan', 'penjual', 'pengirimanPesanan', 'fakturPenjualan', 'syaratPembayaran', 'cabang')->where('kode_pesanan', $str)->first();

            $array = ['data' => $data];
        } elseif($tipeLaporan === 'pengiriman-pesanan') {
            $data = PengirimanPesanan::with('pesananPenjualan', 'fakturPenjualan', 'user', 'ekspedisi', 'cabang')->where('kode_pengiriman', $str)->first();

            // dd($data);
            $array = ['data' => $data];
        } elseif($tipeLaporan === 'faktur-penjualan') {
            $data = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')->where('no_faktur', $str)->first();
            $array = ['data' => $data];
        }

        $pdf = PDF::loadView($tipeLaporan, $array, [], [
            'mode'                 => '',
            'format'               => 'A4',
            'default_font_size'    => '12',
            'margin_left'          => 2,
            'margin_right'         => 2,
            'margin_top'           => 2,
            'margin_bottom'        => 2,
            'margin_header'        => 1,
            'margin_footer'        => 1,
            'orientation'          => 'P',
            'title'                => $tipeLaporan,
            'author'               => 'Antoni Luthfi',
            'watermark'            => '',
            'show_watermark'       => false,
            'watermark_font'       => 'sans-serif',
            'display_mode'         => 'real',
            'watermark_text_alpha' => 0.1,
            'custom_font_dir'      => '',
            'custom_font_data' 	   => [],
            'auto_language_detection'  => false,
            'temp_dir'               => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            'pdfa' 			=> false,
            'pdfaauto' 		=> false,
        ]);
        return $pdf->stream("$tipeLaporan.pdf");
    }

    public function pdfGeneratorNota($nama_pdf, $title, $file, $data)
    {
        $pdf = PDF::loadView($file, ['data' => $data], [], [
            'mode'                 => '',
            'format'               => [140, 235],
            'default_font_size'    => '12',
            'default_font'         => 'sun-exta',
            'margin_left'          => 2,
            'margin_right'         => 2,
            'margin_top'           => 2,
            'margin_bottom'        => 2,
            'margin_header'        => 1,
            'margin_footer'        => 1,
            'orientation'          => 'L',
            'title'                => $title,
            'author'               => 'Antoni Luthfi',
            'watermark'            => '',
            'show_watermark'       => false,
            'watermark_font'       => 'sans-serif',
            'display_mode'         => 'real',
            'watermark_text_alpha' => 0.1,
            'custom_font_dir'      => '',
            'custom_font_data' 	   => [],
            'auto_language_detection'  => false,
            'temp_dir'               => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            'pdfa' 			=> false,
            'pdfaauto' 		=> false,
            'custom_font_data' => [
                'sun-exta' => [
                    'R' => 'Sun-ExtA.ttf',
                    'sip-ext' => 'sun-extb',
                ],
                'sun-extb' => [
                    'R' => 'Sun-ExtB.ttf',
                ],
            ]
        ]);
        return $pdf->stream("$nama_pdf.pdf");
    }

    public function pdfReportGenerator($nama_pdf, $title, $file, $data, $tambahan)
    {
        $pdf = PDF::loadView($file, ['data' => $data, 'dari' => $tambahan['dari'], 'sampai' => $tambahan['sampai'], 'nama_admin' => $tambahan['nama_admin'], 'dataCount' => $tambahan['dataCount']], [], [
            'mode'                 => '',
            'format'               => 'A4',
            'default_font_size'    => '12',
            'default_font'         => 'sans-serif',
            'margin_left'          => 2,
            'margin_right'         => 2,
            'margin_top'           => 2,
            'margin_bottom'        => 2,
            'margin_header'        => 1,
            'margin_footer'        => 1,
            'orientation'          => 'P',
            'title'                => $title,
            'author'               => 'Antoni Luthfi',
            'watermark'            => '',
            'show_watermark'       => false,
            'watermark_font'       => 'sans-serif',
            'display_mode'         => 'real',
            'watermark_text_alpha' => 0.1,
            'custom_font_dir'      => '',
            'custom_font_data' 	   => [],
            'auto_language_detection'  => false,
            'temp_dir'               => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            'pdfa' 			=> false,
            'pdfaauto' 		=> false,
        ]);
        return $pdf->stream("$nama_pdf.pdf");
    }

    public function pdfSuratJalanGenerator($data)
    {
        $pdf = PDF::loadView('surat-jalan', ['data' => $data], [], [
            'mode'                 => '',
            'format'               => [140, 235],
            'default_font_size'    => '12',
            'default_font'         => 'sun-exta',
            'margin_left'          => 2,
            'margin_right'         => 2,
            'margin_top'           => 2,
            'margin_bottom'        => 2,
            'margin_header'        => 1,
            'margin_footer'        => 1,
            'orientation'          => 'L',
            'title'                => 'Surat Jalan',
            'author'               => 'Antoni Luthfi',
            'watermark'            => '',
            'show_watermark'       => false,
            'watermark_font'       => 'sans-serif',
            'display_mode'         => 'real',
            'watermark_text_alpha' => 0.1,
            'custom_font_dir'      => '',
            'custom_font_data' 	   => [],
            'auto_language_detection'  => false,
            'temp_dir'               => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            'pdfa' 			=> false,
            'pdfaauto' 		=> false,
            'custom_font_data' => [
                'sun-exta' => [
                    'R' => 'Sun-ExtA.ttf',
                    'sip-ext' => 'sun-extb',
                ],
                'sun-extb' => [
                    'R' => 'Sun-ExtB.ttf',
                ],
            ]
        ]);
        return $pdf->stream("surat_jalan.pdf");
    }

    public function tandaTerimaService($no_service)
    {
        $data = Penerimaan::with('admin', 'customer', 'barangJasa', 'cabang', 'teknisiPj')->where('no_service', $no_service)->first();
        // dd($data);
        $this->pdfGeneratorNota('tanda_terima_service', 'Tanda Terima Service', 'tanda-terima-service', $data);
    }

    public function notaService($no_pengembalian)
    {
        $data = Pengembalian::with('penerimaan', 'arusKas')
                            ->where('no_pengembalian', $no_pengembalian)
                            ->orWhere('no_service', $no_pengembalian)
                            ->first();
        // dd($data->penerimaan);
        $this->pdfGeneratorNota('nota-service', 'Nota Service', 'nota-service', $data);
    }

    public function laporanPenerimaan($dari, $sampai, $cabang, $admin) {
        $data_admin = User::findOrFail($admin);

        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        if($sampai === 'x') {
            $data = Penerimaan::with('admin', 'customer', 'cabang', 'barangJasa')
                            ->where('created_at', $dari)
                            ->where('id_cabang', $cabang)
                            ->where('id_admin', $admin)
                            ->get();
        } else {
            $data = Penerimaan::with('admin', 'customer', 'cabang', 'barangJasa')
                            ->whereBetween('created_at', [$dari, $sampai])
                            ->where('id_cabang', $cabang)
                            ->where('id_admin', $admin)
                            ->get();
        }

        $data2 = [
            'nama_admin' => $data_admin->name,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => $data->count()
        ];
        // dd($data);

        $this->pdfReportGenerator('laporan_penerimaan_barang.pdf', 'Laporan Penerimaan Barang', 'laporan-penerimaan', $data, $data2);
    }

    public function laporanPengembalian($dari, $sampai, $cabang, $admin) {
        $data_admin = User::findOrFail($admin);

        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        if($sampai === 'x') {
            $pengembalian = Pengembalian::with('penerimaan', 'arusKas')
                            ->where('created_at', $dari)
                            ->get();
        } else {
            $pengembalian = Pengembalian::with('penerimaan', 'arusKas')
                            ->whereBetween('created_at', [$dari, $sampai])
                            ->get();
        }

        $data = [];
        foreach($pengembalian as $key => $val) {
            if($val->penerimaan->id_cabang == $cabang) {
                $data[$key] = $val;
            }
        }

        $data2 = [
            'nama_admin' => $data_admin->name,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => count($data)
        ];
        // dd($data);

        $this->pdfReportGenerator('laporan_pengembalian_barang.pdf', 'Laporan Pengembalian Barang', 'laporan-pengembalian', $data, $data2);
    }

    public function laporanArusKas($dari, $sampai, $cabang, $admin)
    {
        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        $dataCount = DB::select(
            "SELECT COUNT(arus_kas.id_sandi_transaksi) AS count_sandi, 
                arus_kas.*,
                cabang.nama_cabang,
                sandi_transaksi.* FROM arus_kas 
            LEFT JOIN sandi_transaksi ON arus_kas.id_sandi_transaksi = sandi_transaksi.id 
            LEFT JOIN cabang ON arus_kas.id_cabang = cabang.id
            GROUP BY sandi_transaksi.jenis_transaksi, arus_kas.id_cabang, arus_kas.id_sandi_transaksi
            HAVING arus_kas.id_cabang = '$cabang'
            AND (arus_kas.created_at BETWEEN '$dari' AND '$sampai')
            ORDER BY sandi_transaksi.jenis_transaksi ASC"
        );
        // dd($dataCount[0]->nama_cabang);

        $data2 = [
            'nama_admin' => $admin,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => $dataCount
        ];

        $data = ArusKas::with('pengembalian')
                        ->whereBetween('created_at', [$dari, $sampai])
                        ->where('id_cabang', $cabang);

        $data = $data->get();
        // dd($data[0]);
        $this->pdfReportGenerator('laporan_arus_kas.pdf', 'Laporan Arus Kas', 'laporan-arus-kas', $data, $data2);
    }

    public function laporanFakturPenjualan($dari, $sampai, $marketing) {
        $data_marketing = User::findOrFail($marketing);

        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        if($sampai === 'x') {
            $data = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')
                            ->where('created_at', $dari)
                            ->where('id_marketing', $marketing)
                            ->get();
        } else {
            $data = FakturPenjualan::with('pesananPenjualan', 'marketing', 'user', 'bank')
                            ->whereBetween('created_at', [$dari, $sampai])
                            ->where('id_marketing', $marketing)
                            ->get();
        }

        $data2 = [
            'nama_admin' => $data_marketing->name,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => $data->count()
        ];
        // dd($data);

        $this->pdfReportGenerator('laporan_faktur_penjualan.pdf', 'Laporan Faktur Penjualan', 'laporan-faktur-penjualan', $data, $data2);
    }

    public function laporanPengirimanPesanan($dari, $sampai, $marketing) {
        $data_marketing = User::findOrFail($marketing);

        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        if($sampai === 'x') {
            $data = PengirimanPesanan::with('user', 'ekspedisi', 'cabang')
                            ->where('created_at', $dari)
                            ->where('id_marketing', $marketing)
                            ->get();
        } else {
            $data = PengirimanPesanan::with('user', 'ekspedisi', 'cabang')
                            ->whereBetween('created_at', [$dari, $sampai])
                            ->where('id_marketing', $marketing)
                            ->get();
        }

        $data2 = [
            'nama_admin' => $data_marketing->name,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => count($data)
        ];
        // dd($data);

        $this->pdfReportGenerator('laporan_pengiriman_pesanan.pdf', 'Laporan Pengiriman Pesanan', 'laporan-pengiriman-pesanan', $data, $data2);
    }

    public function laporanPesananPenjualan($dari, $sampai, $marketing) {
        $data_marketing = User::findOrFail($marketing);

        if($sampai === 'x') {
            $sampai = "$dari 23:59:59";
            $dari = "$dari 00:00:00";
        } else {
            $sampai = "$sampai 23:59:59";
        }

        if($sampai === 'x') {
            $data = PesananPenjualan::with('pelanggan', 'penjual', 'syaratPembayaran', 'cabang')
                            ->where('created_at', $dari)
                            ->where('id_penjual', $marketing)
                            ->get();
        } else {
            $data = PesananPenjualan::with('pelanggan', 'penjual', 'syaratPembayaran', 'cabang')
                            ->whereBetween('created_at', [$dari, $sampai])
                            ->where('id_penjual', $marketing)
                            ->get();
        }

        $data2 = [
            'nama_admin' => $data_marketing->name,
            'dari' => $dari,
            'sampai' => $sampai,
            'dataCount' => count($data)
        ];
        // dd($data);

        $this->pdfReportGenerator('laporan_pesanan_penjualan.pdf', 'Laporan Pesanan Penjualan', 'laporan-pesanan-penjualan', $data, $data2);
    }

    public function suratJalan($no_surat_jalan)
    {
        $data = PengirimanPesanan::with('list_pengiriman')->where('no_surat_jalan', $no_surat_jalan)->first();
        $this->pdfSuratJalanGenerator($data);
    }
}
