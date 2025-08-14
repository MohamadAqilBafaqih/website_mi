<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\CalonSiswaController;

Route::prefix('admin')->group(function () {
    Route::get('/calon_siswa', [CalonSiswaController::class, 'index'])->name('calon_siswa.index');
    Route::get('/calon_siswa/create', [CalonSiswaController::class, 'create'])->name('calon_siswa.create');
    Route::post('/calon_siswa', [CalonSiswaController::class, 'store'])->name('calon_siswa.store');
    Route::get('/calon_siswa/{id}/edit', [CalonSiswaController::class, 'edit'])->name('calon_siswa.edit');
    Route::put('/calon_siswa/{id}', [CalonSiswaController::class, 'update'])->name('calon_siswa.update');
    Route::delete('/calon_siswa/{id}', [CalonSiswaController::class, 'destroy'])->name('calon_siswa.destroy');
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

// Tampilkan semua kritik & saran
Route::get('/admin/kritik-saran', [KritikSaranController::class, 'index'])->name('admin.kritik-saran.index');

// Form tambah kritik & saran
Route::get('/admin/kritik-saran/create', [KritikSaranController::class, 'create'])->name('admin.kritik-saran.create');

// Simpan kritik & saran baru
Route::post('/admin/kritik-saran', [KritikSaranController::class, 'store'])->name('admin.kritik-saran.store');

// Form edit kritik & saran
Route::get('/admin/kritik-saran/{id}/edit', [KritikSaranController::class, 'edit'])->name('admin.kritik-saran.edit');

// Update kritik & saran
Route::put('/admin/kritik-saran/{id}', [KritikSaranController::class, 'update'])->name('admin.kritik-saran.update');

// Hapus kritik & saran
Route::delete('/admin/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('admin.kritik-saran.destroy');


use App\Http\Controllers\PendidikanController;

// Tampilkan semua pendidikan
Route::get('/admin/pendidikan', [PendidikanController::class, 'index'])->name('admin.pendidikan.index');

// Form tambah pendidikan
Route::get('/admin/pendidikan/create', [PendidikanController::class, 'create'])->name('admin.pendidikan.create');

// Simpan pendidikan baru
Route::post('/admin/pendidikan', [PendidikanController::class, 'store'])->name('admin.pendidikan.store');

// Form edit pendidikan
Route::get('/admin/pendidikan/{id}/edit', [PendidikanController::class, 'edit'])->name('admin.pendidikan.edit');

// Update pendidikan
Route::put('/admin/pendidikan/{id}', [PendidikanController::class, 'update'])->name('admin.pendidikan.update');

// Hapus pendidikan
Route::delete('/admin/pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('admin.pendidikan.destroy');


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

// Tampilkan semua sejarah
Route::get('/admin/sejarah', [SejarahController::class, 'index'])->name('admin.sejarah.index');

// Form tambah sejarah
Route::get('/admin/sejarah/create', [SejarahController::class, 'create'])->name('admin.sejarah.create');

// Simpan sejarah baru
Route::post('/admin/sejarah', [SejarahController::class, 'store'])->name('admin.sejarah.store');

// Form edit sejarah
Route::get('/admin/sejarah/{id}/edit', [SejarahController::class, 'edit'])->name('admin.sejarah.edit');

// Update sejarah
Route::put('/admin/sejarah/{id}', [SejarahController::class, 'update'])->name('admin.sejarah.update');

// Hapus sejarah
Route::delete('/admin/sejarah/{id}', [SejarahController::class, 'destroy'])->name('admin.sejarah.destroy');

use App\Http\Controllers\VisiMisiController;

// Tampilkan semua visi & misi
Route::get('/admin/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visi-misi.index');

// Form tambah visi & misi
Route::get('/admin/visi-misi/create', [VisiMisiController::class, 'create'])->name('admin.visi-misi.create');

// Simpan visi & misi baru
Route::post('/admin/visi-misi', [VisiMisiController::class, 'store'])->name('admin.visi-misi.store');

// Form edit visi & misi
Route::get('/admin/visi-misi/{id}/edit', [VisiMisiController::class, 'edit'])->name('admin.visi-misi.edit');

// Update visi & misi
Route::put('/admin/visi-misi/{id}', [VisiMisiController::class, 'update'])->name('admin.visi-misi.update');

// Hapus visi & misi
Route::delete('/admin/visi-misi/{id}', [VisiMisiController::class, 'destroy'])->name('admin.visi-misi.destroy');
