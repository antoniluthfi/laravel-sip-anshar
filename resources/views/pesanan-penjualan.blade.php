<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
    <title>Pesanan Penjualan</title>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="container">
            <div class="row">
                <div class="float-left" style="width: 10%;">
                    <img src="https://drive.google.com/thumbnail?id=12ubasd0uZrQ3LFlQ3Hw1mG4Q8ORLZ3Ao" width="80"
                        height="80" alt="" class="mr-2">
                </div>
                <div class="float-right" style="width: 90%;">
                    <h1 class="display-4 mt-0 mb-0 p-0">CV. TWINCOM GROUP</h1>
                    <p class="lead mt-0 mb-0 p-0">Banjarbaru : Jl. Panglima Batur Timur RT. 02 RW. 01 Ruko No. 6, Telp.
                        085245114690, 08115138800, 05116749897</p>
                    <p class="lead mt-0 mb-0 p-0">Landasan Ulin : Kp. Baru RT. 3 RW. 02 Jl. Seroja No. 11 Landasan Ulin
                        Banjarbaru, Telp. 082255558174, 087815836366, 08115166995</p>
                    <p class="lead mt-0 mb-0 p-0">Banjarmasin : Jl. Adyaksa No. 4 (Deretan UNISKA) Kayutangi
                        Banjarmasin, Telp. 082255558175, 08781664873, 085100159003</p>
                </div>
            </div>
        </div>
    </nav><br>

    <h3 class="display-5">Laporan Pesanan Penjualan</h3>
    <div class="container mb-4">
        <div class="row">
            <div class="float-left" style="width: 30%;">
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Pelanggan</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Alamat</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Nomor HP</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Kode Pelanggan</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Nomor Pesanan</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">Keterangan</p>
            </div>
            <div class="float-right" style="width: 69%;">
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ ucwords($data->pelanggan->name) }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $data->pelanggan->alamat }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $data->pelanggan->nomorhp }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: C.{{ $data->pelanggan->id }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $data->kode_pesanan }}</p>
                <p class="lead-2 ml-1 mt-0 mb-0 p-0">: {{ $data->keterangan ? $data->keterangan : '-' }}</p>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="display-6">No Barang</th>
                <th class="display-6">Nama Barang</th>
                <th class="display-6">Kuantitas</th>
                <th class="display-6">Harga Satuan</th>
                <th class="display-6">Diskon</th>
                <th class="display-6">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->detailPesananPenjualan as $item)
                <tr>
                    <td class="display-6 text-center">{{ $item->barang->id }}</td>
                    <td class="display-6 text-center">{{ $item->barang->nama_barang }}</td>
                    <td class="display-6 text-center">{{ $item->kuantitas }}</td>

                    @if ($data->pelanggan->hak_akses === 'user')
                        <td class="display-6 text-right">Rp. {{ number_format($item->barang->harga_user) }}</td>
                    @else
                        <td class="display-6 text-right">Rp. {{ number_format($item->barang->harga_reseller) }}</td>
                    @endif

                    <td class="display-6 text-center">{{ $item->diskon ? $item->diskon : '-' }}</td>
                    <td class="display-6 text-right">Rp. {{ number_format($item->total_harga) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="float-right w-40">
        <p class="lead-2 text-center">Disiapkan Oleh</p>
        <hr class=" mt-6" style="width: 80%">
        <p class="lead-2 mt-0 text-center">{{ ucwords($data->penjual->name) }}</p>
    </div>

    <div class="float-right w-40">
        <p class="lead-2 text-center">Pelanggan</p>
        <hr class=" mt-6" style="width: 80%">
        <p class="lead-2 mt-0 text-center">{{ ucwords($data->pelanggan->name) }}</p>
    </div>
</body>

</html>
