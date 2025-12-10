@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">

    <h1 class="text-3xl font-bold text-center mb-6">Jogos do Corinthians</h1>

    {{-- Próximos Jogos --}}
    <section>
        <h2 class="text-2xl font-semibold mb-3">Próximos Jogos</h2>
        <div class="space-y-4">
            @foreach ($upcoming as $game)
            @include('partials.game-card', ['game' => $game])
            @endforeach
        </div>
    </section>

    {{-- Últimos Jogos --}}
    <section>
        <h2 class="text-2xl font-semibold mb-3">Últimos Jogos</h2>
        <div class="space-y-4">
            @foreach ($latest as $game)
            @include('partials.game-card', ['game' => $game])
            @endforeach
        </div>
    </section>

</div>
@endsection