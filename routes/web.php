<?php

use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

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

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/search', [MahasiswaController::class, 'search'])->name('search');

Route::get('mahasiswa/nilai/{id_mhs}', [MahasiswaController::class, 'nilai'])->name('mahasiswa.nilai');

Route::get('mahasiswa/nilai/{id_mhs}/cetak', [MahasiswaController::class, 'cetakKhs'])->name('mahasiswa.cetakKhs');

Route::get('/', function () {
    return view('welcome');
});
