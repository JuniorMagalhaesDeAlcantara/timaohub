@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900">
    
    {{-- HEADER COM ESCUDO E NOME --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-black via-gray-900 to-black border-b-4 border-white">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://media.api-sports.io/football/teams/131.png'); background-size: 400px; background-repeat: no-repeat; background-position: right -100px center;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 py-12 relative z-10">
            <div class="flex items-center gap-6">
                <img src="https://media.api-sports.io/football/teams/131.png"
                     class="w-32 h-32 drop-shadow-2xl animate-pulse">
                
                <div>
                    <h1 class="text-5xl md:text-6xl font-black text-white tracking-tight">
                        {{ $team['name'] ?? 'CORINTHIANS' }}
                    </h1>
                    <p class="text-gray-300 text-xl mt-2 flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                        Temporada {{ $stats['league']['season'] ?? '2024' }} • {{ $stats['league']['name'] ?? 'Brasileirão' }}
                    </p>
                    
                    @if($venue)
                    <p class="text-gray-400 text-sm mt-2">
                        🏟️ {{ $venue['name'] ?? '' }} • {{ $venue['city'] ?? '' }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8 space-y-8">

        {{-- SEQUÊNCIA DE RESULTADOS --}}
        @if(!empty($formArray))
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl p-6 border border-gray-700">
            <h2 class="text-white text-xl font-bold mb-4 flex items-center gap-2">
                📊 Últimos 5 Jogos
            </h2>
            <div class="flex gap-3 justify-center">
                @foreach($formArray as $result)
                    @php
                        $colors = [
                            'W' => 'bg-green-500',
                            'D' => 'bg-yellow-500',
                            'L' => 'bg-red-500'
                        ];
                        $labels = [
                            'W' => 'V',
                            'D' => 'E',
                            'L' => 'D'
                        ];
                    @endphp
                    <div class="flex flex-col items-center gap-1">
                        <div class="{{ $colors[$result] ?? 'bg-gray-500' }} w-14 h-14 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg">
                            {{ $labels[$result] ?? '-' }}
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-400 text-lg">Nenhum artilheiro encontrado para esta temporada.</p>
                <p class="text-gray-500 text-sm mt-2">Os dados podem estar indisponíveis ou ainda não foram registrados.</p>
            </div>
            @endif
        </div>

        {{-- CARDS DE ESTATÍSTICAS PRINCIPAIS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            
            {{-- Jogos --}}
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition">
                <p class="text-blue-100 text-sm font-medium">JOGOS</p>
                <p class="text-5xl font-black text-white mt-2">
                    {{ $stats['fixtures']['played']['total'] ?? 0 }}
                </p>
            </div>

            {{-- Vitórias --}}
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition">
                <p class="text-green-100 text-sm font-medium">VITÓRIAS</p>
                <p class="text-5xl font-black text-white mt-2">
                    {{ $stats['fixtures']['wins']['total'] ?? 0 }}
                </p>
            </div>

            {{-- Empates --}}
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition">
                <p class="text-yellow-100 text-sm font-medium">EMPATES</p>
                <p class="text-5xl font-black text-white mt-2">
                    {{ $stats['fixtures']['draws']['total'] ?? 0 }}
                </p>
            </div>

            {{-- Derrotas --}}
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-xl p-6 transform hover:scale-105 transition">
                <p class="text-red-100 text-sm font-medium">DERROTAS</p>
                <p class="text-5xl font-black text-white mt-2">
                    {{ $stats['fixtures']['loses']['total'] ?? 0 }}
                </p>
            </div>

        </div>

        {{-- ESTATÍSTICAS DE GOLS --}}
        <div class="grid md:grid-cols-2 gap-6">
            
            {{-- Gols Marcados --}}
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl p-8 border border-gray-700">
                <h3 class="text-green-400 text-lg font-bold mb-6">⚽ GOLS MARCADOS</h3>
                
                <div class="text-6xl font-black text-white mb-6">
                    {{ $stats['goals']['for']['total']['total'] ?? 0 }}
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 rounded-xl p-4">
                        <p class="text-gray-400 text-xs">Casa</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['goals']['for']['total']['home'] ?? 0 }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-4">
                        <p class="text-gray-400 text-xs">Fora</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['goals']['for']['total']['away'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-4 text-gray-400 text-sm">
                    Média: {{ number_format($stats['goals']['for']['average']['total'] ?? 0, 2) }} por jogo
                </div>
            </div>

            {{-- Gols Sofridos --}}
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl p-8 border border-gray-700">
                <h3 class="text-red-400 text-lg font-bold mb-6">🛡️ GOLS SOFRIDOS</h3>
                
                <div class="text-6xl font-black text-white mb-6">
                    {{ $stats['goals']['against']['total']['total'] ?? 0 }}
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-800 rounded-xl p-4">
                        <p class="text-gray-400 text-xs">Casa</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['goals']['against']['total']['home'] ?? 0 }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-4">
                        <p class="text-gray-400 text-xs">Fora</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['goals']['against']['total']['away'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Clean Sheets:</span>
                        <span class="text-white font-bold">{{ $stats['clean_sheet']['total'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Média:</span>
                        <span class="text-white font-bold">{{ number_format($stats['goals']['against']['average']['total'] ?? 0, 2) }} por jogo</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ARTILHEIROS --}}
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl p-8 border border-gray-700">
            <h2 class="text-white text-2xl font-black mb-6 flex items-center gap-3">
                <span class="text-4xl">🔥</span>
                ARTILHEIROS DA TEMPORADA
            </h2>

            @if(count($scorers) > 0)
            <div class="space-y-4">
                @foreach($scorers as $index => $item)
                <div class="bg-gray-800 rounded-2xl p-5 flex items-center gap-5 hover:bg-gray-750 transition transform hover:scale-[1.02]">
                    
                    {{-- Ranking --}}
                    <div class="flex-shrink-0">
                        @if($index === 0)
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white font-black text-xl shadow-lg">
                                1
                            </div>
                        @elseif($index === 1)
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-white font-black text-xl shadow-lg">
                                2
                            </div>
                        @elseif($index === 2)
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-600 to-orange-800 flex items-center justify-center text-white font-black text-xl shadow-lg">
                                3
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 font-black text-xl">
                                {{ $index + 1 }}
                            </div>
                        @endif
                    </div>

                    {{-- Foto --}}
                    @php
                        $playerName = str_replace(' ', '+', $item['player']['name']);
                        $fallbackUrl = "https://ui-avatars.com/api/?name={$playerName}&background=random";
                    @endphp
                    <img src="{{ $item['player']['photo'] ?? $fallbackUrl }}"
                         class="w-16 h-16 rounded-full border-2 border-gray-600 shadow-lg object-cover"
                         onerror="this.src='{{ $fallbackUrl }}'">

                    {{-- Info --}}
                    <div class="flex-1">
                        <p class="font-bold text-white text-lg">{{ $item['player']['name'] }}</p>
                        <p class="text-gray-400 text-sm">{{ $item['games'] }} jogos</p>
                    </div>

                    {{-- Stats --}}
                    <div class="text-right space-y-1">
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-2xl">⚽</span>
                            <span class="text-3xl font-black text-white">{{ $item['goals'] }}</span>
                        </div>
                        @if($item['assists'] > 0)
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-sm text-gray-400">Assistências:</span>
                            <span class="text-sm font-bold text-green-400">{{ $item['assists'] }}</span>
                        </div>
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- PRÓXIMO JOGO --}}
        @if($nextGame)
        <div class="bg-gradient-to-br from-purple-900 to-indigo-900 rounded-3xl shadow-2xl p-8 border-2 border-purple-500">
            <h2 class="text-white text-xl font-black mb-6 flex items-center gap-2">
                📅 PRÓXIMO JOGO
            </h2>

            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                {{-- Time Casa --}}
                <div class="flex flex-col items-center text-center flex-1">
                    <img src="{{ $nextGame['teams']['home']['logo'] }}"
                         class="w-24 h-24 mb-3 drop-shadow-xl">
                    <p class="text-white font-bold text-xl">{{ $nextGame['teams']['home']['name'] }}</p>
                </div>

                {{-- VS e Data --}}
                <div class="text-center">
                    <div class="text-white text-4xl font-black mb-2">VS</div>
                    <p class="text-purple-200 text-sm">
                        {{ \Carbon\Carbon::parse($nextGame['fixture']['date'])->format('d/m/Y') }}
                    </p>
                    <p class="text-purple-300 font-bold">
                        {{ \Carbon\Carbon::parse($nextGame['fixture']['date'])->format('H:i') }}
                    </p>
                </div>

                {{-- Time Visitante --}}
                <div class="flex flex-col items-center text-center flex-1">
                    <img src="{{ $nextGame['teams']['away']['logo'] }}"
                         class="w-24 h-24 mb-3 drop-shadow-xl">
                    <p class="text-white font-bold text-xl">{{ $nextGame['teams']['away']['name'] }}</p>
                </div>

            </div>

            <div class="mt-6 text-center">
                <p class="text-purple-200 text-sm">
                    🏟️ {{ $nextGame['fixture']['venue']['name'] ?? 'Estádio a definir' }}
                </p>
            </div>
        </div>
        @endif

        {{-- BOTÃO TODOS OS JOGOS --}}
        <div class="text-center pt-6">
            <a href="/jogos"
               class="inline-flex items-center gap-3 bg-white text-black px-10 py-5 rounded-2xl text-xl font-black hover:bg-gray-200 transition transform hover:scale-105 shadow-2xl">
                <span>📋</span>
                VER TODOS OS JOGOS
            </a>
        </div>

    </div>

</div>
@endsection