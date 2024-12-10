<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienRequest;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string'
        ]);
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->back()->with('error', 'Ups! Username atau Password Salah :(');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registrasi_pasien(PasienRequest $request)
    {
        try {
            $data = $request->validated();
            $no_rm = Pasien::generateNoRM();
            $data['no_rm'] = $no_rm;
            $pasien = Pasien::create($data);
            $user = User::create([
                'name' => $pasien->nama,
                'email' => $pasien->nama . '@gmail.com',
                'password' => bcrypt($pasien->alamat),
                'role' => 'pasien',
                'username' => $pasien->nama,
                'id_pasien' => $pasien->id
            ]);
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('register')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
