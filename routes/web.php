<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengurus\AspirasiController;
use App\Http\Controllers\AspirasiUserController;
use App\Http\Controllers\Pengurus\BeritaController;
use App\Http\Controllers\Pengurus\DashboardController;
use App\Http\Controllers\UserBeritaController;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController;
use App\Http\Controllers\UserPrestasiController;
use App\Http\Controllers\Pengurus\PrestasiController;
use App\Http\Controllers\Pengurus\AnggotaController;
use App\Http\Controllers\UserPendaftaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');



    Route::view('/mahasiswa-bermasalah', 'admin.bermasalah.index')->name('mahasiswa-bermasalah');

<<<<<<< HEAD
    Route::resource('prestasi', AdminPrestasiController::class)->except(['create', 'show', 'edit']);

    Route::resource('berita', AdminBeritaController::class);
=======
    Route::get('prestasi', function () { return view('admin.prestasi.index'); })->name('prestasi.index');

    Route::get('berita', function () { return view('admin.berita.index'); })->name('berita.index');
>>>>>>> cabang1

    Route::get('/kelola-anggota-himati', [AdminAnggotaController::class, 'index'])->name('kelola-anggota-himati.index');
    Route::get('/calon-anggota', [AdminAnggotaController::class, 'calonAnggota'])->name('calon-anggota.index');
    Route::post('calon-anggota/{pendaftaran}/approve', [AdminAnggotaController::class, 'approveCandidate'])->name('calon-anggota.approve');
    Route::post('calon-anggota/{pendaftaran}/reject', [AdminAnggotaController::class, 'rejectCandidate'])->name('calon-anggota.reject');
    Route::get('/calon-anggota-tahap-1', [AdminAnggotaController::class, 'calonAnggotaTahap1'])->name('calon-anggota-tahap-1.index');
    Route::get('/calon-anggota-tahap-2', [AdminAnggotaController::class, 'calonAnggotaTahap2'])->name('calon-anggota-tahap-2.index');

    Route::delete('/calon-anggota/{id}', [AdminAnggotaController::class, 'destroy'])->name('calon-anggota.destroy');

    Route::get('aspirasi/print', [AdminAspirasiController::class, 'printPdf'])->name('aspirasi.printPdf');
    Route::resource('aspirasi', AdminAspirasiController::class)->only(['index', 'show', 'destroy']);
});

Route::prefix('pengurus')->name('pengurus.')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




<<<<<<< HEAD
  Route::resource('prestasi', PrestasiController::class)->except(['create', 'show', 'edit']);

  Route::resource('berita', BeritaController::class);
=======
  Route::get('berita', function () { return view('pengurus.berita.index'); })->name('berita.index');

  Route::get('prestasi', function () { return view('pengurus.prestasi.index'); })->name('prestasi.index');
>>>>>>> cabang1

        Route::resource('anggota', AnggotaController::class);
        Route::get('calon-anggota', [AnggotaController::class, 'calonAnggota'])->name('calon-anggota.index');
        Route::post('calon-anggota/{pendaftaran}/approve', [AnggotaController::class, 'approveCandidate'])->name('calon-anggota.approve');
        Route::post('calon-anggota/{pendaftaran}/reject', [AnggotaController::class, 'rejectCandidate'])->name('calon-anggota.reject');
        Route::get('calon-anggota-tahap-1', [AnggotaController::class, 'calonAnggotaTahap1'])->name('calon-anggota-tahap-1.index');
        Route::get('calon-anggota-tahap-2', [AnggotaController::class, 'calonAnggotaTahap2'])->name('calon-anggota-tahap-2.index');
        Route::get('kelola-anggota-himati', [AnggotaController::class, 'kelolaAnggotaHimati'])->name('kelola-anggota-himati.index');

  Route::delete('/calon-anggota/{id}', [AnggotaController::class, 'destroy'])->name('calon-anggota.destroy');

  Route::get('aspirasi/print', [AspirasiController::class, 'printPdf'])->name('aspirasi.printPdf');
  Route::resource('aspirasi', AspirasiController::class)->only(['index', 'show', 'destroy']);

});

Route::prefix('user')->name('user.')->group(function () {
    Route::view('/beranda', 'user.beranda')->name('beranda');
    Route::view('/divisi', 'user.divisi')->name('divisi');
    Route::view('/profil', 'user.profil')->name('profil');

    Route::view('/pendaftaran', 'user.pendaftaran')->name('pendaftaran');
    Route::post('/pendaftaran', [UserPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/prestasi', [UserPrestasiController::class, 'index'])->name('prestasi');

<<<<<<< HEAD
    Route::get('/berita', [UserBeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{berita}', [UserBeritaController::class, 'show'])->name('berita.show');
    Route::post('/berita/{berita}/komentar', [UserBeritaController::class, 'storeKomentar'])->name('komentar.store');

=======
>>>>>>> cabang1
    Route::view('/aspirasi', 'user.aspirasi')->name('aspirasi');
    Route::post('/aspirasi', [AspirasiUserController::class, 'store'])->name('aspirasi.store');


    Route::view('/aspirasi', 'user.aspirasi')->name('aspirasi');
    Route::post('/aspirasi', [AspirasiUserController::class, 'store'])->name('aspirasi.store');

    Route::get('/berita', [UserBeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{berita}', [UserBeritaController::class, 'show'])->name('berita.show');
    Route::post('/berita/{berita}/komentar', [UserBeritaController::class, 'storeKomentar'])->name('komentar.store');

});