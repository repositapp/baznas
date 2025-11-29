<?php

use App\Http\Controllers\AmilController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\BansosDonaturController;
use App\Http\Controllers\BansosPenyaluranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriupzController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\MuzakiController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\UpzController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZakatController;
use App\Models\Artikel;
use App\Models\Bansossaluran;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
// Artikel
Route::get('/kategori/{slug}', [ArtikelController::class, 'kategori'])->name('kategori');
Route::get('/artikel/detail/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');
// Program
Route::get('/program/{slug}', [BansosController::class, 'show'])->name('program.show');
Route::get('/donatur/{slug}', [BansosDonaturController::class, 'donaturCreate'])->name('donatur.create');
Route::post('/donatur', [BansosDonaturController::class, 'donaturStore'])->name('donatur.store');
Route::get('/donatur/upload/{id}', [BansosDonaturController::class, 'uploadBukti'])->name('donatur.upload');
Route::post('/donatur/upload/{id}', [BansosDonaturController::class, 'storeBukti'])->name('donatur.upload.store');
Route::get('/donatur/invoice/{id}', [BansosDonaturController::class, 'invoice'])->name('donatur.invoice');
// Layanan
Route::get('/rekening', [BankController::class, 'show'])->name('rekening.show');
Route::get('/kalkulator', [BankController::class, 'kalkulator'])->name('kalkulator.show');
Route::get('/upz', [UpzController::class, 'show'])->name('upz.show');
// Laporan
Route::get('/laporan', [LaporanController::class, 'show'])->name('laporan.show');
Route::get('/laporan/download/{id}', [LaporanController::class, 'download'])->name('laporan.download');
// Kontak
Route::get('/kontak', [AplikasiController::class, 'kontakIndex'])->name('kontak.index');
// Pembayaran Zakat
Route::get('/bayarzakat', [PembayaranController::class, 'bayarZakatCreate'])->name('bayarzakat.index');
Route::post('/bayarzakat', [PembayaranController::class, 'bayarZakatStore'])->name('bayarzakat.store');
Route::get('/bayarzakat/upload/{id}', [PembayaranController::class, 'uploadBukti'])->name('bayarzakat.upload');
Route::post('/bayarzakat/upload/{id}', [PembayaranController::class, 'storeBukti'])->name('bayarzakat.upload.store');
Route::get('/bayarzakat/invoice/{id}', [PembayaranController::class, 'invoice'])->name('bayarzakat.invoice');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authentication', [AuthController::class, 'authenticate'])->name('authentication');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Master Data
    Route::resource('upz', UpzController::class)->except(['show']);
    Route::resource('amil', AmilController::class)->except(['show']);
    Route::resource('laporan', LaporanController::class)->except(['show']);
    Route::get('/laporan/download/{id}', [LaporanController::class, 'download'])->name('laporan.download');
    Route::resource('muzaki', MuzakiController::class)->except(['show']);
    Route::resource('mustahik', MustahikController::class)->except(['show']);
    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class)->except(['show']);
    Route::get('/pembayaran/zakat/{id}', [PembayaranController::class, 'zakat']);
    // Penyaluran
    Route::resource('penyaluran', PenyaluranController::class)->except(['show']);
    Route::get('/penyaluran/mustahik/{id}', [PenyaluranController::class, 'mustahik']);
    Route::get('/penyaluran/zakat/{id}', [PenyaluranController::class, 'zakat']);
    // Bantuan Sosial
    Route::resource('program', BansosController::class)->except(['show']);
    Route::get('/program/donatur/{id}', [BansosController::class, 'daftarDonatur'])->name('program.donatur');
    Route::resource('bansos-penyaluran', BansosPenyaluranController::class)->except(['show']);
    // Artikel
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    // Modul
    Route::resource('halaman', HalamanController::class)->except(['show']);
    Route::resource('menu', MenuController::class)->except(['show']);
    Route::get('/menu/load-targets', [MenuController::class, 'loadTargets'])->name('menu.target');
    // Pelaporan
    Route::get('pelaporan/pembayaran-zakat', [PelaporanController::class, 'pembayaranIndex'])->name('pelaporan.pembayaran');
    Route::get('pelaporan/pembayaran-zakat/data', [PelaporanController::class, 'getPembayaranData'])->name('pelaporan.pembayaran.data');
    Route::get('pelaporan/pembayaran-zakat/cetak', [PelaporanController::class, 'cetakPembayaran'])->name('pelaporan.pembayaran.cetak');
    Route::get('pelaporan/penyaluran-zakat', [PelaporanController::class, 'penyaluran'])->name('pelaporan.penyaluran');
    Route::get('pelaporan/penyaluran-zakat/data', [PelaporanController::class, 'penyaluranData'])->name('pelaporan.penyaluran.data');
    Route::get('pelaporan/penyaluran-zakat/cetak', [PelaporanController::class, 'cetakPenyaluran'])->name('pelaporan.penyaluran.cetak');
    // Settings
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('bank', BankController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('kategori_upz', KategoriupzController::class)->except(['show']);
    Route::resource('golongan_mustahik', GolonganController::class)->except(['show']);
    Route::resource('zakat', ZakatController::class)->except(['show']);
    Route::resource('aplikasi', AplikasiController::class)->except(['show', 'create', 'store', 'destroy', 'edit']);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/{slug}', [MenuController::class, 'show'])->name('menu.show');
