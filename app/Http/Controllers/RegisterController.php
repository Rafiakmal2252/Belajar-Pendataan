<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InvitationCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registration()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'invitation_code' => 'required|string|exists:invitation_codes,code',
        ]);

        // Cek apakah kode undangan masih tersedia
        $invitation = InvitationCode::where('code', $request->invitation_code)
            ->where('used', false)
            ->lockForUpdate()
            ->first();

        if (!$invitation) {
            return redirect()->back()->withErrors(['invitation_code' => 'Kode undangan tidak valid']);
        }

        // Buat pengguna dengan peran "member"
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'MEMBER', // Set peran default
        ]);

        // Tandai kode undangan sebagai digunakan
        $invitation->update(['used' => true]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'Registrasi berhasil!');
    }
}
