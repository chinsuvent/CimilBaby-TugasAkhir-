<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\JadwalLayananController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register','register')->name('register');
    Route::post('register','registerSave')->name('register.save');

    Route::get('login','login')->name('login');
    Route::post('login','loginAction')->name('login.action');

    Route::get('logout','logout')->middleware('auth')->name('logout');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    



    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('users');
        Route::get('create','create')->name('users.create');
        Route::post('store','store')->name('users.store');
        Route::get('show/{id}','show')->name('users.show');
        Route::get('edit/{id}','edit')->name('users.edit');
        Route::put('update/{id}','update')->name('users.update');
        Route::delete('destroy/{id}','destroy')->name('users.destroy');
    });

    Route::controller(AnakController::class)->prefix('anaks')->group(function () {
        Route::get('', 'index')->name('anaks');
        Route::get('create','create')->name('anaks.create');
        Route::post('store','store')->name('anaks.store');
        Route::get('show/{id}','show')->name('anaks.show');
        Route::get('edit/{id}','edit')->name('anaks.edit');
        Route::put('update/{id}','update')->name('anaks.update');
        Route::delete('/anaks/{id}', [AnakController::class, 'destroy'])->name('anaks.destroy');
    });

    Route::controller(LayananController::class)->prefix('layanans')->group(function () {
        Route::get('', 'index')->name('layanans');
        Route::get('create','create')->name('layanans.create');
        Route::post('store','store')->name('layanans.store');
        Route::get('show/{id}','show')->name('layanans.show');
        Route::get('edit/{id}','edit')->name('layanans.edit');
        Route::put('update/{id}','update')->name('layanans.update');
        Route::delete('/layanans/{id}', [LayananController::class, 'destroy'])->name('layanans.destroy');
    });

    Route::controller(ReservasiController::class)->prefix('reservasis')->group(function () {
        Route::get('', 'index')->name('reservasis');
        Route::get('create','create')->name('reservasis.create');
        Route::post('store','store')->name('reservasis.store');
        Route::get('show/{id}','show')->name('reservasis.show');
        Route::get('edit/{id}','edit')->name('reservasis.edit');
        Route::put('update/{id}','update')->name('reservasis.update');
        Route::delete('/reservasis/{id}', [ReservasiController::class, 'destroy'])->name('reservasis.destroy');
        Route::put('/reservasis/konfirmasi/{id}', [ReservasiController::class, 'konfirmasi'])->name('reservasis.konfirmasi');
    });

    Route::controller(FasilitasController::class)->prefix('fasilitas')->group(function () {
        Route::get('', 'index')->name('fasilitas');
        Route::get('create','create')->name('fasilitas.create');
        Route::post('store','store')->name('fasilitas.store');
        Route::get('show/{id}','show')->name('fasilitas.show');
        Route::get('edit/{id}','edit')->name('fasilitas.edit');
        Route::put('update/{id}','update')->name('fasilitas.update');
        Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
        Route::put('/fasilitas/konfirmasi/{id}', [FasilitasController::class, 'konfirmasi'])->name('fasilitas.konfirmasi');
    });

    Route::controller(JadwalLayananController::class)->prefix('jadwal_layanans')->group(function () {
        Route::get('', 'index')->name('jadwal_layanans');
        Route::get('create','create')->name('jadwal_layanans.create');
        Route::post('store','store')->name('jadwal_layanans.store');
        Route::get('show/{id}','show')->name('jadwal_layanans.show');
        Route::get('edit/{id}','edit')->name('jadwal_layanans.edit');
        Route::put('update/{id}','update')->name('jadwal_layanans.update');
        Route::delete('/jadwal_layanans/{id}', [JadwalLayananController::class, 'destroy'])->name('jadwal_layanans.destroy');
        Route::put('/jadwal_layanans/konfirmasi/{id}', [JadwalLayananController::class, 'konfirmasi'])->name('jadwal_layanans.konfirmasi');
        Route::get('/generate-jadwal', [JadwalLayananController::class, 'generateJadwal'])->name('jadwal_layanans.generateJadwal');
        Route::get('/jadwal-layanans', [JadwalLayananController::class, 'index'])->name('jadwal_layanans.index');

    });

    

});
