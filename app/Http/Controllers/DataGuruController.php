<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    /**
     * Tampilkan semua data guru
     */
    public function index()
    {
        $data = DataGuru::latest()->get();
        return view('admin.dataguru', compact('data'));
        // View: resources/views/admin/dataguru.blade.php
    }

    /**
     * Simpan data guru baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'nullable|string|max:100',
            'mata_pelajaran' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'email' => 'nullable|email|max:150',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/guru'), $fileName);
            $data['foto'] = $fileName;
        }

        DataGuru::create($data);

        return redirect()->route('admin.dataguru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Form edit data guru
     */
    public function edit($id)
    {
        $guru = DataGuru::findOrFail($id);
        $data = DataGuru::latest()->get();
        return view('admin.dataguru', compact('guru', 'data'));
    }

    /**
     * Update data guru
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'nullable|string|max:100',
            'mata_pelajaran' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'email' => 'nullable|email|max:150',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
        ]);

        $guru = DataGuru::findOrFail($id);
        $updateData = $request->all();

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/guru'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $guru->update($updateData);

        return redirect()->route('admin.dataguru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Hapus data guru
     */
    public function destroy($id)
    {
        $guru = DataGuru::findOrFail($id);

        if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
            unlink(public_path('uploads/guru/' . $guru->foto));
        }

        $guru->delete();

        return redirect()->route('admin.dataguru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Tampilkan data guru untuk pengguna (frontend)
     */
    public function showGuru()
    {
        $data = DataGuru::orderBy('nama_lengkap', 'asc')->get();
        // View: resources/views/pengguna/profil/guru.blade.php
        return view('pengguna.profil.dataguru', compact('data'));
    }
}
