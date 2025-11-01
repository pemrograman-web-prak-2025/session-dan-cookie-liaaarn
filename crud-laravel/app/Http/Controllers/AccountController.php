<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    // Tampilkan halaman account
    public function show()
    {
        $user = Auth::user();
        return view('account', compact('user'));
    }

    // Update data akun
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        // Update data
        $user->username = $request->username;
        $user->email = $request->email;

        // Hanya update password kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('account')->with('success', 'Account updated successfully!');
    }
}
