<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class SeleksiSiswaController extends Controller
{
    /**
     * Menampilkan semua data calon siswa untuk seleksi
     */
    public function index()
    {
        $data = CalonSiswa::latest()->get();
        return view('admin.seleksisiswa', compact('data'));
    }

    /**
     * Menampilkan form edit status seleksi siswa
     */
    public function edit($id)
    {
        $item = CalonSiswa::findOrFail($id);
        return view('admin.seleksisiswa.edit', compact('item'));
    }

    /**
     * Update status seleksi calon siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:Baru,Diterima,Ditolak',
        ]);

        $item = CalonSiswa::findOrFail($id);
        $item->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        return redirect()->route('admin.seleksisiswa.index')->with('success', 'Status seleksi berhasil diperbarui.');
    }

    /**
     * Hapus data siswa jika diperlukan dari seleksi
     */
    public function destroy($id)
    {
        $item = CalonSiswa::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.seleksisiswa.index')->with('success', 'Data calon siswa berhasil dihapus.');
    }
}
