<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

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
    return redirect('/login');
});

//Frontend
Route::get('/login', [App\Http\Controllers\LoginController::class, 'show'])->name('show.route');
// Route::get('/register', [App\Http\Controllers\RegisterController::class, 'show'])->name('show.route');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('show.route');
// Post Login
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

//User
Route::resource('users', UserController::class);
//register
Route::get('/register', function () {
    return view('register'); // ganti 'register' dengan nama file Blade Anda
})->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
//profile
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
//logout
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
//Home
Route::get('/home', function () {
    return view('home'); // ganti 'register' dengan nama file Blade Anda
})->name('home');




Route::get('/gaji', [App\Http\Controllers\API\PresensiController::class, 'showGaji'])->name('gaji.show');

Route::get('/presensi', function () {
    return view('livewire.presensi-form');
})->name('presensi.form');

Route::post('/presensi/save', [App\Http\Controllers\PresensiController::class, 'savePresensi'])->name('presensi.save');
