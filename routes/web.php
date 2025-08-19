<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\CalonSiswaController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Halaman daftar calon siswa
    Route::get('/calon-siswa', [CalonSiswaController::class, 'index'])->name('calonsiswa.index');

    // Simpan data baru
    Route::post('/calon-siswa', [CalonSiswaController::class, 'store'])->name('calonsiswa.store');

    // Update data
    Route::put('/calon-siswa/{id}', [CalonSiswaController::class, 'update'])->name('calonsiswa.update');

    // Hapus data
    Route::delete('/calon-siswa/{id}', [CalonSiswaController::class, 'destroy'])->name('calonsiswa.destroy');


    Route::get('/admin/calonsiswa/create', [CalonSiswaController::class, 'create'])->name('admin.calonsiswa.create');
});

use App\Http\Controllers\BeritaController;

Route::prefix('admin')->group(function () {
    // Tampilkan semua berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

    // Form tambah berita
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');

    // Simpan berita
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');

    // Form edit berita
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');

    // Update berita
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');

    // Hapus berita
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

use App\Http\Controllers\DataGuruController;

Route::prefix('admin')->group(function () {

    // Tampilkan semua data guru
    Route::get('/admin/data-guru', [DataGuruController::class, 'index'])->name('admin.data-guru.index');

    // Form tambah data guru
    Route::get('/admin/data-guru/create', [DataGuruController::class, 'create'])->name('admin.data-guru.create');

    // Simpan data guru baru
    Route::post('/admin/data-guru', [DataGuruController::class, 'store'])->name('admin.data-guru.store');

    // Form edit data guru
    Route::get('/admin/data-guru/{id}/edit', [DataGuruController::class, 'edit'])->name('admin.data-guru.edit');

    // Update data guru
    Route::put('/admin/data-guru/{id}', [DataGuruController::class, 'update'])->name('admin.data-guru.update');

    // Hapus data guru
    Route::delete('/admin/data-guru/{id}', [DataGuruController::class, 'destroy'])->name('admin.data-guru.destroy');
});

use App\Http\Controllers\GaleriKegiatanController;

// Tampilkan semua galeri
Route::get('/admin/galeri-kegiatan', [GaleriKegiatanController::class, 'index'])->name('admin.galeri-kegiatan.index');

// Form tambah galeri
Route::get('/admin/galeri-kegiatan/create', [GaleriKegiatanController::class, 'create'])->name('admin.galeri-kegiatan.create');

// Simpan galeri baru
Route::post('/admin/galeri-kegiatan', [GaleriKegiatanController::class, 'store'])->name('admin.galeri-kegiatan.store');

// Form edit galeri
Route::get('/admin/galeri-kegiatan/{id}/edit', [GaleriKegiatanController::class, 'edit'])->name('admin.galeri-kegiatan.edit');

// Update galeri
Route::put('/admin/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'update'])->name('admin.galeri-kegiatan.update');

// Hapus galeri
Route::delete('/admin/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'destroy'])->name('admin.galeri-kegiatan.destroy');

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

// Tampilkan semua prestasi siswa
Route::get('/admin/prestasi-siswa', [PrestasiSiswaController::class, 'index'])->name('admin.prestasi-siswa.index');

// Form tambah prestasi siswa
Route::get('/admin/prestasi-siswa/create', [PrestasiSiswaController::class, 'create'])->name('admin.prestasi-siswa.create');

// Simpan prestasi siswa baru
Route::post('/admin/prestasi-siswa', [PrestasiSiswaController::class, 'store'])->name('admin.prestasi-siswa.store');

// Form edit prestasi siswa
Route::get('/admin/prestasi-siswa/{id}/edit', [PrestasiSiswaController::class, 'edit'])->name('admin.prestasi-siswa.edit');

// Update prestasi siswa
Route::put('/admin/prestasi-siswa/{id}', [PrestasiSiswaController::class, 'update'])->name('admin.prestasi-siswa.update');

// Hapus prestasi siswa
Route::delete('/admin/prestasi-siswa/{id}', [PrestasiSiswaController::class, 'destroy'])->name('admin.prestasi-siswa.destroy');

use App\Http\Controllers\SaranaPrasaranaController;

// Tampilkan semua sarana prasarana
Route::get('/admin/sarana-prasarana', [SaranaPrasaranaController::class, 'index'])->name('admin.sarana-prasarana.index');

// Form tambah sarana prasarana
Route::get('/admin/sarana-prasarana/create', [SaranaPrasaranaController::class, 'create'])->name('admin.sarana-prasarana.create');

// Simpan sarana prasarana baru
Route::post('/admin/sarana-prasarana', [SaranaPrasaranaController::class, 'store'])->name('admin.sarana-prasarana.store');

// Form edit sarana prasarana
Route::get('/admin/sarana-prasarana/{id}/edit', [SaranaPrasaranaController::class, 'edit'])->name('admin.sarana-prasarana.edit');

// Update sarana prasarana
Route::put('/admin/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'update'])->name('admin.sarana-prasarana.update');

// Hapus sarana prasarana
Route::delete('/admin/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'destroy'])->name('admin.sarana-prasarana.destroy');


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


use App\Http\Controllers\AuthController;

// Form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\AdminDashboardController;

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
