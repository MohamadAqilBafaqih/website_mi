<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Tampilkan semua pengumuman
     */
    public function index()
    {
        $data = Pengumuman::latest()->get();
        return view('admin.pengumuman', compact('data'));
    }

    /**
     * Tampilkan form tambah pengumuman
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Simpan pengumuman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'running_teks' => 'required|string',
            'foto_slide1' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_slide2' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_slide3' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $data = $request->only(['running_teks']);

        // Upload foto
        for ($i = 1; $i <= 3; $i++) {
            $fotoField = 'foto_slide' . $i;
            if ($request->hasFile($fotoField)) {
                $fileName = time() . '_' . $i . '.' . $request->$fotoField->extension();
                $request->$fotoField->move(public_path('uploads/pengumuman'), $fileName);
                $data[$fotoField] = $fileName;
            }
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengumuman
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update pengumuman
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'running_teks' => 'required|string',
            'foto_slide1' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_slide2' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'foto_slide3' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $data = $request->only(['running_teks']);

        // Upload foto dan hapus foto lama jika ada
        for ($i = 1; $i <= 3; $i++) {
            $fotoField = 'foto_slide' . $i;
            if ($request->hasFile($fotoField)) {
                if ($pengumuman->$fotoField && file_exists(public_path('uploads/pengumuman/' . $pengumuman->$fotoField))) {
                    unlink(public_path('uploads/pengumuman/' . $pengumuman->$fotoField));
                }
                $fileName = time() . '_' . $i . '.' . $request->$fotoField->extension();
                $request->$fotoField->move(public_path('uploads/pengumuman'), $fileName);
                $data[$fotoField] = $fileName;
            }
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Hapus pengumuman
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Hapus semua foto
        for ($i = 1; $i <= 3; $i++) {
            $fotoField = 'foto_slide' . $i;
            if ($pengumuman->$fotoField && file_exists(public_path('uploads/pengumuman/' . $pengumuman->$fotoField))) {
                unlink(public_path('uploads/pengumuman/' . $pengumuman->$fotoField));
            }
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }


}
