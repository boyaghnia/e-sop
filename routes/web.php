<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsopController;
use App\Http\Controllers\AuthController;


    Route::get('/', function () {
        return view('login');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth');

    Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/sekretariat/perencanaan', [EsopController::class, 'perencanaanTampil'])->name('perencanaan.tampil');

    Route::get('/esop', [EsopController::class, 'esopTampil'])->name('esop.tampil');
    Route::get('/esop/tambah', [EsopController::class, 'esopTambah'])->name('esop.tambah');
    Route::post('/esop/simpan', [EsopController::class, 'esopSimpan'])->name('esop.simpan');
    Route::get('/esop/edit/{id}', [EsopController::class, 'esopEdit'])->name('esop.edit');
    Route::post('/esop/update/{id}', [EsopController::class, 'esopUpdate'])->name('esop.update');
    Route::delete('/esop/{id}', [EsopController::class, 'esopDelete'])->name('esop.delete');
    Route::get('/esop/flow/{id}', [EsopController::class, 'esopFlow'])->name('esop.flow');
    Route::post('/esop/flow/{id}', [EsopController::class, 'simpanFlow'])->name('esop.flow.simpan');
    Route::post('/esop/flow/update/{id}', [EsopController::class, 'updateFlow'])->name('flow.update');
    Route::post('/esop/lanjut/{id}', [EsopController::class, 'lanjutFlow'])->name('esop.lanjut.flow');

