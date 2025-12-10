@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">{{ $team['name'] }} - Brasileirão 2025</h2>

<div class="bg-white p-4 rounded-lg shadow text-center w-48 mx-auto">
    <img src="{{ $team['logo'] }}" alt="{{ $team['name'] }}" class="h-24 w-24 mx-auto object-contain mb-2">
    <p class="font-semibold">{{ $team['name'] }}</p>
</div>
@endsection
