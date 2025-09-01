@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Jadwal Pendaftaran</h2>
    <p>{!! $data->jadwal !!}</p>
</div>
@endsection
