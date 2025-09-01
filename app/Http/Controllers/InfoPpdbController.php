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
        return view('admin.infoppdb.create');
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal' => 'required|string',
            'syarat' => 'required|string',
            'biaya'  => 'required|string',
            'faq'    => 'nullable|string',
            'kalender_akademik' => 'nullable|mimes:pdf|max:2048',
            'brosur' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(['jadwal', 'syarat', 'biaya', 'faq']);

        // Upload kalender akademik
        if ($request->hasFile('kalender_akademik')) {
            $fileName = time() . '_kalender.' . $request->kalender_akademik->extension();
            $request->kalender_akademik->move(public_path('uploads/ppdb'), $fileName);
            $data['kalender_akademik'] = $fileName;
        }

        // Upload brosur
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
        $data = InfoPpdb::latest()->get();   // semua data
        $edit = InfoPpdb::findOrFail($id);   // data yang mau diedit

        return view('admin.infoppdb', compact('data', 'edit'));
    }


    /**
     * Update data.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal' => 'required|string',
            'syarat' => 'required|string',
            'biaya'  => 'required|string',
            'faq'    => 'nullable|string',
            'kalender_akademik' => 'nullable|mimes:pdf|max:2048',
            'brosur' => 'nullable|mimes:pdf|max:2048',
        ]);

        $item = InfoPpdb::findOrFail($id);
        $data = $request->only(['jadwal', 'syarat', 'biaya', 'faq']);

        // Upload kalender akademik baru
        if ($request->hasFile('kalender_akademik')) {
            $fileName = time() . '_kalender.' . $request->kalender_akademik->extension();
            $request->kalender_akademik->move(public_path('uploads/ppdb'), $fileName);
            $data['kalender_akademik'] = $fileName;
        }

        // Upload brosur baru
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

    public function jadwal()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.jadwal', compact('data'));
    }

    /**
     * Menampilkan Persyaratan PPDB
     */
    public function syarat()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.syarat', compact('data'));
    }

    /**
     * Menampilkan Biaya PPDB
     */
    public function biaya()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.biaya', compact('data'));
    }

    /**
     * Menampilkan Kalender Akademik
     */
    public function kalender()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.kalender', compact('data'));
    }

    /**
     * Download Brosur
     */
    public function brosur()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.brosur', compact('data'));
    }

    /**
     * Menampilkan FAQ
     */
    public function faq()
    {
        $data = InfoPpdb::latest()->first();
        return view('pengguna.ppdb.faq', compact('data'));
    }
}
