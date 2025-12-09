@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Times do Brasileirão 2025</h2>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    @foreach($teams as $teamData)
        @php
            $team = $teamData['team'];
        @endphp
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <img src="{{ $team['logo'] }}" alt="{{ $team['name'] }}" class="h-16 w-16 mx-auto object-contain mb-2">
            <p class="font-semibold">{{ $team['name'] }}</p>
        </div>
    @endforeach
</div>
@endsection
