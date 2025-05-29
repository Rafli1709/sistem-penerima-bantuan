<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;

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

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kriteria', KriteriaController::class)->parameter('kriteria', 'kriteria');
    Route::resource('sub-kriteria', SubKriteriaController::class)->except('create')->parameter('sub-kriteria', 'subKriteria');
    Route::get('sub-kriteria/create/{kriteria}', [SubKriteriaController::class, 'create'])->name('sub-kriteria.create');

    Route::get('/masyarakat/import', [MasyarakatController::class, 'import'])->name('import');
    Route::post('/masyarakat/import', [MasyarakatController::class, 'processImport'])->name('import.process');
    Route::resource('masyarakat', MasyarakatController::class);

    Route::prefix('perhitungan')->name('perhitungan.')->controller(PerhitunganController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('hitung', 'hitung')->name('hitung');
    });

    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('change-password', 'changePassword')->name('change-password');
        Route::put('change-password', 'prosesChangePassword')->name('change-password.proses');
    });

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});

Route::name('login.')->prefix('login')->middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});
