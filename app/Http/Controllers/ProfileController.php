<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Data yang ingin dikirim ke view
        $data = [
            'title' => 'Profile',
        ];

        // Mengembalikan view dengan data
        return view('profile', $data);
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
    public function destroy()
    {
    $user = Auth::user();
    Auth::logout(); // Logout pengguna
    $user->delete(); // Hapus akun pengguna

    return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
