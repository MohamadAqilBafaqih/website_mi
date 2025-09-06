<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\SesiPendaftaran;
use Illuminate\Http\Request;

class SeleksiSiswaController extends Controller
{
    /**
     * Menampilkan semua data calon siswa untuk seleksi
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tahunFilter = $request->input('tahun_ajaran');
        $statusFilter = $request->input('status');

        $query = CalonSiswa::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($tahunFilter) {
            $query->whereHas('sesi', function ($q) use ($tahunFilter) {
                $q->where('tahun_ajaran', $tahunFilter);
            });
        }

        if ($statusFilter) {
            $query->where('status_pendaftaran', $statusFilter);
        }

        $data = $query->latest()->paginate(10);

        $tahunAjaranList = SesiPendaftaran::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('admin.seleksisiswa', compact('data', 'tahunAjaranList', 'search', 'tahunFilter', 'statusFilter'));
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
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'tahun_lulus' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:255',
            'penghasilan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:255',
            'penghasilan_ibu' => 'nullable|string|max:255',
            'status_pendaftaran' => 'nullable|in:Baru,Diterima,Ditolak',
        ]);

        $siswa = CalonSiswa::findOrFail($id);
        $siswa->update($validated);

        return redirect()->route('admin.seleksisiswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Di Controller SeleksiSiswaController
    public function updateStatus(Request $request, $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_pendaftaran = $request->status;
        $siswa->save();

        return redirect()->back()->with('success', 'Status siswa berhasil diubah');
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
