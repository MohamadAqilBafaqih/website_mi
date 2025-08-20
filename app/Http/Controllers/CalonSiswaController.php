<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    /**
     * Tampilkan semua calon siswa
     */
    public function index()
    {
        $data = CalonSiswa::latest()->get();
        return view('admin.calonsiswa', compact('data'));
        // View: resources/views/admin/calonsiswa.blade.php
    }

    /**
     * Simpan calon siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:10',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'asal_sekolah' => 'nullable|string|max:150',
            'tahun_lulus' => 'nullable|digits:4',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'pendidikan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|string|max:50',
            'akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->all();

        // Upload file jika ada
        if ($request->hasFile('akta_kelahiran')) {
            $fileName = time() . '_akta.' . $request->akta_kelahiran->extension();
            $request->akta_kelahiran->move(public_path('uploads/calon_siswa'), $fileName);
            $data['akta_kelahiran'] = $fileName;
        }

        if ($request->hasFile('kartu_keluarga')) {
            $fileName = time() . '_kk.' . $request->kartu_keluarga->extension();
            $request->kartu_keluarga->move(public_path('uploads/calon_siswa'), $fileName);
            $data['kartu_keluarga'] = $fileName;
        }

        CalonSiswa::create($data);

        return redirect()->route('admin.calonsiswa.index')
            ->with('success', 'Calon siswa berhasil ditambahkan.');
    }

    /**
     * Form edit calon siswa
     */
    public function edit($id)
    {
        $calon = CalonSiswa::findOrFail($id);
        $data = CalonSiswa::latest()->get();
        return view('admin.calonsiswa', compact('calon', 'data'));
    }

    /**
     * Update calon siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:10',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'asal_sekolah' => 'nullable|string|max:150',
            'tahun_lulus' => 'nullable|digits:4',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'pendidikan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|string|max:50',
            'akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $calon = CalonSiswa::findOrFail($id);
        $updateData = $request->all();

        // Upload file jika ada
        if ($request->hasFile('akta_kelahiran')) {
            if ($calon->akta_kelahiran && file_exists(public_path('uploads/calon_siswa/' . $calon->akta_kelahiran))) {
                unlink(public_path('uploads/calon_siswa/' . $calon->akta_kelahiran));
            }
            $fileName = time() . '_akta.' . $request->akta_kelahiran->extension();
            $request->akta_kelahiran->move(public_path('uploads/calon_siswa'), $fileName);
            $updateData['akta_kelahiran'] = $fileName;
        }

        if ($request->hasFile('kartu_keluarga')) {
            if ($calon->kartu_keluarga && file_exists(public_path('uploads/calon_siswa/' . $calon->kartu_keluarga))) {
                unlink(public_path('uploads/calon_siswa/' . $calon->kartu_keluarga));
            }
            $fileName = time() . '_kk.' . $request->kartu_keluarga->extension();
            $request->kartu_keluarga->move(public_path('uploads/calon_siswa'), $fileName);
            $updateData['kartu_keluarga'] = $fileName;
        }

        $calon->update($updateData);

        return redirect()->route('admin.calonsiswa.index')
            ->with('success', 'Calon siswa berhasil diperbarui.');
    }

    /**
     * Hapus calon siswa
     */
    public function destroy($id)
    {
        $calon = CalonSiswa::findOrFail($id);

        if ($calon->akta_kelahiran && file_exists(public_path('uploads/calon_siswa/' . $calon->akta_kelahiran))) {
            unlink(public_path('uploads/calon_siswa/' . $calon->akta_kelahiran));
        }

        if ($calon->kartu_keluarga && file_exists(public_path('uploads/calon_siswa/' . $calon->kartu_keluarga))) {
            unlink(public_path('uploads/calon_siswa/' . $calon->kartu_keluarga));
        }

        $calon->delete();

        return redirect()->route('admin.calonsiswa.index')
            ->with('success', 'Calon siswa berhasil dihapus.');
    }
}
