@php
error_reporting(0);

date_default_timezone_set('Asia/Jakarta');
$now = date("d M Y");    

$dari = strtotime($dari);
$dari = date("d M Y", $dari);

$sampai = strtotime($sampai);
$sampai = date("d M Y", $sampai);

$total_biaya = 0;
foreach($data as $val) {
    $total_biaya += (int) $val->arusKas->total_biaya;
}

@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laporan Pengembalian Barang</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://tsc-api.twincom.co.id/public/css/app.css">
    </head>

    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <div class="container">
                <div class="row">
                    <div class="float-left" style="width: 10%;">
                        <img src="https://drive.google.com/thumbnail?id=12ubasd0uZrQ3LFlQ3Hw1mG4Q8ORLZ3Ao" width="80" height="80" alt="" class="mr-2">
                    </div>
                    <div class="float-right" style="width: 90%;">        
                        <h1 class="display-4 mt-0 mb-0 p-0">CV. TWINCOM GROUP</h1>
                        <p class="lead mt-0 mb-0 p-0">Banjarbaru : Jl. Panglima Batur Timur RT. 02 RW. 01 Ruko No. 6, Telp. 085245114690, 08115138800, 05116749897</p>
                        <p class="lead mt-0 mb-0 p-0">Landasan Ulin : Kp. Baru RT. 3 RW. 02 Jl. Seroja No. 11 Landasan Ulin Banjarbaru, Telp. 082255558174, 087815836366, 08115166995</p>
                        <p class="lead mt-0 mb-0 p-0">Banjarmasin : Jl. Adyaksa No. 4 (Deretan UNISKA) Kayutangi Banjarmasin, Telp. 082255558175, 08781664873, 085100159003</p>
                    </div>
                </div>
            </div>            
        </nav>  
        
        <h1 class="display-5 ml-1 mt-4 mb-2 p-0">LAPORAN PENGEMBALIAN BARANG</h1>
        <div class="container mb-4">
            <div class="row">
                <div class="float-left" style="width: 30%;">  
                    <p class="lead-2 ml-1 mt-0 mb-0 p-0">Tanggal</p>
                    <p class="lead-2 ml-1 mt-0 mb-0 p-0">Total Biaya Service</p>
                </div>
                <div class="float-right" style="width: 69%;">
                    <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $dari === $sampai ? $dari : $dari . ' - ' . $sampai }}</p>
                    <p class="lead-2 text-success ml-1 mt-0 mb-0 p-0">: Rp. {{ number_format($total_biaya) }}</p>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="table-dark">
                    <th scope="col"><strong>No</strong></th>
                    <th scope="col"><strong>No Nota</strong></th>
                    <th scope="col"><strong>Pelanggan</strong></th>
                    <th scope="col"><strong>Barang/Jasa</strong></th>
                    <th scope="col"><strong>Tgl Terima</strong></th>
                    <th scope="col"><strong>Tgl Selesai</strong></th>
                    <th scope="col"><strong>Tgl Kembali</strong></th>
                    <th scope="col"><strong>Diserahkan</strong></th>
                    <th scope="col"><strong>Nominal</strong></th>
                    <th scope="col"><strong>Status</strong></th>

                    @if ($dari !== $sampai)
                        <th scope="col"><strong>Tanggal Dibuat</strong></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $item)
                    @php
                        $no_service = $item->no_service;

                        if($item->status_pengembalian == 1) {
                            $status = 'Dikembalikan';
                        } elseif($item->status_pengembalian == 0) {
                            $status = 'Belum dikembalikan';
                        }   
                        
                        $tgl_terima = strtotime($item->penerimaan->created_at);
                        $tgl_terima = date("d M Y", $tgl_terima);

                        $tgl_selesai = strtotime($item->penerimaan->pengerjaan->waktu_selesai);
                        $tgl_selesai = date("d M Y", $tgl_selesai);

                        $tgl_kembali = strtotime($item->created_at);
                        $tgl_kembali = date("d M Y", $tgl_kembali);
                    @endphp
                    <tr class="' . $table_color . '">
                        <th scope="row"><p class="lead-2">{{ $i + 1 }}</p></th>
                        <td><p class="lead-2">{{ $no_service }}</p></td>
                        <td><p class="lead-2">{{ ucwords($item->penerimaan->customer->name) . ' - ' . $item->penerimaan->customer->nomorhp }}</p></td>
                        <td><p class="lead-2">{{ $item->penerimaan->barangJasa->nama . ' ' . $item->penerimaan->barang->nama }}</p></td>
                        <td><p class="lead-2">{{ $tgl_terima }}</p></td>
                        <td><p class="lead-2">{{ $tgl_selesai }}</p></td>
                        <td><p class="lead-2">{{ $tgl_kembali }}</p></td>
                        <td><p class="lead-2">{{ ucwords($nama_admin) }}</p></td>
                        <td><p class="lead-2">{{ number_format($item->arusKas->total_biaya) }}</p></td>
                        <td><p class="lead-2">{{ $status }}</p></td>

                        @if ($dari !== $sampai)
                            <td class="lead-2">{{ date_format($item->created_at, "d M Y") }}</td>    
                        @endif
                    </tr> 
                @empty
                    <tr>
                        <td colspan="{{ $dari !== $sampai ? '8' : '7' }}" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="float-right w-40">
            <p class="lead-2 text-center">{{ ucwords($data[0]->penerimaan->cabang->nama_cabang) . ', ' . $now }}</p>
            <p class="lead-2 mt-6 text-center">{{ ucwords($nama_admin) }}</p>    
        </div>

    </body>
</html>';