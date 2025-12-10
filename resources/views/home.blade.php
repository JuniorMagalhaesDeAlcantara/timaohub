@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    <div class="max-w-7xl mx-auto px-6 py-8">
        
        {{-- HERO CARD COM ESCUDO E NOME --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-black to-gray-900 rounded-3xl shadow-2xl border-4 border-black mb-10">
            <!-- Escudo marca d'água -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('https://media.api-sports.io/football/teams/131.png'); background-size: 500px; background-repeat: no-repeat; background-position: right -100px center;"></div>
            </div>
            
            <div class="relative z-10 p-10">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <img src="https://media.api-sports.io/football/teams/131.png"
                         class="w-36 h-36 drop-shadow-2xl">
                    
                    <div>
                        <h1 class="text-6xl md:text-7xl font-black text-white tracking-tight uppercase">
                            {{ $team['name'] ?? 'CORINTHIANS' }}
                        </h1>
                        <p class="text-gray-300 text-2xl mt-3 flex items-center gap-3 font-bold">
                            <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                            Temporada {{ $stats['league']['season'] ?? '2023' }} • {{ $stats['league']['name'] ?? 'Brasileirão' }}
                        </p>
                        
                        @if($venue)
                        <p class="text-gray-400 text-base mt-3 font-medium">
                            🏟️ {{ $venue['name'] ?? '' }} • {{ $venue['city'] ?? '' }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Borda inferior decorativa -->
            <div class="h-2 bg-gradient-to-r from-white via-gray-300 to-white"></div>
        </div>

        <div class="space-y-10">

        {{-- SEQUÊNCIA DE RESULTADOS --}}
        @if(!empty($formArray))
        <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-200">
            <h2 class="text-black text-2xl font-black mb-6 flex items-center gap-3 uppercase tracking-wide">
                📊 Últimos 5 Jogos
            </h2>
            <div class="flex gap-4 justify-center flex-wrap">
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
                    <div class="flex flex-col items-center gap-2">
                        <div class="{{ $colors[$result] ?? 'bg-gray-500' }} w-16 h-16 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-lg transform hover:scale-110 transition">
                            {{ $labels[$result] ?? '-' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-200">
            <div class="text-center py-8">
                <p class="text-gray-600 text-lg font-bold">Nenhum resultado encontrado para esta temporada.</p>
                <p class="text-gray-500 text-sm mt-2">Os dados podem estar indisponíveis ou ainda não foram registrados.</p>
            </div>
        </div>
        @endif

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
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-200">
                <h3 class="text-green-600 text-xl font-black mb-6 uppercase tracking-wide">⚽ GOLS MARCADOS</h3>
                
                <div class="text-7xl font-black text-black mb-6">
                    {{ $stats['goals']['for']['total']['total'] ?? 0 }}
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <p class="text-gray-500 text-xs font-bold uppercase">Casa</p>
                        <p class="text-3xl font-black text-black mt-1">{{ $stats['goals']['for']['total']['home'] ?? 0 }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <p class="text-gray-500 text-xs font-bold uppercase">Fora</p>
                        <p class="text-3xl font-black text-black mt-1">{{ $stats['goals']['for']['total']['away'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-5 text-gray-600 text-sm font-bold">
                    Média: {{ number_format($stats['goals']['for']['average']['total'] ?? 0, 2) }} por jogo
                </div>
            </div>

            {{-- Gols Sofridos --}}
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-200">
                <h3 class="text-red-600 text-xl font-black mb-6 uppercase tracking-wide">🛡️ GOLS SOFRIDOS</h3>
                
                <div class="text-7xl font-black text-black mb-6">
                    {{ $stats['goals']['against']['total']['total'] ?? 0 }}
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <p class="text-gray-500 text-xs font-bold uppercase">Casa</p>
                        <p class="text-3xl font-black text-black mt-1">{{ $stats['goals']['against']['total']['home'] ?? 0 }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                        <p class="text-gray-500 text-xs font-bold uppercase">Fora</p>
                        <p class="text-3xl font-black text-black mt-1">{{ $stats['goals']['against']['total']['away'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-5 space-y-2">
                    <div class="flex justify-between text-sm font-bold">
                        <span class="text-gray-600">Clean Sheets:</span>
                        <span class="text-black">{{ $stats['clean_sheet']['total'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold">
                        <span class="text-gray-600">Média:</span>
                        <span class="text-black">{{ number_format($stats['goals']['against']['average']['total'] ?? 0, 2) }} por jogo</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ARTILHEIROS --}}
        <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-200">
            <h2 class="text-black text-3xl font-black mb-8 flex items-center gap-3 uppercase tracking-wide">
                <span class="text-4xl">🔥</span>
                ARTILHEIROS DA TEMPORADA
            </h2>

            @if(count($scorers) > 0)
            <div class="space-y-4">
                @foreach($scorers as $index => $item)
                <div class="bg-gray-50 rounded-2xl p-6 flex items-center gap-6 hover:bg-gray-100 transition transform hover:scale-[1.02] border border-gray-200">
                    
                    {{-- Ranking --}}
                    <div class="flex-shrink-0">
                        @if($index === 0)
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white font-black text-2xl shadow-lg">
                                1
                            </div>
                        @elseif($index === 1)
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-white font-black text-2xl shadow-lg">
                                2
                            </div>
                        @elseif($index === 2)
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-orange-600 to-orange-800 flex items-center justify-center text-white font-black text-2xl shadow-lg">
                                3
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-black text-2xl border-2 border-gray-400">
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
                         class="w-20 h-20 rounded-full border-4 border-gray-300 shadow-lg object-cover"
                         onerror="this.src='{{ $fallbackUrl }}'">

                    {{-- Info --}}
                    <div class="flex-1">
                        <p class="font-black text-black text-xl">{{ $item['player']['name'] }}</p>
                        <p class="text-gray-600 text-sm font-bold mt-1">{{ $item['games'] }} jogos disputados</p>
                    </div>

                    {{-- Stats --}}
                    <div class="text-right space-y-2">
                        <div class="flex items-center gap-3 justify-end">
                            <span class="text-3xl">⚽</span>
                            <span class="text-4xl font-black text-black">{{ $item['goals'] }}</span>
                        </div>
                        @if($item['assists'] > 0)
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-sm text-gray-600 font-bold">Assistências:</span>
                            <span class="text-sm font-black text-green-600">{{ $item['assists'] }}</span>
                        </div>
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600 text-lg font-bold">Nenhum artilheiro encontrado para esta temporada.</p>
                <p class="text-gray-500 text-sm mt-2">Os dados podem estar indisponíveis ou ainda não foram registrados.</p>
            </div>
            @endif
        </div>

        {{-- PRÓXIMO JOGO --}}
        @if($nextGame)
        <div class="bg-gradient-to-br from-black to-gray-900 rounded-3xl shadow-2xl p-8 border-4 border-white relative overflow-hidden">
            <!-- Listras sutis -->
            <div class="absolute inset-0 flex opacity-5">
                <div class="flex-1 bg-black"></div>
                <div class="w-3 bg-white"></div>
                <div class="flex-1 bg-black"></div>
                <div class="w-3 bg-white"></div>
                <div class="flex-1 bg-black"></div>
                <div class="w-3 bg-white"></div>
                <div class="flex-1 bg-black"></div>
            </div>

            <div class="relative z-10">
                <h2 class="text-white text-3xl font-black mb-8 flex items-center gap-3 uppercase tracking-wide">
                    📅 PRÓXIMO JOGO
                </h2>

                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    
                    {{-- Time Casa --}}
                    <div class="flex flex-col items-center text-center flex-1">
                        <img src="{{ $nextGame['teams']['home']['logo'] }}"
                             class="w-28 h-28 mb-4 drop-shadow-2xl">
                        <p class="text-white font-black text-2xl">{{ $nextGame['teams']['home']['name'] }}</p>
                    </div>

                    {{-- VS e Data --}}
                    <div class="text-center bg-white rounded-2xl p-6 shadow-xl">
                        <div class="text-black text-5xl font-black mb-3">VS</div>
                        <p class="text-gray-700 font-bold">
                            {{ \Carbon\Carbon::parse($nextGame['fixture']['date'])->format('d/m/Y') }}
                        </p>
                        <p class="text-black font-black text-xl mt-1">
                            {{ \Carbon\Carbon::parse($nextGame['fixture']['date'])->format('H:i') }}
                        </p>
                    </div>

                    {{-- Time Visitante --}}
                    <div class="flex flex-col items-center text-center flex-1">
                        <img src="{{ $nextGame['teams']['away']['logo'] }}"
                             class="w-28 h-28 mb-4 drop-shadow-2xl">
                        <p class="text-white font-black text-2xl">{{ $nextGame['teams']['away']['name'] }}</p>
                    </div>

                </div>

                <div class="mt-8 text-center">
                    <p class="text-white font-bold text-lg">
                        🏟️ {{ $nextGame['fixture']['venue']['name'] ?? 'Estádio a definir' }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        {{-- BOTÃO TODOS OS JOGOS --}}
        <div class="text-center pt-8 pb-12">
            <a href="/jogos"
               class="inline-flex items-center gap-3 bg-black text-white px-12 py-6 rounded-2xl text-xl font-black hover:bg-gray-900 transition transform hover:scale-105 shadow-2xl border-2 border-black uppercase tracking-wide">
                <span>📋</span>
                VER TODOS OS JOGOS
            </a>
        </div>

    </div>

</div>
@endsection