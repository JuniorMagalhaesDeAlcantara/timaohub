@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-black mb-6">
        {{ $noticia['title'] }}
    </h1>

    <div class="text-sm text-gray-500 font-semibold mb-6">
        {{ $noticia['source']['name'] }} ·
        {{ \Carbon\Carbon::parse($noticia['publishedAt'])->format('d/m/Y H:i') }}
    </div>

    @if($noticia['image'])
        <img src="{{ $noticia['image'] }}"
             class="w-full rounded-2xl shadow-lg mb-8">
    @endif

    <p class="text-lg text-gray-800 leading-relaxed mb-8">
        {{ $noticia['description'] }}
    </p>

    <a href="{{ $noticia['url'] }}" target="_blank"
       class="inline-block bg-black text-white px-6 py-3 rounded-xl font-black hover:bg-gray-900 transition">
        Ler matéria completa na fonte
    </a>

</div>
@endsection
