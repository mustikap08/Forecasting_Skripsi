<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kategoriKontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\perhitunganController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');

Route::get('/register', [LoginController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::delete('/hapus-aktual/{id}', [DashboardController::class, 'destroy']);

Route::post('/create-user', [LoginController::class, 'store']);

Route::post('/login-user', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/kategori', [kategoriKontroller::class, 'index'])->middleware('auth');
Route::post('/simpan-kategori', [kategoriKontroller::class, 'store']);
Route::put('/edit-kategori/{id}', [kategoriKontroller::class, 'update']);

Route::post('simpan-aktual', [DashboardController::class, 'store']);
Route::put('/edit-aktual/{id}', [DashboardController::class, 'update']);

Route::get('/perhitungan', [perhitunganController::class, 'index'])->middleware('auth');
Route::post('/proses-hitung', [perhitunganController::class, 'store']);
Route::post('/rumus-altona', [perhitunganController::class, 'implementasiRumus']);
Route::delete('/hapus-hitung', [perhitunganController::class, 'destroy']);
Route::delete('/rumus-altona-reset', [perhitunganController::class, 'destroyRumus']);
Route::post('/tampilkan-forecasting', [perhitunganController::class, 'forecastRecord']);
Route::delete('/peramalan-delete', [perhitunganController::class, 'clearHasil']);
Route::get('/getData', [perhitunganController::class, 'getData']);
