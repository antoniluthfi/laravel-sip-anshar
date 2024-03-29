@php
error_reporting(0); 

$dari = strtotime($dari);
$dari = date("d M Y", $dari);

$sampai = strtotime($sampai);
$sampai = date("d M Y", $sampai);

$total_harga = 0;
foreach($data as $val) {
    $total_harga += (int) $val->total_harga;
}
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
    <title>Laporan Pesanan Penjualan</title>
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
    </nav><br> 

    <h3 class="display-5">Laporan Pesanan Penjualan</h3>
    <div class="container mb-4">
        <div class="row">
            <div class="float-left" style="width: 30%;">  
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Tanggal</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Marketing</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Total Harga</p>
            </div>
            <div class="float-right" style="width: 69%;">
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $dari === $sampai ? $dari : $dari . ' - ' . $sampai }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ ucwords($nama_admin) }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: Rp. {{ number_format($total_harga) }}</p>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="display-6"><strong>No</strong></th>
                <th class="display-6"><strong>Kode Pesanan</strong></th>
                <th class="display-6"><strong>Pelanggan</strong></th>
                <th class="display-6"><strong>Cabang</strong></th>
                <th class="display-6"><strong>Pembayaran</strong></th>
                <th class="display-6"><strong>Diskon</strong></th>
                <th class="display-6"><strong>Total Harga</strong></th>

                @if ($dari !== $sampai)
                    <th class="display-6"><strong>Tanggal Dibuat</strong></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $item)
                <tr>
                    <td class="display-6">{{ $key + 1 }}</td>
                    <td class="display-6">{{ $item->kode_pesanan }}</td>
                    <td class="display-6">{{ ucwords($item->pelanggan->name) }}</td>
                    <td class="display-6">{{ $item->cabang->nama_cabang }}</td>
                    <td class="display-6">{{ $item->syaratPembayaran->nama }}</td>
                    <td class="display-6 text-center">{{ $item->diskon ? $item->diskon : '-' }}</td>
                    <td class="display-6">{{ number_format($item->total_harga) }}</td>
                    
                    @if ($dari !== $sampai)
                        <td class="display-6">{{ date_format($item->created_at, "d M Y") }}</td>    
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
        <p class="lead-2 text-center">Pengguna Sistem</p>
        <hr class=" mt-6" style="width: 80%">
        <p class="lead-2 mt-0 text-center">{{ ucwords($nama_admin) }}</p>
    </div>
</body>
</html>