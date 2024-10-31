<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;

date_default_timezone_set("Asia/Jakarta");

class PresensiController extends Controller
{
//     public function savePresensi(Request $request)
// {
//     $request->validate([
//         'latitude' => 'required',
//         'longitude' => 'required',
//         'image_masuk' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar masuk
//         'image_pulang' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar pulang
//     ]);

//     // $today = date('Y-m-d');
//     // $currentUserId = Auth::user()->id;

//     //edit
//     $today = now()->format('Y-m-d');
//     $currentUserId = auth()->id();

//     // Ambil presensi pengguna saat ini
//     $presensi = Presensi::whereDate('tanggal', $today)
//         ->where('user_id', $currentUserId)
//         ->first();

//     if (is_null($presensi)) {
//         // Simpan presensi baru untuk masuk
//         $presensi = Presensi::create([
//             'user_id' => $currentUserId,
//             'latitude' => $request->latitude,
//             'longitude' => $request->longitude,
//             'tanggal' => $today,
//             'masuk' => now()->format('H:i:s'), // Waktu sekarang sebagai jam masuk
//         ]);

//         // Menyimpan gambar absensi masuk jika ada
//         if ($request->hasFile('image_masuk')) {
//             $imagePath = $request->file('image_masuk')->store('images/absensi/masuk', 'public');
//             $presensi->image_masuk = $imagePath;
//             $presensi->save();
//         }

//         return response()->json([
//             'success' => true,
//             'message' => 'Sukses absen untuk masuk',
//             'data' => $presensi
//         ]);
//     } else {
//         if ($presensi->pulang !== null) {
//             return response()->json([
//                 'success' => false,
//                 'message' => "Anda sudah melakukan presensi pulang",
//                 'data' => null
//             ]);
//         } else {
//             // Menyimpan waktu pulang untuk pengguna saat ini
//             $data = [
//                 'pulang' => now()->format('H:i:s') // Waktu sekarang sebagai jam pulang
//             ];

//             // Menyimpan gambar saat presensi pulang
//             if ($request->hasFile('image_pulang')) {
//                 $imagePathPulang = $request->file('image_pulang')->store('images/absensi/pulang', 'public');
//                 $data['image_pulang'] = $imagePathPulang;
//             }

//             // Update presensi untuk pengguna saat ini
//             $presensi->update($data);

//             return response()->json([
//                 'success' => true,
//                 'message' => 'Sukses Absen untuk Pulang',
//                 'data' => $presensi
//             ]);
//         }
//     }
// }

public function savePresensi(Request $request)
{
    $request->validate([
        'latitude' => 'required',
        'longitude' => 'required',
        'image_masuk' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'image_pulang' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $today = now()->format('Y-m-d');
    $currentUserId = auth()->id();

    // Cek apakah presensi sudah ada
    $presensi = Presensi::whereDate('tanggal', $today)
        ->where('user_id', $currentUserId)
        ->first();

    if (is_null($presensi)) {
        // Simpan data presensi masuk
        $presensi = Presensi::create([
            'user_id' => $currentUserId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal' => $today,
            'masuk' => now()->format('H:i:s'),
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image_masuk')) {
            $presensi->image_masuk = $request->file('image_masuk')->store('images/absensi/masuk', 'public');
            $presensi->save();
        }

        return response()->json(['success' => true, 'message' => 'Sukses absen untuk masuk', 'data' => $presensi]);
    } else {
        // Jika sudah pulang, beri tahu pengguna
        if ($presensi->pulang !== null) {
            return response()->json(['success' => false, 'message' => "Anda sudah melakukan presensi pulang"]);
        }

        // Simpan data pulang
        $data = ['pulang' => now()->format('H:i:s')];

        if ($request->hasFile('image_pulang')) {
            $data['image_pulang'] = $request->file('image_pulang')->store('images/absensi/pulang', 'public');
        }

        $presensi->update($data);

        return response()->json(['success' => true, 'message' => 'Sukses Absen untuk Pulang', 'data' => $presensi]);
    }
}




private function hitungGaji($masuk, $pulang)
{
    $tarifPerJam = 25000; // Tarif per jam
    $jamKerja = $this->hitungJamKerja($masuk, $pulang); // Hitung jam kerja

    // Menghitung gaji
    $gaji = $jamKerja * $tarifPerJam;

    return $gaji; // Mengembalikan total gaji
}

private function hitungJamKerja($masuk, $pulang)
{
    if ($masuk && $pulang) {
        $masukTime = \Carbon\Carbon::createFromFormat('H:i:s', $masuk);
        $pulangTime = \Carbon\Carbon::createFromFormat('H:i:s', $pulang);
        return $pulangTime->diffInHours($masukTime); // Menghitung selisih jam
    }
    return 0; // Jika belum ada jam masuk atau pulang
}

public function showGaji(Request $request)
{
    $currentUserId = Auth::user()->id;
    $bulan = $request->input('bulan', date('m')); // Default bulan saat ini
    $tahun = $request->input('tahun', date('Y')); // Default tahun saat ini

    // Ambil semua presensi untuk bulan dan tahun yang diberikan
    $presensiList = Presensi::where('user_id', $currentUserId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    $totalGaji = 0;

    foreach ($presensiList as $presensi) {
        if ($presensi->masuk && $presensi->pulang) {
            $gaji = $this->hitungGaji($presensi->masuk, $presensi->pulang);
            $totalGaji += $gaji;
        }
    }

    return view('gaji', compact('totalGaji', 'bulan', 'tahun'));
}

public function hitungGajiBulananApi(Request $request)
{
    $currentUserId = Auth::user()->id;
    $bulan = $request->input('bulan', date('m')); // Default bulan saat ini
    $tahun = $request->input('tahun', date('Y')); // Default tahun saat ini

    // Ambil semua presensi untuk bulan dan tahun yang diberikan
    $presensiList = Presensi::where('user_id', $currentUserId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    $totalGaji = 0;

    foreach ($presensiList as $presensi) {
        if ($presensi->masuk && $presensi->pulang) {
            $gaji = $this->hitungGaji($presensi->masuk, $presensi->pulang);
            $totalGaji += $gaji;
        }
    }

    return response()->json([
        'success' => true,
        'total_gaji' => $totalGaji,
        'bulan' => $bulan,
        'tahun' => $tahun,
    ]);
}

}
