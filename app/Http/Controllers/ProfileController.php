<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
