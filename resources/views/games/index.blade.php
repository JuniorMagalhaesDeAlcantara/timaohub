@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-bold mb-4">Jogos do Corinthians 🦅⚽</h2>

@if ($games->isEmpty())
    <p class="text-gray-600">Nenhum jogo cadastrado ainda.</p>
@else
    <div class="bg-white shadow rounded p-4">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="py-2 text-left">Adversário</th>
                    <th class="py-2 text-left">Estádio</th>
                    <th class="py-2 text-left">Data</th>
                    <th class="py-2 text-left">Resultado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                    <tr class="border-b">
                        <td class="py-2">{{ $game->opponent }}</td>
                        <td class="py-2">{{ $game->stadium }}</td>
                        <td class="py-2">{{ date('d/m/Y', strtotime($game->match_date)) }}</td>
                        <td class="py-2">{{ $game->result ?? '--' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
