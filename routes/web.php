<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/check-nik', [RegisterController::class, 'checkNIK'])->name('register.checkNIK')->middleware('guest');
Route::get('/register/verification/{nik}', [RegisterController::class, 'verification'])->name('register.verification')->middleware('guest');
Route::post('/register/send-otp/{nik}', [RegisterController::class, 'sendOTP'])->name('register.sendOTP')->middleware('guest');
Route::get('/register/activation/{nik}/{no_hp}', [RegisterController::class, 'activation'])->name('register.activation')->middleware('guest');
Route::post('/register/create', [RegisterController::class, 'register'])->name('register.create')->middleware('guest');
Route::get('/register/resend-otp/{nik}/{no_hp}', [RegisterController::class, 'resendOTP'])->name('register.resendOTP')->middleware('guest');
Route::post('/register/change-no-hp/{nik}', [RegisterController::class, 'changeNoHP'])->name('register.changeNoHP')->middleware('guest');

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Middleware Auth
Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/edit/{id}', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::post('/pengajuan/update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::delete('/pengajuan/destroy/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
    Route::get('/pengajuan/destroy-perihal/{pengajuan_id}/{perihal_id}', [PengajuanController::class, 'destroyPerihal'])->name('pengajuan.destroyPerihal');
    Route::get('/pengajuan/cetak/{id}', [PengajuanController::class, 'cetak'])->name('pengajuan.cetak');
    Route::get('/pengajuan/kirim-surat/{id}', [PengajuanController::class, 'kirimSurat'])->name('pengajuan.kirimSurat');
    
});
