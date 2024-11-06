<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkAttendance()
    {
        $user = Auth::user();
        $today = Carbon::today(); // Tanggal hari ini
        $attendance = Attendance::where('user_id', $user->id)->whereDate('clock_in', $today)->first();

        // Cek apakah pengguna sudah clock in sebelum pukul 08:00
        if (!$attendance || $attendance->clock_in > $today->setTime(8, 0)) {
            // Kirim notifikasi jika belum clock in sebelum jam 08:00
            Notification::create([
                'user_id' => $user->id,
                'message' => 'Anda belum clock in sebelum jam 08:00.',
                'status' => 0, // Notifikasi belum dibaca
            ]);
        }

        // Cek apakah pengguna sudah clock out sebelum pukul 16:00
        if ($attendance && !$attendance->clock_out || $attendance->clock_out > $today->setTime(16, 0)) {
            // Kirim notifikasi jika belum clock out sebelum jam 16:00
            Notification::create([
                'user_id' => $user->id,
                'message' => 'Anda belum clock out sebelum jam 16:00.',
                'status' => 0, // Notifikasi belum dibaca
            ]);
        }

        return redirect()->route('home');
    }

    public function indexNotifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->get();
        return view('notification', compact('notifications'));
    }

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
        $today = Carbon::now()->format('Y-m-d'); // Mendapatkan tanggal hari ini

        // Cek apakah sudah clock in untuk hari ini berdasarkan kolom 'date'
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', $today) // Mengecek berdasarkan tanggal
            ->first();

        if ($attendance) {
            return redirect()->back()->with('error', 'Anda sudah clock in hari ini.');
        }

        // Proses untuk menyimpan clock in
        $attendance = new Attendance();
        $attendance->user_id = auth()->id();
        $attendance->clock_in = now(); // Menyimpan waktu clock in lengkap
        $attendance->date = Carbon::now()->toDateString(); // Menyimpan tanggal saja

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
        $today = Carbon::now()->format('Y-m-d'); // Mendapatkan tanggal hari ini

        // Cek apakah sudah clock in untuk hari ini
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', $today) // Mengecek berdasarkan tanggal
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'Anda harus clock in terlebih dahulu.');
        }

        // Cek apakah sudah clock out hari ini
        if ($attendance->clock_out) {
            return redirect()->back()->with('error', 'Anda sudah clock out hari ini.');
        }

        // Proses untuk menyimpan clock out
        $attendance->clock_out = now(); // Menyimpan waktu clock out lengkap

        // Hitung working_hours (dalam jam)
        $workingHours = $attendance->clock_out->diffInHours($attendance->clock_in);

        // Simpan nilai working_hours ke dalam kolom
        $attendance->working_hours = $workingHours;
        $attendance->save();

        return redirect()->back()->with('success', 'Clock out berhasil.');
    }
}
