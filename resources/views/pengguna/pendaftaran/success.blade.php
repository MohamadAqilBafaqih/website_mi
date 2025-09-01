@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5 text-center">
    <div class="card p-5 shadow-sm border-0">
        <h2 class="text-success mb-3">Pendaftaran Berhasil!</h2>
        <p>Terima kasih telah mendaftar. Data Anda sudah kami simpan. Silakan tunggu informasi selanjutnya dari sekolah.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
</div>
@endsection
