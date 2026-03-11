<?php

use App\Http\Controllers\AkSENController;
use App\Http\Controllers\ArtikelInovasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CaintController;
use App\Http\Controllers\CareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProdukInovasiController;
use App\Http\Controllers\ProdukUnggulanController;
use App\Http\Controllers\PudewiController;
use App\Http\Controllers\PutoiController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\TentangController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Beranda submenu
Route::get('/artikel-inovasi', [ArtikelInovasiController::class, 'index'])->name('artikel-inovasi.index');
Route::get('/artikel-inovasi/{slug}', [ArtikelInovasiController::class, 'show'])->name('artikel-inovasi.show');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');

// Tentang
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');
Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.index');
Route::get('/pimpinan/{slug}', [PimpinanController::class, 'show'])->name('pimpinan.show');
Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');
Route::get('/struktur-organisasi/{slug}', [StrukturOrganisasiController::class, 'show'])->name('struktur-organisasi.show');

// Produk
Route::get('/produk-unggulan', [ProdukUnggulanController::class, 'index'])->name('produk-unggulan.index');
Route::get('/produk-unggulan/{slug}', [ProdukUnggulanController::class, 'show'])->name('produk-unggulan.show');

Route::get('/produk-inovasi', [ProdukInovasiController::class, 'index'])->name('produk-inovasi.index');
Route::get('/produk-inovasi/{slug}', [ProdukInovasiController::class, 'show'])->name('produk-inovasi.show');

//PUTOI - Index Profil
Route::get('/putoi', [PutoiController::class, 'index'])->name('putoi.index');

//CARE - Index Prodil
Route::get('/care', [CareController::class, 'index'])->name('care.index');

//PUDEWI - Index Profil
Route::get('/pudewi', [PudewiController::class, 'index'])->name('pudewi.index');

// CAINT - Index profil
Route::get('/pu', [CaintController::class, 'index'])->name('caint.index');

// CAINT - Per kategori index
Route::get('/caint/smart-campus', [CaintController::class, 'smartCampus'])->name('caint.smart-campus.index');
Route::get('/caint/green-energy', [CaintController::class, 'greenEnergy'])->name('caint.green-energy.index');
Route::get('/caint/industrial-automation', [CaintController::class, 'industrialAutomation'])->name('caint.industrial-automation.index');
Route::get('/caint/agriculture-environment', [CaintController::class, 'agricultureEnvironment'])->name('caint.agriculture-environment.index');
Route::get('/caint/healthcare', [CaintController::class, 'healthcare'])->name('caint.healthcare.index');

// CAINT - Show produk per kategori
Route::get('/caint/smart-campus/{slug}', [CaintController::class, 'show'])->name('caint.smart-campus.show');
Route::get('/caint/green-energy/{slug}', [CaintController::class, 'show'])->name('caint.green-energy.show');
Route::get('/caint/industrial-automation/{slug}', [CaintController::class, 'show'])->name('caint.industrial-automation.show');
Route::get('/caint/agriculture-environment/{slug}', [CaintController::class, 'show'])->name('caint.agriculture-environment.show');
Route::get('/caint/healthcare/{slug}', [CaintController::class, 'show'])->name('caint.healthcare.show');

//AkSEN - Index Profil
Route::get('/aksen', [AkSENController::class, 'index'])->name('aksen.index');

// Sertifikasi
Route::get('/sertifikasi', [SertifikasiController::class, 'index'])->name('sertifikasi.index');
Route::get('/sertifikasi/{slug}', [SertifikasiController::class, 'show'])->name('sertifikasi.show');

// Hubungi Kami
Route::get('/hubungi-kami', [HubungiKamiController::class, 'index'])->name('hubungi-kami');
