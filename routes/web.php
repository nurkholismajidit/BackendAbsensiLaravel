<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Filament
Route::get('/', function () {
    // return view('welcome');
    return redirect('/admin/login');
});

//Frontend
Route::get('/login', [App\Http\Controllers\LoginController::class, 'show'])->name('show.route');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'show'])->name('show.route');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('show.route');



Route::get('/gaji', [App\Http\Controllers\API\PresensiController::class, 'showGaji'])->name('gaji.show');

Route::get('/presensi', function () {
    return view('livewire.presensi-form');
})->name('presensi.form');

Route::post('/presensi/save', [App\Http\Controllers\PresensiController::class, 'savePresensi'])->name('presensi.save');
