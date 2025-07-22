<?php
use Illuminate\Http\Request;

use App\Http\Controllers\AnakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\JadwalLayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanReservasiController;
use App\Http\Controllers\LaporanPenitipanController;
use App\Http\Controllers\Pelanggan\DashboardPelangganController;
use App\Http\Middleware\CekLevelPengguna;
use App\Http\Controllers\Pelanggan\ProfilController;
use App\Http\Controllers\Pelanggan\AnakPelangganController;
use App\Http\Controllers\Pelanggan\ReservasiPelangganController;
use App\Http\Controllers\Auth\ForgotPasswordWAController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/tentang_kami', function () {
    return view('tentang_kami');
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/jadwal_layanan', [App\Http\Controllers\JadwalLayananController::class, 'showPublic']);



Route::get('/menu_fasilitas', function () {
    return view('menu_fasilitas');
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

    Route::get('/laporans_reservasi', [LaporanReservasiController::class, 'index'])->name('laporans_reservasi.index');
    Route::get('/laporans_reservasi/cetak', [LaporanReservasiController::class, 'cetak'])->name('laporans_reservasi.cetak');

    Route::get('/laporans_penitipan', [LaporanPenitipanController::class, 'index'])->name('laporans_penitipan.index');
    Route::get('/laporans_penitipan/cetak', [LaporanPenitipanController::class, 'cetak'])->name('laporans_penitipan.cetak');
});






Route::get('/pelanggan/dashboard', [DashboardPelangganController::class, 'index'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.dashboard');



Route::get('/pelanggan/profil', [ProfilController::class, 'index'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.profil');

Route::get('/pelanggan/profil/editProfil', [ProfilController::class, 'editProfil'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.editProfil');

Route::put('/pelanggan/profil/editProfil', [ProfilController::class, 'updateProfil'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.updateProfil');


Route::get('/pelanggan/anak', [AnakPelangganController::class, 'index'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.anak');

Route::get('/pelanggan/anak/{id}/edit', [AnakPelangganController::class, 'editAnak'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('anak.edit');


// Proses update anak
Route::put('/pelanggan/anak/{id}', [AnakPelangganController::class, 'updateAnak'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('anak.update');

Route::delete('/pelanggan/anak/{id}', [AnakPelangganController::class, 'hapusAnak'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('anak.hapusAnak');

// Form tambah anak
Route::get('/pelanggan/anak/tambah', [AnakPelangganController::class, 'tambahAnak'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('anak.tambahAnak');

// Proses simpan anak baru
Route::post('/pelanggan/anak/tambah', [AnakPelangganController::class, 'simpanAnak'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('anak.simpan');

Route::get('/pelanggan/reservasi', [ReservasiPelangganController::class, 'index'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.reservasi');

Route::get('/pelanggan/reservasi/{id}', [ReservasiPelangganController::class, 'show'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.reservasi.show');

Route::delete('/pelanggan/reservasi/{id}', [ReservasiPelangganController::class, 'destroy'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.reservasi.destroy');

Route::patch('/pelanggan/reservasi/{id}/batal', [ReservasiPelangganController::class, 'cancel'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.cancel');

Route::get('/pelanggan/reservasi/{id}/edit', [ReservasiPelangganController::class, 'edit'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.edit');

Route::put('/pelanggan/reservasi/{id}', [ReservasiPelangganController::class, 'update'])
    ->middleware(['auth', CekLevelPengguna::class])
    ->name('pelanggan.update');


Route::post('/reservasi/store', [ReservasiPelangganController::class, 'store'])
    ->middleware('auth')
    ->name('reservasi.store');

Route::get('/layanan', [LayananController::class, 'showLayanan'])->middleware('auth')->name('layanan');


Route::get('/', [LayananController::class, 'beranda'])->name('beranda');

Route::get('/', [ReservasiPelangganController::class, 'beranda'])->name('pelanggan.beranda');


Route::get('/lupa-password', [App\Http\Controllers\Auth\ResetPasswordWAController::class, 'showForm']);
Route::post('/kirim-token', [App\Http\Controllers\Auth\ResetPasswordWAController::class, 'sendToken']);
Route::get('/verifikasi-token', [App\Http\Controllers\Auth\ResetPasswordWAController::class, 'showInputTokenForm'])->name('form.verifikasi.token');
Route::get('/verifikasi-token-cari', function (Request $request) {
    return redirect('/verifikasi/' . $request->token);
});

Route::get('/verifikasi/{token}', [App\Http\Controllers\Auth\ResetPasswordWAController::class, 'verifyForm']);
use Illuminate\Support\Facades\Auth;

Route::get('/ubah-password', function () {
    $user = Auth::user();
    return view('auth.reset-password-wa', compact('user'));
});

Route::post('/ubah-password', [App\Http\Controllers\Auth\ResetPasswordWAController::class, 'updatePassword']);


Route::get('/wa-lupa-password', [ForgotPasswordWAController::class, 'formLupaPassword'])->name('wa.form.lupa');
Route::post('/wa-kirim-token', [ForgotPasswordWAController::class, 'kirimTokenWA'])->name('wa.kirim.token');
Route::get('/wa-verifikasi-token', [ForgotPasswordWAController::class, 'formVerifikasiToken'])->name('wa.form.verifikasi');
Route::post('/wa-verifikasi-token', [ForgotPasswordWAController::class, 'prosesVerifikasiToken'])->name('wa.verifikasi');
Route::post('/wa-reset-password', [ForgotPasswordWAController::class, 'simpanPasswordBaru'])->name('wa.reset.password');

Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'showLayanan']);


Route::get('/riwayat-reservasi', [ReservasiPelangganController::class, 'index'])
    ->name('pelanggan.riwayat_reservasi');

Route::post('/reservasi/store', [ReservasiPelangganController::class, 'store'])->name('reservasi.store');


// Pelanggan
Route::post('/reservasi/{id}/ajukan-pembatalan', [App\Http\Controllers\Pelanggan\ReservasiPelangganController::class, 'ajukanPembatalan'])->name('pelanggan.ajukanPembatalan');
Route::post('/admin/reservasi/{id}/konfirmasi-pembatalan', [ReservasiController::class, 'konfirmasiPembatalan'])->name('admin.reservasi.konfirmasiPembatalan');
Route::put('/admin/pembatalan/{id}', [ReservasiController::class, 'konfirmasiPembatalan'])->name('admin.pembatalan.konfirmasi');




















