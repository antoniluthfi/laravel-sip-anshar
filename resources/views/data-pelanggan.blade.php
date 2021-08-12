@php
    error_reporting(0); 
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
    <title>Data Pelanggan</title>
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

    <h3 class="display-5">Laporan Data Pelanggan {{ ucwords($role) }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="display-6">No</th>
                <th class="display-6">Nama</th>
                <th class="display-6">Email</th>
                <th class="display-6">Nomor HP</th>
                <th class="display-6">Alamat</th>
                <th class="display-6">Cabang</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td class="display-6">{{ $no }}</td>
                    <td class="display-6">{{ ucwords($item->name) }}</td>
                    <td class="display-6">{{ $item->email }}</td>
                    <td class="display-6">{{ $item->nomorhp }}</td>
                    <td class="display-6">{{ $item->alamat }}</td>
                    <td class="display-6">{{ $item->cabang->nama_cabang }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>