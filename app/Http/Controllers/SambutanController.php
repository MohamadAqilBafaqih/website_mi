<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    /**
     * Tampilkan daftar sambutan.
     */
    public function index()
    {
        $data = Sambutan::latest()->get();
        return view('sambutan.index', compact('data'));
    }

    /**
     * Form tambah sambutan.
     */
    public function create()
    {
        return view('sambutan.create');
    }

    /**
     * Simpan sambutan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'sambutan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('uploads/sambutan'), $foto);
        }

        Sambutan::create([
            'nama' => $request->nama,
            'sambutan' => $request->sambutan,
            'foto' => $foto,
        ]);

        return redirect()->route('sambutan.index')->with('success', 'Sambutan berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail sambutan.
     */
    public function show(Sambutan $sambutan)
    {
        return view('sambutan.show', compact('sambutan'));
    }

    /**
     * Form edit sambutan.
     */
    public function edit(Sambutan $sambutan)
    {
        return view('sambutan.edit', compact('sambutan'));
    }

    /**
     * Update data sambutan.
     */
    public function update(Request $request, Sambutan $sambutan)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'sambutan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $sambutan->foto;
        if ($request->hasFile('foto')) {
            $foto = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('uploads/sambutan'), $foto);
        }

        $sambutan->update([
            'nama' => $request->nama,
            'sambutan' => $request->sambutan,
            'foto' => $foto,
        ]);

        return redirect()->route('sambutan.index')->with('success', 'Sambutan berhasil diperbarui.');
    }

    /**
     * Hapus sambutan.
     */
    public function destroy(Sambutan $sambutan)
    {
        if ($sambutan->foto && file_exists(public_path('uploads/sambutan/'.$sambutan->foto))) {
            unlink(public_path('uploads/sambutan/'.$sambutan->foto));
        }

        $sambutan->delete();
        return redirect()->route('sambutan.index')->with('success', 'Sambutan berhasil dihapus.');
    }
}
