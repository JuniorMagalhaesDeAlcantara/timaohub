@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-8">

    {{-- TÍTULO --}}
    <div class="flex items-center justify-between">
        <h1 class="text-3xl md:text-4xl font-black text-black uppercase tracking-tight">
            Jogos do Corinthians
        </h1>
        <span class="text-sm font-bold text-gray-600">
            Temporada 2022
        </span>
    </div>

    {{-- SEM JOGOS --}}
    @if(empty($games))
    <div class="bg-white rounded-2xl shadow p-8 text-center border border-gray-200">
        <p class="text-gray-600 text-lg font-bold">
            Nenhum jogo encontrado para esta temporada.
        </p>
        <p class="text-gray-500 text-sm mt-2">
            Os dados podem estar indisponíveis no momento.
        </p>
    </div>
    @else

    {{-- LISTA DE JOGOS --}}
    <div class="space-y-4">
        @foreach ($games as $game)

        @php
        $isHome = $game['teams']['home']['id'] === 131;
        @endphp

        @php
        $isHome = $game['teams']['home']['id'] === 131;
        $corinthiansGoals = $isHome ? ($game['goals']['home'] ?? 0) : ($game['goals']['away'] ?? 0);
        $opponentGoals = $isHome ? ($game['goals']['away'] ?? 0) : ($game['goals']['home'] ?? 0);

        if ($corinthiansGoals > $opponentGoals) {
        $result = 'Vitória';
        $badgeClass = 'bg-yellow-400 text-black';
        } elseif ($corinthiansGoals == $opponentGoals) {
        $result = 'Empate';
        $badgeClass = 'bg-gray-400 text-white';
        } else {
        $result = 'Derrota';
        $badgeClass = 'bg-gray-800 text-white';
        }
        @endphp

        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5 border border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative">

            {{-- BADGE --}}
            <span class="absolute top-2 right-2 px-3 py-1 rounded-full text-xs font-bold {{ $badgeClass }}">
                {{ $result }}
            </span>

            {{-- CASA / FORA --}}
            <div class="flex-shrink-0">
                <span class="px-3 py-1 rounded-full text-xs font-black uppercase
                {{ $isHome ? 'bg-black text-white' : 'bg-gray-200 text-black' }}">
                    {{ $isHome ? 'Casa' : 'Fora' }}
                </span>
            </div>

            {{-- TIMES --}}
            <div class="flex-1">
                <p class="font-black text-black text-lg">
                    {{ $game['teams']['home']['name'] }}
                    <span class="mx-2 text-gray-400 font-bold">x</span>
                    {{ $game['teams']['away']['name'] }}
                </p>
                <p class="text-sm text-gray-500 font-semibold mt-1">
                    {{ \Carbon\Carbon::parse($game['fixture']['date'])
                    ->timezone('America/Sao_Paulo')
                    ->format('d/m/Y • H:i') }}
                </p>
            </div>

            {{-- PLACAR --}}
            <div class="text-center min-w-[80px] text-2xl font-black text-black">
                {{ $game['goals']['home'] ?? '-' }}
                <span class="mx-1 text-gray-500">:</span>
                {{ $game['goals']['away'] ?? '-' }}
            </div>

            {{-- STATUS --}}
            <div class="text-sm font-bold text-gray-600 text-center min-w-[120px]">
                @if($game['fixture']['status']['long'] === 'Match Finished')
                Jogo Encerrado
                @else
                {{ $game['fixture']['status']['long'] }}
                @endif
            </div>

            {{-- LINK --}}
            <div class="text-center">
                <a href="{{ route('games.show', $game['fixture']['id']) }}"
                    class="inline-block px-4 py-2 rounded-xl text-sm font-black
                      bg-black text-white hover:bg-gray-900 transition">
                    Ver detalhes
                </a>
            </div>

        </div>

        @endforeach
    </div>

    @endif

</div>
@endsection