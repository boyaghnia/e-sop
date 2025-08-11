<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    function tampilLogin() {
        return view('login');
    }

    public function submitLogin(Request $request)
    {
        $credentials = $request->validate([
            'id_uker' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Simpan sesi admin jika login sebagai admin
            if (Auth::user()->role === 'admin') {
                session()->put('admin_id', Auth::id());
            }

            return redirect('dashboard');
        }

        return back()->withErrors([
            'id_uker' => 'ID atau password salah.',
        ]);
    }

    public function logout()
    {
        if (session()->has('admin_id')) {
            session()->forget(['admin_id']);
        }

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    // public function impersonate($nip)
    // {
    //     $user = \App\Models\User::where('nip', $nip)->first();

    //     if ($user) {
    //         // Simpan sesi admin sebelum impersonasi
    //         if (!session()->has('admin_id')) {
    //             session()->put('admin_id', Auth::id());
    //             session()->put('admin_nip', Auth::user()->nip);
    //         }

    //         // Login sebagai user target
    //         Auth::login($user);
    //         session()->put('impersonate', true);

    //         return redirect('/portfolio')->with('success', 'Anda sekarang masuk sebagai ' . $user->name);
    //     }

    //     return redirect('/dashboard')->with('error', 'User tidak ditemukan.');
    // }


    // public function stopImpersonate()
    // {
    //     if (session()->has('admin_id')) {
    //         $admin = \App\Models\User::find(session('admin_id'));

    //         if ($admin) {
    //             Auth::login($admin);
    //             session()->forget('impersonate');

    //             return redirect('/dashboard')->with('success', 'Kembali sebagai Admin');
    //         }
    //     }

    //     return redirect('/login')->with('error', 'Sesi admin tidak ditemukan, silakan login ulang.');
    // }
}
