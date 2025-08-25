<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\CalonSiswaController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Daftar calon siswa & form tambah
    Route::get('/calonsiswa', [CalonSiswaController::class, 'index'])->name('calonsiswa.index');

    // Simpan data baru
    Route::post('/calonsiswa', [CalonSiswaController::class, 'store'])->name('calonsiswa.store');

    // Form edit calon siswa
    Route::get('/calonsiswa/{id}/edit', [CalonSiswaController::class, 'edit'])->name('calonsiswa.edit');

    // Update data
    Route::put('/calonsiswa/{id}', [CalonSiswaController::class, 'update'])->name('calonsiswa.update');

    // Hapus data
    Route::delete('/calonsiswa/{id}', [CalonSiswaController::class, 'destroy'])->name('calonsiswa.destroy');
});





use App\Http\Controllers\DataGuruController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dataguru', [DataGuruController::class, 'index'])->name('dataguru.index');
    Route::post('/dataguru', [DataGuruController::class, 'store'])->name('dataguru.store');
    Route::get('/dataguru/{id}/edit', [DataGuruController::class, 'edit'])->name('dataguru.edit');
    Route::put('/dataguru/{id}', [DataGuruController::class, 'update'])->name('dataguru.update');
    Route::delete('/dataguru/{id}', [DataGuruController::class, 'destroy'])->name('dataguru.destroy');
});


use App\Http\Controllers\GaleriKegiatanController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/galeri-kegiatan', [GaleriKegiatanController::class, 'index'])->name('galerikegiatan.index');
    Route::post('/galeri-kegiatan', [GaleriKegiatanController::class, 'store'])->name('galerikegiatan.store');
    Route::get('/galeri-kegiatan/{id}/edit', [GaleriKegiatanController::class, 'edit'])->name('galerikegiatan.edit');
    Route::put('/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'update'])->name('galerikegiatan.update');
    Route::delete('/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'destroy'])->name('galerikegiatan.destroy');
});

use App\Http\Controllers\KritikSaranController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritiksaran.index');
    Route::get('/kritik-saran/create', [KritikSaranController::class, 'create'])->name('kritiksaran.create');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritiksaran.store');
    Route::get('/kritik-saran/{id}/edit', [KritikSaranController::class, 'edit'])->name('kritiksaran.edit');
    Route::put('/kritik-saran/{id}', [KritikSaranController::class, 'update'])->name('kritiksaran.update');
    Route::delete('/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('kritiksaran.destroy');
});


use App\Http\Controllers\PendidikanController;

// Route untuk admin pendidikan
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pendidikan', PendidikanController::class);
});

use App\Http\Controllers\PrestasiSiswaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/prestasisiswa', [PrestasiSiswaController::class, 'index'])->name('prestasisiswa.index');
    Route::post('/prestasisiswa', [PrestasiSiswaController::class, 'store'])->name('prestasisiswa.store');
    Route::get('/prestasisiswa/{id}/edit', [PrestasiSiswaController::class, 'edit'])->name('prestasisiswa.edit');
    Route::put('/prestasisiswa/{id}', [PrestasiSiswaController::class, 'update'])->name('prestasisiswa.update');
    Route::delete('/prestasisiswa/{id}', [PrestasiSiswaController::class, 'destroy'])->name('prestasisiswa.destroy');
});

use App\Http\Controllers\SaranaPrasaranaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/sarana-prasarana', [SaranaPrasaranaController::class, 'index'])->name('saranaprasarana.index');
    Route::post('/sarana-prasarana', [SaranaPrasaranaController::class, 'store'])->name('saranaprasarana.store');
    Route::get('/sarana-prasarana/{id}/edit', [SaranaPrasaranaController::class, 'edit'])->name('saranaprasarana.edit');
    Route::put('/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'update'])->name('saranaprasarana.update');
    Route::delete('/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'destroy'])->name('saranaprasarana.destroy');
});


use App\Http\Controllers\SejarahController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('sejarah', SejarahController::class);
});

use App\Http\Controllers\VisiMisiController;

// Group route admin visi misi
Route::prefix('admin')->group(function () {
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visimisi.index');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('admin.visimisi.store');
    Route::put('/visi-misi/{id}', [VisiMisiController::class, 'update'])->name('admin.visimisi.update');
    Route::delete('/visi-misi/{id}', [VisiMisiController::class, 'destroy'])->name('admin.visimisi.destroy');
});

use App\Http\Controllers\SeleksiSiswaController;

Route::prefix('admin')->group(function () {
    Route::get('/seleksi-siswa', [SeleksiSiswaController::class, 'index'])->name('admin.seleksisiswa.index');
    Route::get('/seleksi-siswa/{id}/edit', [SeleksiSiswaController::class, 'edit'])->name('admin.seleksisiswa.edit');
    Route::put('/seleksi-siswa/{id}', [SeleksiSiswaController::class, 'update'])->name('admin.seleksisiswa.update');
    Route::delete('/seleksi-siswa/{id}', [SeleksiSiswaController::class, 'destroy'])->name('admin.seleksisiswa.destroy');
    Route::post('/seleksi-siswa/{id}/update-status', [SeleksiSiswaController::class, 'updateStatus'])
    ->name('admin.seleksisiswa.updateStatus');
});

use App\Http\Controllers\DataSiswaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/datasiswa', [DataSiswaController::class, 'index'])->name('datasiswa.index');
    Route::get('/datasiswa/{id}/edit', [DataSiswaController::class, 'edit'])->name('datasiswa.edit');
    Route::put('/datasiswa/{id}', [DataSiswaController::class, 'update'])->name('datasiswa.update');
    Route::delete('/datasiswa/{id}', [DataSiswaController::class, 'destroy'])->name('datasiswa.destroy');

    // Export per siswa
    Route::get('/datasiswa/{id}/export', [DataSiswaController::class, 'export'])->name('datasiswa.export');
    
    // Export semua siswa
    Route::get('/datasiswa/export-all', [DataSiswaController::class, 'exportAll'])->name('datasiswa.export.all');
    Route::get('/datasiswa/cetak', [DataSiswaController::class, 'cetak'])->name('datasiswa.cetak');
});


use App\Http\Controllers\AuthController;

// Form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\AdminDashboardController;

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/dashboard/content', [AdminDashboardController::class, 'dashboardContent'])->name('admin.dashboard-content');

use App\Http\Controllers\BeritaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');       // Tampilkan daftar
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create'); // Form tambah
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');       // Simpan data baru
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit'); // Form edit
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');  // Update data
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy'); // Hapus
});
