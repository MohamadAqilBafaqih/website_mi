<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    /**
     * Tampilkan semua data kritik & saran
     */
    public function index()
    {
        $data = KritikSaran::latest()->get();
        return view('admin.kritiksaran', compact('data'));
    }

    /**
     * Simpan kritik & saran baru (biasanya dari halaman publik)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'nullable|string|max:100',
            'email'  => 'nullable|email|max:100',
            'no_hp'  => 'nullable|string|max:20',
            'kritik' => 'nullable|string',
            'saran'  => 'nullable|string',
        ]);

        KritikSaran::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'kritik' => $request->kritik,
            'saran'  => $request->saran,
        ]);

        return back()->with('success', 'Kritik & Saran berhasil dikirim.');
    }

    /**
     * Ubah status kritik & saran
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Belum Dibaca,Dibaca,Ditindaklanjuti',
        ]);

        $item = KritikSaran::findOrFail($id);
        $item->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.kritiksaran.index')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Hapus kritik & saran
     */
    public function destroy($id)
    {
        $item = KritikSaran::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.kritiksaran.index')->with('success', 'Kritik & Saran berhasil dihapus.');
    }
}
