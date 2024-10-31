<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
