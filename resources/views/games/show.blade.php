@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">

        @php
        $corinthiansId = 131;
        $homeTeam = $fixture['teams']['home'];
        $awayTeam = $fixture['teams']['away'];
        $homeGoals = $fixture['goals']['home'] ?? 0;
        $awayGoals = $fixture['goals']['away'] ?? 0;

        $isCorinthiansHome = $homeTeam['id'] == $corinthiansId;
        $isCorinthiansAway = $awayTeam['id'] == $corinthiansId;
        $corinthiansWon = false;

        if ($isCorinthiansHome && $homeGoals > $awayGoals) {
        $corinthiansWon = true;
        } elseif ($isCorinthiansAway && $awayGoals > $homeGoals) {
        $corinthiansWon = true;
        }

        $statusMap = [
        'Match Finished' => 'Partida Encerrada',
        'First Half' => 'Primeiro Tempo',
        'Second Half' => 'Segundo Tempo',
        'Halftime' => 'Intervalo',
        'Not Started' => 'Não Iniciado',
        'Time to be defined' => 'Horário a Definir',
        'Match Postponed' => 'Partida Adiada',
        'Match Cancelled' => 'Partida Cancelada',
        'Match Suspended' => 'Partida Suspensa',
        ];

        $statusPt = $statusMap[$fixture['fixture']['status']['long']] ?? $fixture['fixture']['status']['long'];

        // Traduzir round
        $round = $fixture['league']['round'];
        $round = str_replace('Regular Season - ', 'Rodada ', $round);
        @endphp

        {{-- CABEÇALHO COM RESULTADO - Com destaque preto e dourado se Corinthians ganhou --}}
        <div class="relative overflow-hidden {{ $corinthiansWon ? 'bg-gradient-to-br from-black via-gray-900 to-black' : 'bg-gradient-to-br from-gray-900 via-black to-gray-900' }} rounded-3xl shadow-2xl border-4 {{ $corinthiansWon ? 'border-yellow-500' : 'border-gray-800' }} mb-8">

            @if($corinthiansWon)
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI0ZGRDcwMCIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')]"></div>
            </div>
            @endif

            <div class="relative z-10 p-8">

                {{-- Info da competição --}}
                <div class="text-center mb-6">
                    <p class="text-white/80 text-sm font-bold mb-1">
                        {{ $fixture['league']['name'] }} • {{ $fixture['league']['season'] }}
                    </p>
                    <p class="text-white/60 text-xs">
                        {{ $round }}
                    </p>
                    @if($corinthiansWon)
                    <div class="mt-2 inline-flex items-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 backdrop-blur px-4 py-2 rounded-full shadow-xl">
                        <span class="text-2xl">🏆</span>
                        <span class="text-black font-black uppercase tracking-wide">VITÓRIA!</span>
                    </div>
                    @endif
                </div>

                {{-- Placar --}}
                <div class="flex items-center justify-center gap-8 md:gap-16">

                    {{-- Time Casa --}}
                    <div class="flex flex-col items-center {{ $isCorinthiansHome ? 'scale-110' : '' }} transition">
                        <img src="{{ $homeTeam['logo'] }}"
                            class="w-24 h-24 md:w-32 md:h-32 mb-4 drop-shadow-2xl {{ $homeGoals > $awayGoals && $corinthiansWon && $isCorinthiansHome ? 'ring-4 ring-yellow-400 rounded-full p-2' : ($homeGoals > $awayGoals ? 'ring-4 ring-yellow-400 rounded-full p-2' : '') }}">
                        <p class="text-white font-black text-xl md:text-2xl text-center">
                            {{ $homeTeam['name'] }}
                        </p>
                        @if($isCorinthiansHome)
                        <span class="text-xs text-yellow-400 mt-1 font-bold">TIMÃO</span>
                        @endif
                    </div>

                    {{-- Placar Central --}}
                    <div class="text-center">
                        <div class="flex items-center gap-4">
                            <div class="text-6xl md:text-8xl font-black {{ $homeGoals > $awayGoals && $corinthiansWon && $isCorinthiansHome ? 'text-yellow-400' : ($homeGoals > $awayGoals ? 'text-yellow-300' : 'text-white') }}">
                                {{ $homeGoals }}
                            </div>
                            <div class="text-4xl md:text-6xl font-black text-white/40">×</div>
                            <div class="text-6xl md:text-8xl font-black {{ $awayGoals > $homeGoals && $corinthiansWon && $isCorinthiansAway ? 'text-yellow-400' : ($awayGoals > $homeGoals ? 'text-yellow-300' : 'text-white') }}">
                                {{ $awayGoals }}
                            </div>
                        </div>
                        <div class="mt-4 bg-white/20 backdrop-blur rounded-full px-6 py-2">
                            <p class="text-white font-bold text-sm">
                                {{ $statusPt }}
                            </p>
                        </div>
                    </div>

                    {{-- Time Visitante --}}
                    <div class="flex flex-col items-center {{ $isCorinthiansAway ? 'scale-110' : '' }} transition">
                        <img src="{{ $awayTeam['logo'] }}"
                            class="w-24 h-24 md:w-32 md:h-32 mb-4 drop-shadow-2xl {{ $awayGoals > $homeGoals && $corinthiansWon && $isCorinthiansAway ? 'ring-4 ring-yellow-400 rounded-full p-2' : ($awayGoals > $homeGoals ? 'ring-4 ring-yellow-400 rounded-full p-2' : '') }}">
                        <p class="text-white font-black text-xl md:text-2xl text-center">
                            {{ $awayTeam['name'] }}
                        </p>
                        @if($isCorinthiansAway)
                        <span class="text-xs text-yellow-400 mt-1 font-bold">TIMÃO</span>
                        @endif
                    </div>

                </div>

                {{-- Informações adicionais --}}
                <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white/10 backdrop-blur rounded-xl p-3 text-center">
                        <p class="text-white/60 text-xs mb-1">Data</p>
                        <p class="text-white font-bold text-sm">
                            {{ \Carbon\Carbon::parse($fixture['fixture']['date'])->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-3 text-center">
                        <p class="text-white/60 text-xs mb-1">Horário</p>
                        <p class="text-white font-bold text-sm">
                            {{ \Carbon\Carbon::parse($fixture['fixture']['date'])->format('H:i') }}
                        </p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-3 text-center">
                        <p class="text-white/60 text-xs mb-1">Estádio</p>
                        <p class="text-white font-bold text-sm">
                            {{ $fixture['fixture']['venue']['name'] ?? 'A definir' }}
                        </p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-3 text-center">
                        <p class="text-white/60 text-xs mb-1">Árbitro</p>
                        <p class="text-white font-bold text-sm">
                            {{ $fixture['fixture']['referee'] ?? 'Não informado' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="h-2 {{ $corinthiansWon ? 'bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600' : 'bg-gradient-to-r from-gray-600 via-gray-400 to-gray-600' }}"></div>
        </div>

        {{-- TABS DE NAVEGAÇÃO --}}
        <div class="bg-white rounded-2xl shadow-lg mb-6 overflow-hidden">
            <div class="flex overflow-x-auto scrollbar-hide">
                <button class="tab-btn active flex-1 px-6 py-4 font-bold text-sm whitespace-nowrap border-b-4 border-black transition" data-tab="lineups">
                    👥 ESCALAÇÕES
                </button>
                <button class="tab-btn flex-1 px-6 py-4 font-bold text-sm whitespace-nowrap border-b-4 border-transparent hover:bg-gray-50 transition" data-tab="timeline">
                    ⚡ TIMELINE
                </button>
                <button class="tab-btn flex-1 px-6 py-4 font-bold text-sm whitespace-nowrap border-b-4 border-transparent hover:bg-gray-50 transition" data-tab="stats">
                    📊 ESTATÍSTICAS
                </button>
            </div>
        </div>

        {{-- CONTEÚDO DAS TABS --}}
        <div class="space-y-6">

            {{-- ESCALAÇÕES - PRIMEIRA ABA --}}
            <div id="tab-lineups" class="tab-content">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-black mb-6 flex items-center gap-3">
                        <span class="text-3xl">👥</span>
                        ESCALAÇÕES
                    </h2>

                    @if(!empty($fixture['lineups']))
                    <div class="grid md:grid-cols-2 gap-8">
                        @foreach($fixture['lineups'] as $lineup)
                        <div>
                            {{-- Cabeçalho do time --}}
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b-2">
                                <img src="{{ $lineup['team']['logo'] }}" class="w-12 h-12">
                                <div>
                                    <p class="font-black text-xl">{{ $lineup['team']['name'] }}</p>
                                    <p class="text-sm text-gray-500 font-bold">Formação: {{ $lineup['formation'] ?? 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- Campo de Futebol com posicionamento tático --}}
                            <div class="relative bg-gradient-to-b from-green-500 to-green-600 rounded-2xl p-4 mb-6 shadow-inner" style="height: 480px;">
                                {{-- Linhas do campo --}}
                                <div class="absolute inset-0 opacity-20 pointer-events-none">
                                    <div class="absolute top-1/2 left-0 w-full h-px bg-white"></div>

                                    <div class="absolute top-1/2 left-1/2 w-20 h-20 border-2 border-white rounded-full -ml-10 -mt-10"></div>
                                    <div class="absolute top-1/2 left-1/2 w-2 h-2 bg-white rounded-full -ml-1 -mt-1"></div>

                                    {{-- Área do gol superior --}}
                                    <div class="absolute top-0 left-1/2 w-32 h-16 border-2 border-white border-t-0 -ml-16"></div>
                                    <div class="absolute top-0 left-1/2 w-20 h-8 border-2 border-white border-t-0 -ml-10"></div>

                                    {{-- Área do gol inferior --}}
                                    <div class="absolute bottom-0 left-1/2 w-32 h-16 border-2 border-white border-b-0 -ml-16"></div>
                                    <div class="absolute bottom-0 left-1/2 w-20 h-8 border-2 border-white border-b-0 -ml-10"></div>
                                </div>

                                @php
                                $formation = $lineup['formation'] ?? '4-4-2';
                                $formationParts = explode('-', $formation);
                                $startXI = $lineup['startXI'] ?? [];

                                // Organizar jogadores por posição
                                $positions = [
                                'G' => [], // Goleiro
                                'D' => [], // Defesa
                                'M' => [], // Meio-campo
                                'F' => [] // Ataque
                                ];

                                foreach($startXI as $player) {
                                $pos = $player['player']['pos'];
                                $positions[$pos][] = $player;
                                }

                                // Definir altura das linhas (de baixo para cima: Goleiro, Defesa, Meio, Ataque)
                                $linePositions = [
                                'G' => 'bottom-3',
                                'D' => 'bottom-[28%]',
                                'M' => 'top-[32%]',
                                'F' => 'top-6'
                                ];
                                @endphp

                                {{-- Posicionar jogadores no campo --}}
                                <div class="relative h-full">
                                    @foreach(['G', 'D', 'M', 'F'] as $posType)
                                    @if(!empty($positions[$posType]))
                                    <div class="absolute left-0 right-0 {{ $linePositions[$posType] }} flex justify-around items-center px-2">
                                        @foreach($positions[$posType] as $player)
                                        <div class="flex flex-col items-center">
                                            <div class="bg-white rounded-full w-11 h-11 flex items-center justify-center font-black text-xs shadow-lg border-2 border-gray-800 mb-1">
                                                {{ $player['player']['number'] }}
                                            </div>
                                            <span class="text-white text-[10px] font-bold text-center drop-shadow-lg max-w-[60px] leading-tight">
                                                {{ explode(' ', $player['player']['name'])[count(explode(' ', $player['player']['name'])) - 1] }}
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- Lista de jogadores --}}
                            <div class="space-y-2">
                                <p class="font-black text-sm uppercase text-gray-500 mb-3">Titulares</p>
                                @foreach($lineup['startXI'] as $player)
                                @php
                                $posMap = [
                                'G' => 'Goleiro',
                                'D' => 'Defensor',
                                'M' => 'Meio-campo',
                                'F' => 'Atacante'
                                ];
                                $posPt = $posMap[$player['player']['pos']] ?? $player['player']['pos'];
                                @endphp
                                <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="w-8 h-8 bg-black text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ $player['player']['number'] }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-sm">{{ $player['player']['name'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $posPt }}</p>
                                    </div>
                                </div>
                                @endforeach

                                @if(!empty($lineup['substitutes']))
                                <p class="font-black text-sm uppercase text-gray-500 mb-3 mt-6">Reservas</p>
                                @foreach($lineup['substitutes'] as $player)
                                @php
                                $posPt = $posMap[$player['player']['pos']] ?? $player['player']['pos'];
                                @endphp
                                <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition opacity-60">
                                    <div class="w-8 h-8 bg-gray-400 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ $player['player']['number'] }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-sm">{{ $player['player']['name'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $posPt }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Escalações não disponíveis</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- TIMELINE - SEGUNDA ABA --}}
            <div id="tab-timeline" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-black mb-6 flex items-center gap-3">
                        <span class="text-3xl">⚡</span>
                        EVENTOS DA PARTIDA
                    </h2>

                    @if(!empty($fixture['events']))
                    <div class="relative">
                        {{-- Linha vertical central - agora atrás dos círculos --}}
                        <div class="absolute left-1/2 top-8 bottom-8 w-1 bg-gray-200 -ml-0.5 hidden md:block" style="z-index: 0;"></div>

                        <div class="space-y-4">
                            @foreach($fixture['events'] as $event)
                            @php
                            $isHome = $event['team']['id'] == $homeTeam['id'];
                            $eventTypeMap = [
                            'Goal' => ['icon' => '⚽', 'color' => 'green', 'label' => 'Gol'],
                            'Card' => ['icon' => ($event['detail'] == 'Yellow Card' ? '🟨' : '🟥'), 'color' => ($event['detail'] == 'Yellow Card' ? 'yellow' : 'red'), 'label' => ($event['detail'] == 'Yellow Card' ? 'Cartão Amarelo' : 'Cartão Vermelho')],
                            'subst' => ['icon' => '🔄', 'color' => 'blue', 'label' => 'Substituição'],
                            'Var' => ['icon' => '📹', 'color' => 'purple', 'label' => 'VAR'],
                            ];

                            $eventInfo = $eventTypeMap[$event['type']] ?? ['icon' => '•', 'color' => 'gray', 'label' => $event['type']];

                            $detailMap = [
                            'Normal Goal' => 'Gol',
                            'Own Goal' => 'Gol Contra',
                            'Penalty' => 'Pênalti',
                            'Missed Penalty' => 'Pênalti Perdido',
                            'Yellow Card' => 'Cartão Amarelo',
                            'Red Card' => 'Cartão Vermelho',
                            'Substitution 1' => 'Substituição',
                            'Substitution 2' => 'Substituição',
                            'Substitution 3' => 'Substituição',
                            ];

                            $detailPt = $detailMap[$event['detail']] ?? $event['detail'];
                            @endphp

                            <div class="flex items-center gap-4 {{ $isHome ? 'md:flex-row' : 'md:flex-row-reverse' }}" style="position: relative; z-index: 1;">

                                {{-- Evento (lado esquerdo no desktop) --}}
                                <div class="flex-1 {{ $isHome ? 'md:text-right' : 'md:text-left' }}">
                                    <div class="bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition inline-block {{ $isHome ? 'md:float-right' : 'md:float-left' }} max-w-md">
                                        <div class="flex items-center gap-3 {{ $isHome ? 'md:flex-row-reverse' : '' }}">
                                            <div class="text-3xl">{{ $eventInfo['icon'] }}</div>
                                            <div class="flex-1">
                                                <p class="font-black text-sm text-{{ $eventInfo['color'] }}-600">
                                                    {{ $detailPt }}
                                                </p>
                                                <p class="font-bold text-black mt-1">
                                                    {{ $event['player']['name'] }}
                                                </p>
                                                @if(!empty($event['assist']['name']))
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Assistência: {{ $event['assist']['name'] }}
                                                </p>
                                                @endif
                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $event['team']['name'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Minuto (centro) - agora com z-index maior --}}
                                <div class="flex-shrink-0 w-16 text-center" style="position: relative; z-index: 2;">
                                    <div class="bg-black text-white font-black text-lg rounded-full w-14 h-14 flex items-center justify-center mx-auto shadow-lg">
                                        {{ $event['time']['elapsed'] }}'
                                    </div>
                                </div>

                                {{-- Espaço (outro lado) --}}
                                <div class="flex-1 hidden md:block"></div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Nenhum evento registrado ainda</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ESTATÍSTICAS --}}
            <div id="tab-stats" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-black mb-6 flex items-center gap-3">
                        <span class="text-3xl">📊</span>
                        ESTATÍSTICAS
                    </h2>

                    @if(!empty($fixture['statistics']))
                    @php
                    $homeStats = collect($fixture['statistics'][0]['statistics'] ?? [])->keyBy('type');
                    $awayStats = collect($fixture['statistics'][1]['statistics'] ?? [])->keyBy('type');

                    $statsLabels = [
                    'Shots on Goal' => 'Chutes no Gol',
                    'Shots off Goal' => 'Chutes pra Fora',
                    'Total Shots' => 'Total de Chutes',
                    'Blocked Shots' => 'Chutes Bloqueados',
                    'Shots insidebox' => 'Chutes na Área',
                    'Shots outsidebox' => 'Chutes Fora da Área',
                    'Fouls' => 'Faltas',
                    'Corner Kicks' => 'Escanteios',
                    'Offsides' => 'Impedimentos',
                    'Ball Possession' => 'Posse de Bola',
                    'Yellow Cards' => 'Cartões Amarelos',
                    'Red Cards' => 'Cartões Vermelhos',
                    'Goalkeeper Saves' => 'Defesas do Goleiro',
                    'Total passes' => 'Total de Passes',
                    'Passes accurate' => 'Passes Certos',
                    'Passes %' => 'Passes %',
                    ];
                    @endphp

                    <div class="space-y-6">
                        @foreach($statsLabels as $statKey => $statLabel)
                        @php
                        $homeValue = $homeStats->get($statKey)['value'] ?? 0;
                        $awayValue = $awayStats->get($statKey)['value'] ?? 0;

                        // Remove % para cálculo
                        $homeNum = is_numeric($homeValue) ? (float)$homeValue : (float)str_replace('%', '', $homeValue);
                        $awayNum = is_numeric($awayValue) ? (float)$awayValue : (float)str_replace('%', '', $awayValue);

                        $total = $homeNum + $awayNum;
                        $homePercent = $total > 0 ? ($homeNum / $total) * 100 : 50;
                        $awayPercent = $total > 0 ? ($awayNum / $total) * 100 : 50;
                        @endphp

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">{{ $homeValue }}</span>
                                <span class="text-gray-600 text-sm font-bold uppercase">{{ $statLabel }}</span>
                                <span class="font-bold text-sm">{{ $awayValue }}</span>
                            </div>
                            <div class="flex h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="bg-blue-500 transition-all duration-500" style="width: {{ $homePercent }}%"></div>
                                <div class="bg-red-500 transition-all duration-500" style="width: {{ $awayPercent }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Estatísticas não disponíveis</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Botão Voltar --}}
        <div class="mt-8 text-center">
            <a href="/" class="inline-flex items-center gap-2 bg-black text-white px-8 py-4 rounded-xl font-bold hover:bg-gray-800 transition shadow-lg">
                ← Voltar para Home
            </a>
        </div>

    </div>
</div>
@endsection
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');

                // Remove active de todos
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-black');
                    btn.classList.add('border-transparent');
                });
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Adiciona active no clicado
                button.classList.add('active', 'border-black');
                button.classList.remove('border-transparent');
                document.getElementById('tab-' + tabName).classList.remove('hidden');
            });
        });
    });
</script>