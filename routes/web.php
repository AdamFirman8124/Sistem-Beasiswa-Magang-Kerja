<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeasiswaAdminController;
use App\Http\Controllers\BeasiswaUserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LokerAdminController;
use App\Http\Controllers\LombaAdminController;
use App\Http\Controllers\LokerUserController;
use App\Http\Controllers\LombaUserController;
use App\Http\Controllers\LaporanAdminController;

use Illuminate\Support\Facades\Auth;


// Guest
Route::get('/', [GuestController::class, 'indexwelcome'])->name('guest.welcome');
Route::get('/', [GuestController::class, 'indexwelcome'])->name('indexwelcome');
Route::get('/guest/beasiswa', [GuestController::class, 'indexbeasiswa'])->name('guest.beasiswa');
Route::get('/guest/lomba', [GuestController::class, 'indexlomba'])->name('guest.lomba');
Route::get('/guest/loker', [GuestController::class, 'indexloker'])->name('guest.loker');
Route::get('/guest/detail-beasiswa/{id}', [GuestController::class, 'infobeasiswa'])->name('guest.detail_beasiswa');
Route::get('/guest/detail-lomba/{id}', [GuestController::class, 'infoLomba'])->name('guest.detail_lomba');
Route::get('/guest/detail-loker/{id}', [GuestController::class, 'infoloker'])->name('guest.detail_loker');



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('beasiswa')->group(function () {
            Route::get('', [BeasiswaAdminController::class, 'index'])->name('admin.beasiswa');
            Route::get('tambah-beasiswa', [BeasiswaAdminController::class, 'create'])->name('admin.beasiswa.create');
            Route::post('tambah-beasiswa', [BeasiswaAdminController::class, 'store'])->name('admin.beasiswa.store');
            Route::get('edit-beasiswa/{id}', [BeasiswaAdminController::class, 'edit'])->name('admin.beasiswa.edit');
            Route::put('edit-beasiswa/{id}', [BeasiswaAdminController::class, 'update'])->name('admin.beasiswa.update');
            Route::delete('hapus-beasiswa/{id}', [BeasiswaAdminController::class, 'destroy'])->name('admin.beasiswa.destroy');
            Route::get('detail-beasiswa/{id}', [BeasiswaAdminController::class, 'show'])->name('admin.beasiswa.show');
        });
        Route::prefix('lomba')->group(function () {
            Route::get('', [LombaAdminController::class, 'index'])->name('admin.lomba');
            Route::get('tambah-lomba', [LombaAdminController::class, 'create'])->name('admin.lomba.create');
            Route::post('tambah-lomba', [LombaAdminController::class, 'store'])->name('admin.lomba.store');
            Route::get('edit-lomba/{id}', [LombaAdminController::class, 'edit'])->name('admin.lomba.edit');
            Route::put('edit-lomba/{id}', [LombaAdminController::class, 'update'])->name('admin.lomba.update');
            Route::delete('hapus-lomba/{id}', [LombaAdminController::class, 'destroy'])->name('admin.lomba.destroy');
            Route::get('detail-lomba/{id}', [LombaAdminController::class, 'show'])->name('admin.lomba.show');
      
        });
        Route::prefix('loker')->group(function () {
            Route::get('', [LokerAdminController::class, 'index'])->name('admin.loker');
            Route::get('tambah-loker', [LokerAdminController::class, 'create'])->name('admin.loker.create');
            Route::post('tambah-loker', [LokerAdminController::class, 'store'])->name('admin.loker.store');
            Route::get('edit-loker/{id}', [LokerAdminController::class, 'edit'])->name('admin.loker.edit');
            Route::put('edit-loker/{id}', [LokerAdminController::class, 'update'])->name('admin.loker.update');
            Route::delete('hapus-loker/{id}', [LokerAdminController::class, 'destroy'])->name('admin.loker.destroy');
            Route::get('detail-loker/{id}', [LokerAdminController::class, 'show'])->name('admin.loker.show');
        });
        Route::prefix('laporan')->group(function () {
            Route::get('', [LaporanAdminController::class, 'index'])->name('admin.laporan');
            Route::get('data-lomba', [LaporanAdminController::class, 'datalomba'])->name('admin.laporan.datalomba');
            Route::get('data-magang', [LaporanAdminController::class, 'dataloker'])->name('admin.laporan.dataloker');
            // Route::get('tambah-loker', [LokerUserController::class, 'create'])->name('user.loker.create');
        });
    });

    Route::prefix('user')->group(function () {
        Route::prefix('beasiswa')->group(function () {
            Route::get('', [BeasiswaUserController::class, 'index'])->name('user.beasiswa');
            Route::get('detail-beasiswa/{id}', [BeasiswaUserController::class, 'show'])->name('user.beasiswa.show');
            Route::post('user/beasiswa/update', [BeasiswaUserController::class, 'nambahbeasiswauser'])->name('user.beasiswa.update');
        });
        Route::prefix('lomba')->group(function () {
            Route::get('', [LombaUserController::class, 'index'])->name('user.lomba');
            Route::post('user/lomba/update', [LombaUserController::class, 'nambahlombauser'])->name('user.lomba.update');
            Route::get('detail-lomba/{id}', [LombaUserController::class, 'show'])->name('user.lomba.show');
      
        });
        Route::prefix('loker')->group(function () {
            Route::get('', [LokerUserController::class, 'index'])->name('user.loker');
            Route::get('detail-loker/{id}', [LokerUserController::class, 'show'])->name('user.loker.show');
            Route::post('user/loker/update', [LokerUserController::class, 'nambahlokeruser'])->name('user.loker.update');
        });
    });
});