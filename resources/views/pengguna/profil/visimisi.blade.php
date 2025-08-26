@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Visi & Misi MI Diponegoro 03 Karangklesem</h2>

    @foreach($data as $item)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="fw-bold">Visi</h4>
                <p>{{ $item->visi }}</p>
                
                <h4 class="fw-bold">Misi</h4>
                <p>{{ $item->misi }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
