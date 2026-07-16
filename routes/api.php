<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\HeroSliderController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\DataAplikasiController;
use App\Http\Controllers\Api\HalamanStatisController;
use App\Http\Controllers\Api\DokumenController;
use App\Http\Controllers\Api\OpdController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\VidioController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\InformasiLayananController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\PollingController;
use App\Http\Controllers\Api\KritikSaranController;
use App\Http\Controllers\Api\TteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hero-sliders', [HeroSliderController::class, 'index']);


// ===== Modul Berita =====
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita-popular', [BeritaController::class, 'popular']);
Route::get('/berita/kategori/{slug}', [BeritaController::class, 'byKategori']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);
Route::get('/berita-latest', [BeritaController::class, 'latest']);

// Kategori Berita
Route::get('/kategori-berita', [App\Http\Controllers\Api\KategoriBeritaController::class, 'index']);

// ===== Modul Pengumuman =====
Route::get('/pengumuman', [PengumumanController::class, 'index']);
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show']);

// ===== Modul Banner =====
Route::get('/banner', [BannerController::class, 'index']);
Route::get('/banner/{kategori}', [BannerController::class, 'byKategori']);

// Modul data-aplikasi
Route::get('/data-aplikasi', [DataAplikasiController::class, 'index']);
Route::get('/data-aplikasi/{id}', [DataAplikasiController::class, 'show']);

//  modul halman stastis
Route::get('/halaman-statis', [HalamanStatisController::class, 'index']);
Route::get('/halaman-statis/{slug}', [HalamanStatisController::class, 'show']);

// mMODUL DOKUMENT
Route::get('/dokumen', [DokumenController::class, 'index']);
Route::get('/dokumen/{slug}', [DokumenController::class, 'show']);
Route::get('/kategori-dokumen/{slug}/dokumen', [DokumenController::class, 'byKategori']);

// data opd
Route::get('/opds', [OpdController::class, 'index']);
Route::get('/opds/{slug}', [OpdController::class, 'show']);


Route::get('/kritik-saran', [KritikSaranController::class, 'index']);
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->middleware('throttle:5,1');
// modul foto
Route::get('/fotos', [FotoController::class, 'index']);
Route::get('/fotos/{id}', [FotoController::class, 'show']);

// modul vidio
Route::get('/vidios', [VidioController::class, 'index']);
Route::get('/vidios/{id}', [VidioController::class, 'show']);

// modul kecamatan
Route::get('/kecamatan', [KecamatanController::class, 'index']);
Route::get('/kecamatan/{slug}', [KecamatanController::class, 'show']);

// data informasi layanan
Route::get('/kategori-layanan', [\App\Http\Controllers\Api\KategoriLayananController::class, 'index']);
Route::get('/layanan/kategori/{slug}', [InformasiLayananController::class, 'byKategori']);
Route::get('/layanan', [InformasiLayananController::class, 'index']);
Route::get('/layanan/{slug}', [InformasiLayananController::class, 'show']);

//data agenda
Route::get('/agendas', [AgendaController::class, 'index']);
Route::get('/agendas/{id}', [AgendaController::class, 'show']);


// data menu
Route::get('/menus/{type}', [MenuController::class, 'index']);
use App\Http\Controllers\Api\PejabatController;
use App\Http\Controllers\Api\ProfilDaerahController;

// Modul Settings
Route::get('/settings/header', [SettingsController::class, 'headerData']);
Route::get('/settings/footer', [SettingsController::class, 'footerData']);

// Modul Pejabat
Route::get('/pejabat', [PejabatController::class, 'index']);
Route::get('/pejabat/{id}', [PejabatController::class, 'show']);

// Modul Profil Daerah
Route::get('/profil-daerah', [ProfilDaerahController::class, 'index']);

// Modul pencarian
Route::get('/search', [SearchController::class, 'search']);



Route::get('/polling', [PollingController::class, 'index']);
Route::post('/polling/vote', [PollingController::class, 'vote'])->middleware('throttle:10,1');

// Modul SPON TTE
Route::get('/spon-tte/info', [TteController::class, 'getInfo']);
Route::post('/spon-tte/register', [TteController::class, 'register'])->middleware('throttle:5,1');
Route::post('/spon-tte/feedback', [TteController::class, 'feedback'])->middleware('throttle:5,1');

Route::post('/ppid/request', [App\Http\Controllers\Api\PpidController::class, 'storeRequest'])->middleware('throttle:5,1');
Route::post('/ppid/objection', [App\Http\Controllers\Api\PpidController::class, 'storeObjection'])->middleware('throttle:5,1');
Route::post('/ppid/check-status', [App\Http\Controllers\Api\PpidController::class, 'checkStatus'])->middleware('throttle:20,1');
Route::get('/spon-tte/check-status', [TteController::class, 'checkStatus'])->middleware('throttle:20,1');
