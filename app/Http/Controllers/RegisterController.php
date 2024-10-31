<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        // Data yang ingin dikirim ke view
        $data = [
            'title' => 'Register Check Point',
        ];

        // Mengembalikan view dengan data
        return view('register', $data);
}
}
