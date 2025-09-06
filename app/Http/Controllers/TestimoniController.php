<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Tampilkan semua testimoni (admin)
     */
    public function index()
    {
        $data = Testimoni::latest()->get();
        return view('admin.testimoni', compact('data'));
    }

    /**
     * Tampilkan semua testimoni untuk pengguna (frontend)
     */
    public function indexPengguna()
    {
        $data = Testimoni::where('status', 'diterima')->latest()->paginate(6);
        return view('pengguna.kontak.testimoni', compact('data'));
    }


    /**
     * Simpan testimoni baru (user)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'sebagai' => 'required|string',
            'testimoni' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create([
            'nama' => $request->nama,
            'sebagai' => $request->sebagai,
            'testimoni' => $request->testimoni,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pengguna.kontak.testimoni.index')
            ->with('success', 'Testimoni berhasil dikirim!');
    }

    /**
     * Edit testimoni (admin)
     */
    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $data = Testimoni::latest()->get();
        return view('admin.testimoni.edit', compact('testimoni', 'data'));
    }

    /**
     * Update testimoni (admin)
     */
    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);

        // Cek apakah request ini hanya update status dari tombol
        if ($request->has('status') && !$request->has('nama')) {
            $testimoni->status = $request->status; // diterima atau ditolak
            $testimoni->save();

            return redirect()->back()->with('success', 'Status testimoni berhasil diupdate.');
        }

        // Jika update full (form edit)
        $request->validate([
            'nama' => 'required|string|max:100',
            'sebagai' => 'required|in:alumni,wali murid,komite sekolah',
            'testimoni' => 'required|string',
            'status' => 'required|in:baru,diterima,ditolak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $updateData = $request->only(['nama', 'sebagai', 'testimoni', 'status']);

        // update foto jika ada
        if ($request->hasFile('foto')) {
            if ($testimoni->foto && file_exists(public_path('uploads/testimoni/' . $testimoni->foto))) {
                unlink(public_path('uploads/testimoni/' . $testimoni->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/testimoni'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $testimoni->update($updateData);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }


    /**
     * Hapus testimoni (admin)
     */
    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        if ($testimoni->foto && file_exists(public_path('uploads/testimoni/' . $testimoni->foto))) {
            unlink(public_path('uploads/testimoni/' . $testimoni->foto));
        }

        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }

    /**
     * Tampilkan testimoni ke halaman pengguna (frontend)
     */
    public function showAll()
    {
        $data = Testimoni::where('status', 'diterima')->latest()->paginate(6);
        return view('pengguna.kontak.testimoni', compact('data'));
    }
}
