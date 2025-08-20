<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataSiswaController extends Controller
{
    /**
     * Tampilkan semua siswa yang diterima
     */
    public function index()
    {
        $siswa = CalonSiswa::where('status_pendaftaran', 'Diterima')
                    ->latest()
                    ->get();

        return view('admin.datasiswa', compact('siswa'));
    }

    /**
     * Tampilkan form edit data siswa
     */
    public function edit($id)
    {
        $item = CalonSiswa::where('status_pendaftaran', 'Diterima')->findOrFail($id);

        return view('admin.datasiswa.edit', compact('item'));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'     => 'required|string|max:100',
            'nik'              => 'nullable|string|max:20',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'     => 'nullable|string|max:50',
            'tanggal_lahir'    => 'nullable|date',
            'alamat'           => 'nullable|string',
            'kelurahan'        => 'nullable|string|max:50',
            'kecamatan'        => 'nullable|string|max:50',
            'kabupaten'        => 'nullable|string|max:50',
            'provinsi'         => 'nullable|string|max:50',
            'kode_pos'         => 'nullable|string|max:10',
            'no_hp'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:100',
            'asal_sekolah'     => 'nullable|string|max:100',
            'tahun_lulus'      => 'nullable|digits:4',
            'nama_ayah'        => 'nullable|string|max:100',
            'pekerjaan_ayah'   => 'nullable|string|max:50',
            'pendidikan_ayah'  => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|string|max:50',
            'nama_ibu'         => 'nullable|string|max:100',
            'pekerjaan_ibu'    => 'nullable|string|max:50',
            'pendidikan_ibu'   => 'nullable|string|max:50',
            'penghasilan_ibu'  => 'nullable|string|max:50',
            'akta_kelahiran'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'kartu_keluarga'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $item = CalonSiswa::where('status_pendaftaran', 'Diterima')->findOrFail($id);

        $aktaPath = $item->akta_kelahiran;
        $kkPath   = $item->kartu_keluarga;

        if ($request->file('akta_kelahiran')) {
            if ($aktaPath) Storage::delete($aktaPath);
            $aktaPath = $request->file('akta_kelahiran')->store('uploads/akta');
        }
        if ($request->file('kartu_keluarga')) {
            if ($kkPath) Storage::delete($kkPath);
            $kkPath = $request->file('kartu_keluarga')->store('uploads/kk');
        }

        $item->update(array_merge(
            $request->except(['akta_kelahiran', 'kartu_keluarga']),
            [
                'akta_kelahiran' => $aktaPath,
                'kartu_keluarga' => $kkPath,
            ]
        ));

        return redirect()->route('admin.datasiswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data siswa
     */
    public function destroy($id)
    {
        $item = CalonSiswa::where('status_pendaftaran', 'Diterima')->findOrFail($id);

        if ($item->akta_kelahiran) Storage::delete($item->akta_kelahiran);
        if ($item->kartu_keluarga) Storage::delete($item->kartu_keluarga);

        $item->delete();

        return redirect()->route('admin.datasiswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
