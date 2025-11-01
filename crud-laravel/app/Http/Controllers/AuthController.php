<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === REGISTER ===
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Simpan ke database
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        return redirect('/')->with('success', 'Register sukses!');
    }

    // === LOGIN ===
    public function login(Request $request) {
        // Ambil hanya email dan password dari input form
        $credentials = $request->only('email', 'password');

        // Cek apakah user mencentang "Remember me" 
        $remember = $request->has('remember');
        
        // Coba autentikasi dengan kredensial yang diberikan
        if (Auth::attempt($credentials, $remember)) {
            // Jika login berhasil dan "Remember me" dicentang
            if ($remember) {
                // Simpan email ke cookie selama 30 hari
                cookie()->queue('remember_email', $request->email, 60*24*30); // 30 hari
            } else {
                // Jika tidak di simpan, hapus cookie email
                cookie()->queue(cookie()->forget('remember_email'));
        }

        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Email atau password salah!');
}

    // === LOGOUT ===
    public function logout()
    {
        // Logout pengguna saat ini
        Auth::logout();

        // Hapus semua data sesi
        session()->invalidate();

        // Regenerasi token CSRF untuk keamanan
        session()->regenerateToken();

        // Redirect ke halama utama dengan pesan logout sukses
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
