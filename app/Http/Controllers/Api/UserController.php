<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['nis' => $request->nis, 'password' => $request->password])) {
            return response()->json([
                'messege' => 'Nis atau Password salah'
            ], 401);
        }

        $user = User::where('nis', $request->nis)->firstOrFail();

        $studentData = $user->student;
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil',
            'access_token' => $token,
            'data_user' => $user,
            'data_siswa' => $studentData // kirim data ke flutter
        ]);
    }

}
