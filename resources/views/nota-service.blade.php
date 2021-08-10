@php

$no_service = $data->no_service;

if($data->penerimaan->data_penting === '1') {
    $data_penting = 'Ada';
} else {
    $data_penting = 'Tidak Ada';
}

$tanggal = explode(' ', $data->created_at);
$tanggal = explode('-', $tanggal[0]);
$tanggal = $tanggal[2] . '/' . $tanggal[1] . '/' . $tanggal[0];

if(strpos($data->penerimaan->teknisi, ',')) {
    $teknisi = explode(",", $data->penerimaan->teknisi);
    $teknisi = $teknisi[0];
} else {
    $teknisi = $data->penerimaan->teknisi;
}

date_default_timezone_set('Asia/Jakarta');
$now = date("d m Y");

if(strpos(strtolower($data->penerimaan->cabang->nama_cabang), 'twincom') !== false) {
    $keyword = 'Twincom ';
    $cabang = 'Twincom Service Center ';
} else if(strpos(strtolower($data->penerimaan->cabang->nama_cabang), 'pandacom') !== false) {
    $keyword = 'Pandacom ';
    $cabang = 'Pandacom Service Center ';
}

$cabang .= explode($keyword, $data->penerimaan->cabang->nama_cabang)[1];

@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nota Service</title>
        <link rel="stylesheet" href="https://tsc-api.twincom.co.id/public/css/app.css">
    </head>
    <body style="font-family: serif;">
        <div class="float-left" style="width: 10%;">
            <img src="https://drive.google.com/thumbnail?id=12ubasd0uZrQ3LFlQ3Hw1mG4Q8ORLZ3Ao" width="80" height="80" alt="" class="mr-2">
        </div>
        <div class="float-left ml-1" style="width: 62%;">        
            <h1 class="display-5 mt-0 mb-0 p-0" style="font-weight: bold; letter-spacing: 1.5px;">{{ strtoupper($cabang) }}</h1>
            <h1 class="display-6 mt-0 mb-0 p-0" style="font-weight: bold; letter-spacing: 1.5px;">KOMPUTER - LAPTOP - PRINTER - REFILL TONER - CCTV</h1>

            <p class="lead mt-0 mb-0 p-0">Banjarbaru : Jl. Panglima Batur Timur RT. 02 RW. 01 Ruko No. 6, Telp. 085245114690, 08115138800, 05116749897</p>
            <p class="lead mt-0 mb-0 p-0">Landasan Ulin : Kp. Baru RT. 3 RW. 02 Jl. Seroja No. 11 Landasan Ulin Banjarbaru, Telp. 082255558174, 087815836366, 08115166995</p>
            <p class="lead mt-0 mb-0 p-0">Banjarmasin : Jl. Adyaksa No. 4 (Deretan UNISKA) Kayutangi Banjarmasin, Telp. 082255558175, 08781664873, 085100159003</p>
        </div>
        <div class="float-right border" style="width: 26%">
            <div class="float-left" style="width: 84%">
                <h1 class="display-6 ml-2 mt-1 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">NOTA SERVICE</h1>

                <div class="float-left" style="width: 100%;">
                    <p class="lead ml-2 mt-0 mb-0">www.twincom.co.id</p>
                    <p class="lead ml-2 mt-0 mb-1">twincom_bjb@yahoo.com</p>
                </div>
            </div>
            <div class="float-right border" style="width: 15%;">
                <h1 class="display-6 text-center" style="font-weight: bold;">U</h1>
            </div>

            <div class="clearfix">
                <div class="float-left" style="width: 50%">
                    <p class="lead ml-2 mt-1 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Nomor Service</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Kode Pelanggan</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Nama Pelanggan</p>
                    <p class="lead ml-2 mt-0 mb-1" style="font-weight: bold; letter-spacing: 1.5px;">Telp/Hp</p>
                </div>   
                
                <div class="float-right" style="width: 49%;">
                    <p class="lead mt-1 mb-0">: {{ $no_service }}</p>
                    <p class="lead mt-0 mb-0">: {{ $data->penerimaan->id_customer }}</p>
                    <p class="lead mt-0 mb-0">: {{ ucwords($data->penerimaan->customer->name) }}</p>
                    <p class="lead mt-0 mb-1">: {{ $data->penerimaan->customer->nomorhp }}</p>
                </div>
            </div>
        </div>

        <div class="border mt-1" style="width: 100%;">
            <h1 class="display-5 text-center mt-1 mb-1" style="font-weight: bold; letter-spacing: 1.5px;">INFORMASI PERBAIKAN & PENGEMBALIAN BARANG</h1>

            <div class="float-left" style="width: 50%;">
                <div class="float-left" style="width: 25%;">
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Tanggal Terima</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Nama Barang</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Problem</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Request</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Data Penting</p>
                    <p class="lead ml-2 mt-0 mb-1" style="font-weight: bold; letter-spacing: 1.5px;">Kelengkapan</p>
                </div>

                <div class="float-right" style="width: 74%;">
                    <p class="lead ml-2 mt-0 mb-0">: {{ $tanggal }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->barang->nama }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->problem }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->request }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data_penting }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->kelengkapan }}</p>
                </div>                        
            </div>

            <div class="float-right" style="width: 50%;">
                <div class="float-left" style="width: 25%;">
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Kondisi</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Tanggal Selesai</p>
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Status Kembali</p>
                    @if ($data->penerimaan->sn)
                        <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Serial Number</p>
                    @endif
                </div>

                <div class="float-right" style="width: 74%;">
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->kondisi_barang }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->pengerjaan->waktu_selesai }}</p>
                    <p class="lead ml-2 mt-0 mb-0">: {{ $data->status_pengembalian ? 'Dikembalikan' : 'Belum dikembalikan' }}</p>
                    @if ($data->penerimaan->sn)
                        <p class="lead ml-2 mt-0 mb-0">: {{ $data->penerimaan->sn }}</p>
                    @endif
                </div>                        
            </div>
        </div>

        <div class="border mt-1" style="width: 100%;">
            <h1 class="display-5 text-center mt-1 mb-1" style="font-weight: bold; letter-spacing: 1.5px;">PEMBAYARAN SERVICE</h1>

            <div class="float-left mb-2" style="width: 33%;">
                <div class="float-left" style="width: 35%;">
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Biaya Service</p>
                </div>

                <div class="float-right" style="width: 64%;">
                    <p class="lead ml-2 mt-0 mb-0">: Rp. {{ number_format($data->penerimaan->pengerjaan->nominal) }}</p>
                </div>                        
            </div>

            <div class="float-left mb-2" style="width: 33%;">
                <div class="float-left" style="width: 32%;">
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Jumlah Bayar</p>
                </div>

                <div class="float-right" style="width: 67%;">
                    <p class="lead ml-2 mt-0 mb-0">: Rp. {{ number_format($data->arusKas->nominal) }}</p>
                </div>                        
            </div>

            <div class="float-left mb-2" style="width: 33%;">
                <div class="float-left" style="width: 25%;">
                    <p class="lead ml-2 mt-0 mb-0" style="font-weight: bold; letter-spacing: 1.5px;">Kembalian</p>
                </div>

                <div class="float-right" style="width: 74%;">
                    <p class="lead ml-2 mt-0 mb-0">: Rp. {{ number_format(intval($data->arusKas->nominal) - intval($data->penerimaan->pengerjaan->nominal)) }}</p>
                </div>                        
            </div>
        </div>

        <div class="border mt-1" style="width: 100%;">
            <ul class="mt-1 mb-1">
                <li><p class="lead mt-0 mb-0">Barang service yang tidak diambil dalam 3 (tiga) bulan setelah tanggal terima service, resiko kehilangan & kerusakan bukan tanggungjawab twincom.</p></li>
                <li><p class="lead mt-0 mb-0">Kami akan berusaha menyelamatkan data namun tidak bertanggungjawab atas resiko kehilangan data.</p></li> 
                <li><p class="lead mt-0 mb-0">Perbaikan untuk kerusakan yang sama bergaransi 7 (tujuh) hari.</p></li>   
                <li><p class="lead mt-0 mb-0">Perbaikan motherboard laptop bergaransi 30 hari.</p></li>
                <li><p class="lead mt-0 mb-0">Sparepart laptop bergaransi 30 hari. Sparepart printer tidak bergaransi.</p></li>
                <li><p class="lead mt-0 mb-0">Bila anda kecewa maka biaya gratis 100% (syarat dan ketentuan berlaku).</p></li>
            </ul>
        </div>

        <div class="border mt-1" style="width: 100%;">
            <div class="float-left mb-0 pb-1" style="width: 59%;">
                <p class="lead ml-2 mt-6 mb-0">Bila Anda Kecewa : 081347992722 / 08125042742</p>
                {{-- <p class="lead ml-2 mt-0 mb-2">Pengguna Sistem : </p> --}}
            </div>

            <div class="float-right mt-0" style="width: 40%;">
                <p class="lead text-center mt-2 mb-0">{{ ucwords($data->penerimaan->cabang->nama_cabang) . ', ' . $now }}</p>
                
                <div class="float-left" style="width: 32%">
                    <p class="lead text-center mt-0 mb-5">Diserahkan</p>
                    <p class="lead text-center mt-0 mb-1">{{ ucwords($data->penerimaan->admin->name) }}</p>
                </div>

                <div class="float-left" style="width: 32%">
                    <p class="lead text-center mt-0 mb-5">Diterima</p>
                    <p class="lead text-center mt-0 mb-1">{{ $data->penerimaan->customer->name }}</p>
                </div>

                <div class="float-left" style="width: 32%">
                    <p class="lead text-center mt-0 mb-5">Administrasi</p>
                    <p class="lead text-center mt-0 mb-1">{{ $data->penerimaan->admin->name }}</p>
                </div>
            </div>
        </div>
    </body>
</html>
