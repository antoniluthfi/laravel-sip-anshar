<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Provinsi;
use App\Models\Kota;

class RajaOngkirController extends Controller
{
    public function getProvinsi()
    {
        $provinsi = Provinsi::all();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $provinsi
        ], 200);
    }

    public function getKotaByIdProvinsi($id_provinsi)
    {
        $kota = Kota::where('id_provinsi', $id_provinsi)->get();

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $kota
        ], 200);
    }

    public function getOngkir(Request $request)
    {
        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => 35,      // ID kota/kabupaten asal
            'destination'   => $request->destination,      // ID kota/kabupaten tujuan
            'weight'        => $request->berat,    // berat barang dalam gram
            'courier'       => $request->ekspedisi    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ]);

        $ongkir = (array) $ongkir;
        $ongkir = $ongkir[" * result"][0]['costs'];

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $ongkir
        ], 200);
    }
}
