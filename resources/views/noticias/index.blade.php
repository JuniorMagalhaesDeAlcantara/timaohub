@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Título -->
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-black">
            📰 Notícias do Corinthians
        </h2>
        <p class="text-gray-600 font-semibold mt-2">
            As últimas notícias do Timão
        </p>
    </div>

    @if (empty($noticias))
        <p class="text-center text-gray-500">
            Nenhuma notícia encontrada no momento.
        </p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($noticias as $noticia)
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">

                    @if($noticia['image'])
                        <img src="{{ $noticia['image'] }}"
                             class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        <h3 class="font-black text-lg mb-3">
                            {{ $noticia['title'] }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ $noticia['description'] }}
                        </p>

                        <div class="flex justify-between items-center text-xs text-gray-500 font-semibold">
                            <span>{{ $noticia['source']['name'] }}</span>
                            <span>
                                {{ \Carbon\Carbon::parse($noticia['publishedAt'])->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif

</div>
@endsection
