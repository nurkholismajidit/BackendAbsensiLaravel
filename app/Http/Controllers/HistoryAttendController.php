<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoryAttendController extends Controller
{
    public function showHistoryAttend()
    {
         // Ambil data kehadiran dari database untuk pengguna yang sedang login
    $attendances = Attendance::where('user_id', auth()->id())->get();

    // Ambil pengguna berdasarkan user_id
    $user = User::find(Auth::id());

        return view('historyattend', compact('attendances', 'user'));
    }
}
