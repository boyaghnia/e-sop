<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


    Route::get('/', function () {
        return view('login');
    });

    Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboardTampil'])->name('dashboard.tampil');
    Route::get('/dashboard/search', [DashboardController::class, 'dashboardSearch'])->name('dashboard.search');

    Route::get('/api', [ApiController::class, 'PanggilAPI'])->name('panggil.api');

    // ESOP Routes
    Route::get('/esop', [EsopController::class, 'esopTampil'])->name('esop.tampil');
    Route::get('/esop/search', [EsopController::class, 'esopSearch'])->name('esop.search');
    Route::get('/esop/tambah', [EsopController::class, 'esopTambah'])->name('esop.tambah');
    Route::post('/esop/simpan', [EsopController::class, 'esopSimpan'])->name('esop.simpan');
    Route::get('/esop/edit/{id}', [EsopController::class, 'esopEdit'])->name('esop.edit');
    Route::post('/esop/update/{id}', [EsopController::class, 'esopUpdate'])->name('esop.update');
    Route::delete('/esop/{id}', [EsopController::class, 'esopDelete'])->name('esop.delete');
    Route::get('/esop/flow/{id}', [EsopController::class, 'esopFlow'])->name('esop.flow');
    Route::post('/esop/flow/{id}', [EsopController::class, 'simpanFlow'])->name('esop.flow.simpan');
    Route::post('/esop/flow/update/{id}', [EsopController::class, 'updateFlow'])->name('flow.update');
    Route::post('/esop/lanjut/{id}', [EsopController::class, 'lanjutFlow'])->name('esop.lanjut.flow');
    Route::get('/esop/print/{id}', [EsopController::class, 'esopPrint'])->name('esop.print');
    Route::post('/esop/upload-file/{id}', [EsopController::class, 'uploadFile'])->name('esop.upload.file');

    Route::get('/faq', function () {
        return view('faq');
    });
    
    Route::get('/pedoman', function () {
        return view('pedoman');
    });

