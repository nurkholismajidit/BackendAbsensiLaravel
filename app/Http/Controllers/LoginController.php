<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class LoginController extends Controller
{
    public function show()
    {
        // Data yang ingin dikirim ke view
        $data = [
            'title' => 'Login Check Point',
        ];

        // Mengembalikan view dengan data
        return view('login', $data);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // return redirect()->intended('/profile'); // Sesuaikan rute setelah login
            // Jika login berhasil, ambil user yang terautentikasi
        $user = Auth::user();

        // Mengembalikan view dengan data pengguna
        return view('profile', ['user' => $user]); // Sesuaikan nama view dan data yang ingin dikirim
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput(); // Mengembalikan input yang sudah dimasukkan
    }

    public function logout(Request $request)
    {
    Auth::logout();

    return redirect('/login'); // Redirect to a desired route after logout
    }

}
