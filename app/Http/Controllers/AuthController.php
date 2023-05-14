<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //memanggil model user
use App\Models\Log;
use Firebase\JWT\JWT; //memanggil library JWT
use Illuminate\Support\Facades\Validator; //panggil library validator untuk validasi inputan
use Illuminate\Support\Facades\Auth; //panggil library untuk otrntikasi
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirmation_password' => 'required|same:password'
            ]);

            $user = $validator->validated();


            //masukkan user ke database user 
            User::create($user);

            // isi token JWT
            $playload = [
                'nama' => $user['name'],
                'role' => 'user',
                'iat' => now()->timestamp,
                'exp' => now()->timestamp + 7200
            ];

            // generate token dengan algoritma HS256
            $token = JWT::encode($playload, env('JWT_SECRET_KEY'), 'HS256');

            // BUAT LOGIN 
            Log::create([
                'module' => 'login',
                'action' => 'login akun',
                'useraccess' => $user['email']
            ]);

            // kirim respons ke pengguna 
            return response()->json([
                "data" => [
                    'msg' => "Berhasil Register",
                    'nama' => $user['name'],
                    'email' => $user['email'],
                    'role' => 'user',
                ],
                "token" => "Beare {$token}"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ]);
        }
    }
}
