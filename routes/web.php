<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
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
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(PenggunaController::class)->prefix('penggunas')->group(function () {
        Route::get('', 'index')->name('penggunas');
        Route::get('create','create')->name('penggunas.create');
        Route::post('store','store')->name('penggunas.store');
        Route::get('show/{id}','show')->name('penggunas.show');
        Route::get('edit/{id}','edit')->name('penggunas.edit');
        Route::put('update/{id}','update')->name('penggunas.update');
        Route::delete('destroy/{id}','destroy')->name('penggunas.destroy');
    });
});
