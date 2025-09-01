@extends('pengguna.beranda-content')

@section('title', 'FAQ PPDB')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">FAQ PPDB</h1>

    @if($data && $data->faq)
        <div class="accordion" id="faqAccordion">
            @foreach(json_decode($data->faq, true) ?? [] as $index => $item)
                <div class="accordion-item mb-2 shadow-sm">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $item['question'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($item['answer'])) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Belum ada FAQ tersedia.</p>
    @endif
</div>
@endsection
