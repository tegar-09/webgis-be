<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * Login function for API.
     */

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'nik' => $user->nik,
                    'nama_asli' => $user->nama_asli,
                    'alamat' => $user->alamat,
                    'lembaga' => $user->lembaga,
                    'no_telp' => $user->no_telp,
                ],
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid username or password',
            ], 401);
        }
    }

}
