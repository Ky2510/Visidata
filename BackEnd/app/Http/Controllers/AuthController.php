<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function loginIndex()
    {
       return view('login'); 
    }

    public function loginWeb(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Kredensial login
        $credentials = $request->only('email', 'password');

        // Coba otentikasi pengguna
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index', [
                'user' => auth()->user()
            ]); 
        } else {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
    }

    public function registerIndex()
    {
       return view('register'); 
    }


    public function registerWeb(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        // Menghasilkan token JWT (jika diperlukan)
        $token = JWTAuth::fromUser($user);

        // Mengarahkan ke halaman login setelah registrasi berhasil
        return redirect()->route('login');
    }

    public function logoutWeb(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
