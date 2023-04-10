<?php

use App\Http\Controllers\PegadaianController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [PegadaianController::class, "index"])->name('landing');
Route::post('/store', [PegadaianController::class, "store"])->name('store');
Route::post('/auth', [PegadaianController::class, "auth"])->name('auth');
Route::get('/login', function () {
    return view('login');
})->name('login');


Route::middleware(['isLogin', 'CekRole:admin'])->group(function() {
    Route::get('/data', [PegadaianController::class, "data"])->name('data');
    Route::get('/export/pdf', [PegadaianController::class, "exportPDF"])->name('export-pdf');
    Route::get('/export/excel', [PegadaianController::class, "exportExcel"])->name('export.excel');
});

Route::middleware(['isLogin', 'CekRole:admin,petugas'])->group(function() {
    Route::get('/logout', [PegadaianController::class, "logout"])->name('logout');
});

Route::middleware(['isLogin', 'CekRole:petugas'])->group(function() {
    Route::get('/response-page', [PegadaianController::class, "dashboard"])->name('dashboard');
    Route::get('/response-status', [PegadaianController::class, "dashboard_status"])->name('dashboard_status');
    Route::get('/response/edit/{pegadaian_id}', [ResponseController::class, "edit"])->name('response.edit');
    Route::patch('/response/update/{pegadaian_id}', [ResponseController::class, 'update'])->name('response.update');
});
