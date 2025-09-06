<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\SesiPendaftaran;
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
    }

    /**
     * Simpan calon siswa baru
     */
    public function store(Request $request)
    {
        $sesi = SesiPendaftaran::where('status', 'aktif')->first();

        $request->validate([
            'nama_lengkap'     => 'required|string|max:100',
            'nik'              => 'required|string|max:20',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'     => 'required|string|max:50',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'kelurahan'        => 'required|string|max:50',
            'kecamatan'        => 'required|string|max:50',
            'kabupaten'        => 'required|string|max:50',
            'provinsi'         => 'required|string|max:50',
            'kode_pos'         => 'required|string|max:10',
            'no_hp'            => 'required|string|max:20',
            'email'            => 'required|email|max:100',
            'asal_sekolah'     => 'required|string|max:100',
            'tahun_lulus'      => 'required|digits:4',

            // Data Ayah
            'nama_ayah'        => 'required|string|max:100',
            'pekerjaan_ayah'   => 'required|string|max:50',
            'pendidikan_ayah'  => 'required|string|max:50',
            'penghasilan_ayah' => 'required|string|max:50',

            // Data Ibu
            'nama_ibu'         => 'required|string|max:100',
            'pekerjaan_ibu'    => 'required|string|max:50',
            'pendidikan_ibu'   => 'required|string|max:50',
            'penghasilan_ibu'  => 'required|string|max:50',

            // Dokumen wajib
            'akta_kelahiran'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kartu_keluarga'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto_siswa'       => 'required|file|mimes:jpg,jpeg,png|max:5120',

            // Data KIP opsional
            'no_kip'           => 'nullable|string|max:50',
            'foto_kip'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->all();
        $data['status_pendaftaran'] = 'Baru';
        $data['tahun_ajaran'] = $sesi ? $sesi->tahun_ajaran : null; // <── isi otomatis

        // Upload file wajib
        foreach (['akta_kelahiran', 'kartu_keluarga', 'foto_siswa'] as $field) {
            if ($request->hasFile($field)) {
                $fileName = time() . "_{$field}." . $request->$field->extension();
                $request->$field->move(public_path('uploads/calon_siswa'), $fileName);
                $data[$field] = $fileName;
            }
        }

        // Upload file opsional (KIP)
        if ($request->hasFile('foto_kip')) {
            $fileName = time() . '_kip.' . $request->foto_kip->extension();
            $request->foto_kip->move(public_path('uploads/calon_siswa'), $fileName);
            $data['foto_kip'] = $fileName;
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
            'nama_lengkap'     => 'required|string|max:100',
            'nik'              => 'required|string|max:20',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'     => 'required|string|max:50',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'kelurahan'        => 'required|string|max:50',
            'kecamatan'        => 'required|string|max:50',
            'kabupaten'        => 'required|string|max:50',
            'provinsi'         => 'required|string|max:50',
            'kode_pos'         => 'required|string|max:10',
            'no_hp'            => 'required|string|max:20',
            'email'            => 'required|email|max:100',
            'asal_sekolah'     => 'required|string|max:100',
            'tahun_lulus'      => 'required|digits:4',

            // Data Ayah
            'nama_ayah'        => 'required|string|max:100',
            'pekerjaan_ayah'   => 'required|string|max:50',
            'pendidikan_ayah'  => 'required|string|max:50',
            'penghasilan_ayah' => 'required|string|max:50',

            // Data Ibu
            'nama_ibu'         => 'required|string|max:100',
            'pekerjaan_ibu'    => 'required|string|max:50',
            'pendidikan_ibu'   => 'required|string|max:50',
            'penghasilan_ibu'  => 'required|string|max:50',

            // Dokumen
            'akta_kelahiran'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kartu_keluarga'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto_siswa'       => 'nullable|file|mimes:jpg,jpeg,png|max:5120',

            // Data KIP
            'no_kip'           => 'nullable|string|max:50',
            'foto_kip'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $calon = CalonSiswa::findOrFail($id);
        $updateData = $request->all();

        if ($request->has('status_pendaftaran')) {
            $updateData['status_pendaftaran'] = $request->status_pendaftaran;
        }


        // Update file wajib
        foreach (['akta_kelahiran', 'kartu_keluarga', 'foto_siswa'] as $field) {
            if ($request->hasFile($field)) {
                if ($calon->$field && file_exists(public_path('uploads/calon_siswa/' . $calon->$field))) {
                    unlink(public_path('uploads/calon_siswa/' . $calon->$field));
                }
                $fileName = time() . "_{$field}." . $request->$field->extension();
                $request->$field->move(public_path('uploads/calon_siswa'), $fileName);
                $updateData[$field] = $fileName;
            }
        }

        // Update file kip
        if ($request->hasFile('foto_kip')) {
            if ($calon->foto_kip && file_exists(public_path('uploads/calon_siswa/' . $calon->foto_kip))) {
                unlink(public_path('uploads/calon_siswa/' . $calon->foto_kip));
            }
            $fileName = time() . '_kip.' . $request->foto_kip->extension();
            $request->foto_kip->move(public_path('uploads/calon_siswa'), $fileName);
            $updateData['foto_kip'] = $fileName;
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

        foreach (['akta_kelahiran', 'kartu_keluarga', 'foto_siswa', 'foto_kip'] as $fileField) {
            if ($calon->$fileField && file_exists(public_path('uploads/calon_siswa/' . $calon->$fileField))) {
                unlink(public_path('uploads/calon_siswa/' . $calon->$fileField));
            }
        }

        $calon->delete();

        return redirect()->route('admin.calonsiswa.index')
            ->with('success', 'Calon siswa berhasil dihapus.');
    }

    /**
     * Form pendaftaran untuk user
     */
    public function create()
    {
        $sesi = SesiPendaftaran::sesiAktif();

        if (!$sesi) {
            return view('pengguna.pendaftaran.closed', [
                'message' => 'Pendaftaran Belum Dibuka'
            ]);
        }

        return view('pengguna.pendaftaran.daftarppdb', compact('sesi'));
    }

    /**
     * Simpan data calon siswa dari user
     */
    public function storeUser(Request $request)
    {
        $sesi = SesiPendaftaran::sesiAktif();

        if (!$sesi) {
            return back()->withErrors(['error' => 'Pendaftaran tidak tersedia saat ini.']);
        }

        $request->validate([
            'nama_lengkap'     => 'required|string|max:100',
            'nik'              => 'required|string|max:20',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'     => 'required|string|max:50',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string',
            'kelurahan'        => 'required|string|max:50',
            'kecamatan'        => 'required|string|max:50',
            'kabupaten'        => 'required|string|max:50',
            'provinsi'         => 'required|string|max:50',
            'kode_pos'         => 'required|string|max:10',
            'no_hp'            => 'required|string|max:20',
            'email'            => 'required|email|max:100',
            'asal_sekolah'     => 'required|string|max:100',
            'tahun_lulus'      => 'required|digits:4|integer|min:2000|max:' . date('Y'),

            // Data Ayah
            'nama_ayah'        => 'required|string|max:100',
            'pekerjaan_ayah'   => 'required|string|max:50',
            'pendidikan_ayah'  => 'required|string|max:50',
            'penghasilan_ayah' => 'required|string|max:50',

            // Data Ibu
            'nama_ibu'         => 'required|string|max:100',
            'pekerjaan_ibu'    => 'required|string|max:50',
            'pendidikan_ibu'   => 'required|string|max:50',
            'penghasilan_ibu'  => 'required|string|max:50',

            // Dokumen wajib
            'akta_kelahiran'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kartu_keluarga'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto_siswa'       => 'required|file|mimes:jpg,jpeg,png|max:5120',

            // Data KIP opsional
            'no_kip'           => 'nullable|string|max:50',
            'foto_kip'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Ambil hanya data yang diperlukan
        $data = $request->except(['_token', '_method', 'akta_kelahiran', 'kartu_keluarga', 'foto_siswa', 'foto_kip']);
        $data['status_pendaftaran'] = 'Baru';
        $data['sesi_id'] = $sesi->id;
        $data['tahun_ajaran'] = $sesi->tahun_ajaran;

        // Buat folder kalau belum ada
        if (!file_exists(public_path('uploads/calon_siswa'))) {
            mkdir(public_path('uploads/calon_siswa'), 0777, true);
        }

        // Upload file wajib
        foreach (['akta_kelahiran', 'kartu_keluarga', 'foto_siswa'] as $field) {
            if ($request->hasFile($field)) {
                $fileName = time() . "_{$field}." . $request->file($field)->getClientOriginalExtension();
                $request->file($field)->move(public_path('uploads/calon_siswa'), $fileName);
                $data[$field] = $fileName;
            }
        }

        // Upload file opsional KIP
        if ($request->hasFile('foto_kip')) {
            $fileName = time() . '_kip.' . $request->file('foto_kip')->getClientOriginalExtension();
            $request->file('foto_kip')->move(public_path('uploads/calon_siswa'), $fileName);
            $data['foto_kip'] = $fileName;
        }

        CalonSiswa::create($data);

        return redirect()->route('pendaftaran.success')
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }
}
