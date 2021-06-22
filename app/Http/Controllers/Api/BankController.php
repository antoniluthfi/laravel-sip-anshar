<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => Bank::all()
        ], 200);
    }

    public function getDataById($id)
    {
        $bank = Bank::find($id);

        return response()->json([
            'status' => 'OK',
            'errors' => null,
            'result' => $bank
        ], 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $bank = Bank::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan',
            'errors' => null,
            'result' => $bank
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $bank = Bank::find($id);
        $input = $request->all();
        $bank->fill($input)->save();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil diupdate',
            'errors' => null,
            'result' => $bank
        ], 200);   
    }

    public function delete($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil dihapus',
            'errors' => null,
        ], 200);   
    }
}
