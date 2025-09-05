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

// Form daftar PPDB
Route::get('/pendaftaran', [CalonSiswaController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [CalonSiswaController::class, 'storeUser'])->name('pendaftaran.storeUser');
// Halaman sukses
Route::get('/pendaftaran/success', function () {
    return view('pengguna.pendaftaran.success');
})->name('pendaftaran.success');





use App\Http\Controllers\DataGuruController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dataguru', [DataGuruController::class, 'index'])->name('dataguru.index');
    Route::post('/dataguru', [DataGuruController::class, 'store'])->name('dataguru.store');
    Route::get('/dataguru/{id}/edit', [DataGuruController::class, 'edit'])->name('dataguru.edit');
    Route::put('/dataguru/{id}', [DataGuruController::class, 'update'])->name('dataguru.update');
    Route::delete('/dataguru/{id}', [DataGuruController::class, 'destroy'])->name('dataguru.destroy');
});

Route::get('/guru', [DataGuruController::class, 'showGuru'])->name('pengguna.dataguru');


use App\Http\Controllers\GaleriKegiatanController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/galeri-kegiatan', [GaleriKegiatanController::class, 'index'])->name('galerikegiatan.index');
    Route::post('/galeri-kegiatan', [GaleriKegiatanController::class, 'store'])->name('galerikegiatan.store');
    Route::get('/galeri-kegiatan/{id}/edit', [GaleriKegiatanController::class, 'edit'])->name('galerikegiatan.edit');
    Route::put('/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'update'])->name('galerikegiatan.update');
    Route::delete('/galeri-kegiatan/{id}', [GaleriKegiatanController::class, 'destroy'])->name('galerikegiatan.destroy');
});

use App\Http\Controllers\KritikSaranController;
use App\Models\KritikSaran;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritiksaran.index');
    Route::get('/kritik-saran/create', [KritikSaranController::class, 'create'])->name('kritiksaran.create');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritiksaran.store');
    Route::get('/kritik-saran/{id}/edit', [KritikSaranController::class, 'edit'])->name('kritiksaran.edit');
    Route::put('/kritik-saran/{id}', [KritikSaranController::class, 'update'])->name('kritiksaran.update');
    Route::delete('/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->name('kritiksaran.destroy');
});

Route::get('/saran-masukan', [KritikSaranController::class, 'indexPengguna'])
    ->name('pengguna.saranmasukan.index');

// Route untuk simpan data saran & masukan
Route::post('/saran-masukan', [KritikSaranController::class, 'store'])->name('pengguna.saranmasukan.store');

use App\Http\Controllers\PendidikanController;

// Route untuk admin pendidikan
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pendidikan', PendidikanController::class);
});

Route::get('/profil/pendidikan', [PendidikanController::class, 'showPendidikan'])
    ->name('pengguna.pendidikan');

use App\Http\Controllers\PrestasiSiswaController;
use App\Models\PrestasiSiswa;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/prestasisiswa', [PrestasiSiswaController::class, 'index'])->name('prestasisiswa.index');
    Route::post('/prestasisiswa', [PrestasiSiswaController::class, 'store'])->name('prestasisiswa.store');
    Route::get('/prestasisiswa/{id}/edit', [PrestasiSiswaController::class, 'edit'])->name('prestasisiswa.edit');
    Route::put('/prestasisiswa/{id}', [PrestasiSiswaController::class, 'update'])->name('prestasisiswa.update');
    Route::delete('/prestasisiswa/{id}', [PrestasiSiswaController::class, 'destroy'])->name('prestasisiswa.destroy');
});

// routes/web.php
Route::get('/prestasi', [PrestasiSiswaController::class, 'showAll'])->name('pengguna.prestasi.index');
Route::get('/prestasi/{id}', [PrestasiSiswaController::class, 'show'])->name('pengguna.prestasi.show');

use App\Http\Controllers\SaranaPrasaranaController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/sarana-prasarana', [SaranaPrasaranaController::class, 'index'])->name('saranaprasarana.index');
    Route::post('/sarana-prasarana', [SaranaPrasaranaController::class, 'store'])->name('saranaprasarana.store');
    Route::get('/sarana-prasarana/{id}/edit', [SaranaPrasaranaController::class, 'edit'])->name('saranaprasarana.edit');
    Route::put('/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'update'])->name('saranaprasarana.update');
    Route::delete('/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'destroy'])->name('saranaprasarana.destroy');
});

Route::get('/sarana-prasarana', [SaranaPrasaranaController::class, 'showSaranaPrasarana'])->name('pengguna.saranaprasarana');


use App\Http\Controllers\SejarahController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('sejarah', SejarahController::class);
});

Route::get('/sejarah', [SejarahController::class, 'showSejarah'])->name('pengguna.sejarah');


use App\Http\Controllers\VisiMisiController;

// Group route admin visi misi
Route::prefix('admin')->group(function () {
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visimisi.index');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('admin.visimisi.store');
    Route::put('/visi-misi/{id}', [VisiMisiController::class, 'update'])->name('admin.visimisi.update');
    Route::delete('/visi-misi/{id}', [VisiMisiController::class, 'destroy'])->name('admin.visimisi.destroy');
});

Route::get('/visimisi', [VisiMisiController::class, 'showVisiMisi'])->name('pengguna.visimisi');

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

Route::prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/berita', [BeritaController::class, 'showAll'])->name('berita.index');
    Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
});


Route::prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/galeri', [GaleriKegiatanController::class, 'showAll'])->name('galeri.index');
    Route::get('/galeri/{id}', [GaleriKegiatanController::class, 'show'])->name('galeri.show');
});

use App\Http\Controllers\BerandaController;

// Prefix untuk pengguna
Route::prefix('pengguna')->group(function () {
    Route::get('/', [BerandaController::class, 'index'])->name('pengguna.beranda-content');
});

// Biar root "/" tetap mengarah ke beranda pengguna
Route::get('/', function () {
    return redirect()->route('pengguna.beranda-content');
});

use App\Http\Controllers\TestimoniController;


// Untuk pengguna
Route::get('/testimoni', [TestimoniController::class, 'indexPengguna'])
    ->name('pengguna.kontak.testimoni.index');
Route::post('/testimoni', [TestimoniController::class, 'store'])
    ->name('pengguna.kontak.testimoni.store');

// ================== ROUTE UNTUK ADMIN ==================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
    Route::get('/testimoni/{id}/edit', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::put('/testimoni/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::delete('/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
});


use App\Http\Controllers\InfoPpdbController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/infoppdb', [InfoPpdbController::class, 'index'])->name('infoppdb.index');
    Route::get('/infoppdb/create', [InfoPpdbController::class, 'create'])->name('infoppdb.create');
    Route::post('/infoppdb', [InfoPpdbController::class, 'store'])->name('infoppdb.store');
    Route::get('/infoppdb/{id}/edit', [InfoPpdbController::class, 'edit'])->name('infoppdb.edit');
    Route::put('/infoppdb/{id}', [InfoPpdbController::class, 'update'])->name('infoppdb.update');
    Route::delete('/infoppdb/{id}', [InfoPpdbController::class, 'destroy'])->name('infoppdb.destroy');
});

// Route untuk pengguna (PPDB)
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/jadwal', [InfoPpdbController::class, 'jadwal'])->name('jadwal');
    Route::get('/syarat', [InfoPpdbController::class, 'syarat'])->name('syarat');
    Route::get('/biaya', [InfoPpdbController::class, 'biaya'])->name('biaya');
    Route::get('/kalender', [InfoPpdbController::class, 'kalender'])->name('kalender');
    Route::get('/brosur', [InfoPpdbController::class, 'brosur'])->name('brosur');
    Route::get('/faq', [InfoPpdbController::class, 'faq'])->name('faq');
});

use App\Http\Controllers\PengumumanController;

// Route untuk admin pengumuman
Route::prefix('admin')->group(function () {
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');
});


use Illuminate\Http\Request;

Route::get('/kk/{filename}', function (Request $request, $filename) {
    $user = $request->user();

    if (!$user || $user->role !== 'admin') {
        abort(403, 'Anda tidak memiliki akses ke file ini.');
    }

    $path = storage_path('app/uploads/kk/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File KK tidak ditemukan.');
    }

    return response()->file($path);
})->middleware('auth')->name('kk.show');


Route::get('/akta/{filename}', function (Request $request, $filename) {
    $user = $request->user();

    if (!$user || $user->role !== 'admin') {
        abort(403, 'Anda tidak memiliki akses ke file ini.');
    }

    $path = storage_path('app/uploads/akta/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File Akta tidak ditemukan.');
    }

    return response()->file($path);
})->middleware('auth')->name('akta.show');


use App\Http\Controllers\KontakController;

// Halaman Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('pengguna.kontak.index');

use App\Http\Controllers\SambutanController;

Route::resource('sambutan', SambutanController::class);

Route::get('/admin/datasiswa/export-excel', [App\Http\Controllers\DataSiswaController::class, 'exportExcel'])->name('admin.datasiswa.export.excel');

use App\Http\Controllers\SesiPendaftaranController;

Route::get('/admin/sesipendaftaran', [SesiPendaftaranController::class, 'index'])->name('admin.sesipendaftaran.index');
Route::post('/admin/sesipendaftaran', [SesiPendaftaranController::class, 'store'])->name('admin.sesipendaftaran.store');
Route::put('/admin/sesipendaftaran/{id}', [SesiPendaftaranController::class, 'update'])->name('admin.sesipendaftaran.update');
Route::delete('/admin/sesipendaftaran/{id}', [SesiPendaftaranController::class, 'destroy'])->name('admin.sesipendaftaran.destroy');
Route::get('/admin/sesipendaftaran/{id}/edit', [SesiPendaftaranController::class, 'edit'])->name('admin.sesipendaftaran.edit');
