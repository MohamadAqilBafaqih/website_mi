<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    /**
     * Menampilkan semua data calon siswa.
     */
    public function index()
    {
        $data = CalonSiswa::latest()->get();
        return view('calon_siswa.index', compact('data'));
    }

    /**
     * Menampilkan form tambah calon siswa.
     */
    public function create()
    {
        return view('calon_siswa.create');
    }

    /**
     * Simpan data calon siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'nisn'              => 'required|string|max:20|unique:calon_siswa,nisn',
            'nik'               => 'required|string|max:20|unique:calon_siswa,nik',
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required|date',
            'agama'             => 'required',
            'alamat'            => 'required',
            'kelurahan'         => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'kode_pos'          => 'required|numeric',
            'no_hp'             => 'required',
            'email'             => 'required|email',
            'asal_sekolah'      => 'required',
            'tahun_lulus'       => 'required|numeric',
            'nama_ayah'         => 'required',
            'nik_ayah'          => 'required',
            'pekerjaan_ayah'    => 'required',
            'pendidikan_ayah'   => 'required',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'required',
            'pekerjaan_ibu'     => 'required',
            'pendidikan_ibu'    => 'required',
            'penghasilan_ortu'  => 'required',
            'akta_kelahiran'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status_pendaftaran' => 'required'
        ]);

        // Upload file jika ada
        $akta = null;
        if ($request->hasFile('akta_kelahiran')) {
            $akta = $request->file('akta_kelahiran')->store('uploads/akta', 'public');
        }

        $kk = null;
        if ($request->hasFile('kartu_keluarga')) {
            $kk = $request->file('kartu_keluarga')->store('uploads/kk', 'public');
        }

        CalonSiswa::create([
            ...$request->except(['akta_kelahiran', 'kartu_keluarga']),
            'akta_kelahiran' => $akta,
            'kartu_keluarga' => $kk
        ]);

        return redirect()->route('calon_siswa.index')->with('success', 'Data calon siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit data calon siswa.
     */
    public function edit($id)
    {
        $data = CalonSiswa::findOrFail($id);
        return view('calon_siswa.edit', compact('data'));
    }

    /**
     * Update data calon siswa.
     */
    public function update(Request $request, $id)
    {
        $data = CalonSiswa::findOrFail($id);

        $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'nisn'              => 'required|string|max:20|unique:calon_siswa,nisn,' . $id,
            'nik'               => 'required|string|max:20|unique:calon_siswa,nik,' . $id,
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required|date',
            'agama'             => 'required',
            'alamat'            => 'required',
            'kelurahan'         => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'kode_pos'          => 'required|numeric',
            'no_hp'             => 'required',
            'email'             => 'required|email',
            'asal_sekolah'      => 'required',
            'tahun_lulus'       => 'required|numeric',
            'nama_ayah'         => 'required',
            'nik_ayah'          => 'required',
            'pekerjaan_ayah'    => 'required',
            'pendidikan_ayah'   => 'required',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'required',
            'pekerjaan_ibu'     => 'required',
            'pendidikan_ibu'    => 'required',
            'penghasilan_ortu'  => 'required',
            'akta_kelahiran'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status_pendaftaran' => 'required'
        ]);

        // Update file jika ada
        if ($request->hasFile('akta_kelahiran')) {
            $akta = $request->file('akta_kelahiran')->store('uploads/akta', 'public');
            $data->akta_kelahiran = $akta;
        }

        if ($request->hasFile('kartu_keluarga')) {
            $kk = $request->file('kartu_keluarga')->store('uploads/kk', 'public');
            $data->kartu_keluarga = $kk;
        }

        $data->update($request->except(['akta_kelahiran', 'kartu_keluarga']) + [
            'akta_kelahiran' => $data->akta_kelahiran,
            'kartu_keluarga' => $data->kartu_keluarga
        ]);

        return redirect()->route('calon_siswa.index')->with('success', 'Data calon siswa berhasil diperbarui.');
    }

    /**
     * Hapus data calon siswa.
     */
    public function destroy($id)
    {
        $data = CalonSiswa::findOrFail($id);
        $data->delete();
        return redirect()->route('calon_siswa.index')->with('success', 'Data calon siswa berhasil dihapus.');
    }
}
