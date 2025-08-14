<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = KritikSaran::latest()->get();
        return view('admin.kritik_saran.index', compact('data'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.kritik_saran.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'kritik' => 'nullable|string',
            'saran' => 'nullable|string',
            'status' => 'in:Belum Dibaca,Dibaca,Ditindaklanjuti'
        ]);

        KritikSaran::create($request->all());

        return redirect()->route('kritik-saran.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data = KritikSaran::findOrFail($id);
        return view('admin.kritik_saran.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'kritik' => 'nullable|string',
            'saran' => 'nullable|string',
            'status' => 'in:Belum Dibaca,Dibaca,Ditindaklanjuti'
        ]);

        $data = KritikSaran::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('kritik-saran.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = KritikSaran::findOrFail($id);
        $data->delete();

        return redirect()->route('kritik-saran.index')->with('success', 'Data berhasil dihapus.');
    }
}
