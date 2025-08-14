<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataGuruController extends Controller
{
    /**
     * Tampilkan semua data guru
     */
    public function index()
    {
        $guru = DataGuru::latest()->get();
        return view('data_guru.index', compact('guru'));
    }

    /**
     * Form tambah data guru
     */
    public function create()
    {
        return view('data_guru.create');
    }

    /**
     * Simpan data guru baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required|string|max:50',
            'mata_pelajaran' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_guru', 'public');
        }

        DataGuru::create($data);

        return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Form edit data guru
     */
    public function edit($id)
    {
        $guru = DataGuru::findOrFail($id);
        return view('data_guru.edit', compact('guru'));
    }

    /**
     * Update data guru
     */
    public function update(Request $request, $id)
    {
        $guru = DataGuru::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required|string|max:50',
            'mata_pelajaran' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Hapus data guru
     */
    public function destroy($id)
    {
        $guru = DataGuru::findOrFail($id);

        // Hapus foto jika ada
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
