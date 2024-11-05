<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('user_id', Auth::id())->latest()->first();

        // Mengonversi clock_in dan clock_out menjadi objek Carbon jika ada
    if ($attendance) {
        $attendance->clock_in = $attendance->clock_in ? Carbon::parse($attendance->clock_in) : null;
        $attendance->clock_out = $attendance->clock_out ? Carbon::parse($attendance->clock_out) : null;
    }
    // Ambil pengguna berdasarkan user_id
    $user = User::find(Auth::id());

        // Kirim data ke tampilan
        return view('home', compact('attendance', 'user'));
    }

    public function clockIn(Request $request)
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');

    // Cek apakah sudah clock in hari ini
    $attendance = Attendance::where('user_id', auth()->id())
        ->whereDate('clock_in', $today)
        ->first();

    if ($attendance) {
        return redirect()->back()->with('error', 'Anda sudah clock in hari ini.');
    }

    // Proses untuk menyimpan clock in
    $attendance = new Attendance();
    $attendance->user_id = auth()->id();
    $attendance->clock_in = now();

    // Simpan lokasi
    if ($request->filled('latitude') && $request->filled('longitude')) {
        $attendance->location = $request->latitude . ', ' . $request->longitude;
    } else {
        $attendance->location = 'Location not available';
    }

    $attendance->save();

    return redirect()->back()->with('success', 'Clock in berhasil.');
    }

    public function clockOut()
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d');

    // Cek apakah sudah clock in hari ini
    $attendance = Attendance::where('user_id', auth()->id())
        ->whereDate('clock_in', $today)
        ->first();

    if (!$attendance) {
        return redirect()->back()->with('error', 'Anda harus clock in terlebih dahulu.');
    }

    // Cek apakah sudah clock out hari ini
    if ($attendance->clock_out) {
        return redirect()->back()->with('error', 'Anda sudah clock out hari ini.');
    }

    // Proses untuk menyimpan clock out
    $attendance->clock_out = now();

    // Hitung working_hours (dalam jam)
    $workingHours = $attendance->clock_out->diffInHours($attendance->clock_in);

    // Simpan nilai working_hours ke dalam kolom
    $attendance->working_hours = $workingHours;
    $attendance->save();

    return redirect()->back()->with('success', 'Clock out berhasil.');

    }
}
