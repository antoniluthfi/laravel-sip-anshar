@php
error_reporting(0);
$now = date("d M Y");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
    <title>Stok Barang</title>
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

    <h3 class="display-5">Laporan Stok Barang</h3>
    <div class="container mb-4">
        <div class="row">
            <div class="float-left" style="width: 30%;">  
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Tanggal</p>
            </div>
            <div class="float-right" style="width: 69%;">
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $now }}</p>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="display-6"><strong>No</strong></th>
                <th class="display-6"><strong>Nama Barang</strong></th>
                <th class="display-6"><strong>Kategori</strong></th>
                <th class="display-6"><strong>Harga User</strong></th>
                <th class="display-6"><strong>Harga Reseller</strong></th>
                <th class="display-6"><strong>Stok Tersedia</strong></th>
                <th class="display-6"><strong>Stok Dapat Dijual</strong></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $item)
                @php
                    $stok_tersedia = 0;
                    $stok_dapat_dijual = 0;
                @endphp

                <tr>
                    <td class="display-6">{{ $key + 1 }}</td>
                    <td class="display-6">{{ $item->nama_barang }}</td>
                    <td class="display-6">{{ $item->kategori->nama_kategori }}</td>
                    <td class="display-6 text-right">Rp. {{ number_format($item->harga_user) }}</td>
                    <td class="display-6 text-right">Rp. {{ number_format($item->harga_reseller) }}</td>
                    <td class="display-6">
                        @foreach ($item->detailStokBarang as $detail)
                            <p>{{ $detail->cabang->singkatan }} : {{ $detail->stok_tersedia }}</p>
                            
                            @php
                                $stok_tersedia += (int) $detail->stok_tersedia;
                            @endphp
                        @endforeach

                        <p><strong>Total : {{ $stok_tersedia }}</strong></p>
                    </td>
                    <td class="display-6">
                        @foreach ($item->detailStokBarang as $detail)
                            <p>{{ $detail->cabang->singkatan }} : {{ $detail->stok_dapat_dijual }}</p>

                            @php
                                $stok_dapat_dijual += (int) $detail->stok_dapat_dijual;
                            @endphp
                        @endforeach

                        <p><strong>Total : {{ $stok_dapat_dijual }}</strong></p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="display-6 text-center">Tidak ada data</td>
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