@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- DESTAQUE -->
    @if(!empty($destaque))
        <a href="{{ route('noticias.show', $destaque['slug']) }}"
           class="block mb-12 group">

            <div class="relative h-[420px] rounded-3xl overflow-hidden shadow-2xl">

                @if(!empty($destaque['image']))
                    <img src="{{ $destaque['image'] }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition">
                @else
                    <div class="absolute inset-0 bg-gray-800 flex items-center justify-center text-white font-black">
                        Central do Timão
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent"></div>

                <div class="absolute bottom-0 p-8">
                    <span class="inline-block bg-white text-black px-4 py-1 rounded-full text-xs font-black mb-4">
                        DESTAQUE
                    </span>

                    <h2 class="text-3xl md:text-4xl font-black text-white mb-3">
                        {{ $destaque['title'] }}
                    </h2>

                    <p class="text-gray-200 max-w-3xl">
                        {{ $destaque['excerpt'] }}
                    </p>
                </div>
            </div>
        </a>
    @endif

    <!-- GRID DE NOTÍCIAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($noticias as $noticia)
            <a href="{{ route('noticias.show', $noticia['slug']) }}"
               class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">

                @if(!empty($noticia['image']))
                    <img src="{{ $noticia['image'] }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-600 font-bold">
                        Central do Timão
                    </div>
                @endif

                <div class="p-6">
                    <h3 class="font-black text-lg mb-3">
                        {{ $noticia['title'] }}
                    </h3>

                    <p class="text-gray-600 text-sm mb-4">
                        {{ $noticia['excerpt'] }}
                    </p>

                    <div class="text-xs text-gray-500 font-semibold">
                        {{ $noticia['source'] }}
                    </div>
                </div>
            </a>
        @endforeach

    </div>
</div>
@endsection
