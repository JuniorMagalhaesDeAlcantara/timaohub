@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 space-y-6">

    <h1 class="text-3xl font-bold">
        Jogos do Corinthians — Temporada 2022
    </h1>

    @if(empty($games))
    <p class="text-gray-500">
        Nenhum jogo encontrado para esta temporada.
    </p>
    @else
    <div class="space-y-4">
        @foreach ($games as $game)
        <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">

            @php
            $isHome = $game['teams']['home']['id'] === 131;
            @endphp

            <span class="
    px-2 py-1 rounded text-xs font-semibold text-white
    {{ $isHome ? 'bg-green-600' : 'bg-blue-600' }}
">
                {{ $isHome ? 'Casa' : 'Fora' }}
            </span>


            {{-- Times --}}
            <div>
                <p class="font-semibold">
                    {{ $game['teams']['home']['name'] }}
                    x
                    {{ $game['teams']['away']['name'] }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($game['fixture']['date'])
                                ->timezone('America/Sao_Paulo')
                                ->format('d/m/Y H:i') }}
                </p>
            </div>

            {{-- Placar --}}
            <div class="text-xl font-bold">
                {{ $game['goals']['home'] ?? '-' }}
                :
                {{ $game['goals']['away'] ?? '-' }}
            </div>

            {{-- Status --}}
            <span class="text-sm text-gray-600">
                {{ $game['fixture']['status']['long'] }}
            </span>

            <a href="{{ route('games.show', $game['fixture']['id']) }}"
                class="text-sm text-gray-500 hover:underline">
                Ver detalhes
            </a>

        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection