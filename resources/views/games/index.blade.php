@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

   <h2 class="text-3xl font-bold mb-6 text-center">Jogos do Corinthians</h2>

    @foreach ($games as $month => $championships)
        
        <!-- TÍTULO DO MÊS -->
        <h3 class="text-2xl font-bold mt-10 mb-4 text-gray-700">{{ $month }}</h3>

        @foreach ($championships as $champName => $gamesList)

            <!-- TÍTULO DO CAMPEONATO -->
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl font-semibold text-gray-800">🏆 {{ $champName }}</span>
            </div>

            <!-- GRID DOS CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($gamesList as $game)

                    @php
                        // Placar
                        $resultType = 'pending';
                        $cor = 'border-gray-300';

                        if ($game->result && str_contains($game->result, 'x')) {
                            [$cScore, $oScore] = array_map('trim', explode('x', $game->result));

                            if ($cScore > $oScore) {
                                $resultType = 'victory';
                                $cor = 'border-yellow-500'; // DOURADO
                            } elseif ($cScore < $oScore) {
                                $resultType = 'defeat';
                                $cor = 'border-red-500';
                            } else {
                                $resultType = 'draw';
                                $cor = 'border-blue-400';
                            }
                        }

                        $teamSlug = strtolower(str_replace([' ', 'ã', 'é', 'ó', 'ú'], ['-', 'a', 'e', 'o', 'u'], $game->opponent));
                    @endphp

                    <!-- CARD DO JOGO -->
                    <div class="bg-white shadow-lg rounded-xl border-l-4 {{ $cor }} p-4 text-center">

                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($game->match_date)->format('d/m') }}
                        </span>

                        <div class="flex items-center justify-center gap-4 mt-3">

                            <!-- Logo Corinthians -->
                            <img src="/images/corinthians.png" class="h-12 w-12 object-contain">

                            <!-- Placar -->
                            <div class="flex flex-col items-center">
                                @if ($resultType === 'pending')
                                    <span class="text-lg font-bold text-gray-400">VS</span>
                                @else
                                    <span class="text-xl font-bold">
                                        {{ $cScore }} x {{ $oScore }}
                                    </span>
                                @endif
                            </div>

                            <!-- Logo Adversário -->
                            <img 
                                src="/images/times/{{ $teamSlug }}.png"
                                class="h-12 w-12 object-contain"
                                onerror="this.src='/images/times/default.png'">
                        </div>

                        <!-- Nome do adversário -->
                        <p class="mt-2 font-semibold text-gray-700">{{ $game->opponent }}</p>

                        <!-- Estádio -->
                        <p class="text-sm text-gray-500">{{ $game->stadium }}</p>

                        <!-- Badge de resultado -->
                        @if ($resultType !== 'pending')
                            <span class="inline-block mt-3 px-3 py-1 text-xs font-bold rounded-full
                                @if($resultType==='victory') bg-yellow-100 text-yellow-700
                                @elseif($resultType==='defeat') bg-red-100 text-red-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ strtoupper($resultType) }}
                            </span>
                        @endif

                    </div>

                @endforeach
            </div>

        @endforeach
    @endforeach

</div>
@endsection
