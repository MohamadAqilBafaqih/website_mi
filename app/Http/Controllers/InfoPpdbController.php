<?php

namespace App\Http\Controllers;

use App\Models\InfoPpdb;
use Illuminate\Http\Request;

class InfoPpdbController extends Controller
{
    /**
     * Menampilkan semua data PPDB (untuk admin).
     */
    public function index()
    {
        $data = InfoPpdb::latest()->get();
        return view('admin.infoppdb', compact('data'));
    }

    /**
     * Form tambah data PPDB.
     */
    public function create()
    {
        // kalau view butuh $data, kirim; kalau tidak, hapus aja baris ini
        return view('admin.infoppdb.create');
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal'             => 'required|string',
            'syarat'             => 'required|string',
            'biaya'              => 'required|string',
            'faq'                => 'nullable|string',
            'kalender_akademik'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'brosur'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = $request->only(['jadwal', 'syarat', 'biaya', 'faq']);

        if ($request->hasFile('kalender_akademik')) {
            $fileName = time() . '_kalender.' . $request->kalender_akademik->extension();
            $request->kalender_akademik->move(public_path('uploads/ppdb'), $fileName);
            $data['kalender_akademik'] = $fileName;
        }

        if ($request->hasFile('brosur')) {
            $fileName = time() . '_brosur.' . $request->brosur->extension();
            $request->brosur->move(public_path('uploads/ppdb'), $fileName);
            $data['brosur'] = $fileName;
        }

        InfoPpdb::create($data);

        return redirect()->route('admin.infoppdb.index')
            ->with('success', 'Informasi PPDB berhasil ditambahkan.');
    }

    /**
     * Form edit data.
     */
    public function edit($id)
    {
        $data = InfoPpdb::latest()->get();
        $edit = InfoPpdb::findOrFail($id);

        return view('admin.infoppdb', compact('data', 'edit'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal'             => 'required|string',
            'syarat'             => 'required|string',
            'biaya'              => 'required|string',
            'faq'                => 'nullable|string',
            'kalender_akademik'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'brosur'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $item = InfoPpdb::findOrFail($id);
        $data = $request->only(['jadwal', 'syarat', 'biaya', 'faq']);

        if ($request->hasFile('kalender_akademik')) {
            $fileName = time() . '_kalender.' . $request->kalender_akademik->extension();
            $request->kalender_akademik->move(public_path('uploads/ppdb'), $fileName);
            $data['kalender_akademik'] = $fileName;
        }

        if ($request->hasFile('brosur')) {
            $fileName = time() . '_brosur.' . $request->brosur->extension();
            $request->brosur->move(public_path('uploads/ppdb'), $fileName);
            $data['brosur'] = $fileName;
        }

        $item->update($data);

        return redirect()->route('admin.infoppdb.index')
            ->with('success', 'Informasi PPDB berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy($id)
    {
        $item = InfoPpdb::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.infoppdb.index')
            ->with('success', 'Informasi PPDB berhasil dihapus.');
    }

    // =================== Bagian untuk pengguna ===================

    public function jadwal()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.jadwal', compact('data'));
    }

    public function syarat()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.syarat', compact('data'));
    }

    public function biaya()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.biaya', compact('data'));
    }

    public function kalender()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.kalender', compact('data'));
    }

    public function brosur()
    {
        $data = InfoPpdb::latest()->get();
        return view('pengguna.brosur', compact('data'));
    }


    public function faq()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.faq', compact('data'));
    }
}
