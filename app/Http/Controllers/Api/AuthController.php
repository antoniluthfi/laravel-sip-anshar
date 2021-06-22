<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;
    
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'aktif'])) {
            $user = Auth::user();                
            $success['user'] = $user;
            $success['token'] = $user->createToken('sip', [])->accessToken;

            return response()->json([
                'success' => $success, 
            ], $this->successStatus);
        } else {
            return response()->json([
                'error' => 'unauthorized'
            ], 401);
        }
    } 

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'nomorhp' => 'required',
            'cabang' => 'required',
            'status' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'error' => $validator->errors()
            ], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['hak_akses'] = 'customer';
        $user = User::create($input);

        return response()->json([
            'status' => 'OK',
            'message' => 'User berhasil didaftarkan',
            'error' => null,
            'result' => $user
        ], $this->successStatus);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->OauthAccessToken()->delete();

            return response()->json([
                'message' => 'Successfully logout'
            ], 200);
        }
    }
}
