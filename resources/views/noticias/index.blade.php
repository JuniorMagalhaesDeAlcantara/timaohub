@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Título da Página -->
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-black text-gray-900">
            📰 Notícias do Corinthians
        </h2>
        <p class="text-gray-600 mt-2 font-semibold">
            Tudo o que acontece no Timão, em um só lugar
        </p>
    </div>

    <!-- Grid de Notícias (mock por enquanto) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @for ($i = 0; $i < 6; $i++)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">

                <!-- Imagem -->
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400 font-bold">
                        IMAGEM DA NOTÍCIA
                    </span>
                </div>

                <!-- Conteúdo -->
                <div class="p-6">
                    <h3 class="font-black text-lg text-gray-900 mb-3">
                        Corinthians se prepara para o próximo desafio
                    </h3>

                    <p class="text-gray-600 text-sm mb-4">
                        Elenco treinou forte no CT Joaquim Grava visando o próximo confronto...
                    </p>

                    <div class="flex justify-between items-center text-xs text-gray-500 font-semibold">
                        <span>Fonte: GNews</span>
                        <span>{{ date('d/m/Y') }}</span>
                    </div>
                </div>
            </article>
        @endfor

    </div>
</div>
@endsection
