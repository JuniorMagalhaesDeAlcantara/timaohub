<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimãoHub - {{ $title ?? 'Dashboard Corinthians' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Header Estilo Camisa 2 do Corinthians -->
    <header class="relative bg-black overflow-hidden sticky top-0 z-50 shadow-2xl">
        <!-- Listras Brancas -->
        <div class="absolute inset-0 flex">
            <div class="flex-1 bg-black"></div>
            <div class="w-3 bg-white opacity-20"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-3 bg-white opacity-20"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-3 bg-white opacity-20"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-3 bg-white opacity-20"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-3 bg-white opacity-20"></div>
            <div class="flex-1 bg-black"></div>
        </div>

        <!-- Conteúdo do Header -->
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-24">
                
                <!-- Logo e Título -->
                <a href="/" class="flex items-center gap-4 group z-10">
                    <div class="bg-white rounded-full p-2 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <img src="https://media.api-sports.io/football/teams/131.png" 
                             alt="Corinthians" 
                             class="h-12 w-12 object-contain">
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-wider">TIMÃOHUB</h1>
                        <p class="text-gray-300 text-sm font-bold tracking-wide">VAI CORINTHIANS!</p>
                    </div>
                </a>

                <!-- Navegação -->
                <nav class="flex gap-3 z-10">
                    <a href="/" 
                       class="flex items-center gap-2 px-8 py-4 rounded-xl font-black text-sm transition-all duration-300 uppercase tracking-wide
                              {{ request()->is('/') 
                                  ? 'bg-white text-black shadow-2xl transform scale-105' 
                                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm border border-white/30' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                    <a href="/jogos" 
                       class="flex items-center gap-2 px-8 py-4 rounded-xl font-black text-sm transition-all duration-300 uppercase tracking-wide
                              {{ request()->is('jogos') 
                                  ? 'bg-white text-black shadow-2xl transform scale-105' 
                                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm border border-white/30' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Jogos
                    </a>
                </nav>

            </div>
        </div>

        <!-- Borda inferior -->
        <div class="h-1 bg-gradient-to-r from-white via-gray-300 to-white"></div>
    </header>

    <!-- Conteúdo -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white mt-20 relative overflow-hidden">
        <!-- Listras sutis no footer também -->
        <div class="absolute inset-0 flex opacity-10">
            <div class="flex-1 bg-black"></div>
            <div class="w-2 bg-white"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-2 bg-white"></div>
            <div class="flex-1 bg-black"></div>
            <div class="w-2 bg-white"></div>
            <div class="flex-1 bg-black"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                
                <!-- Logo e Info -->
                <div class="flex items-center gap-4">
                    <div class="bg-white rounded-full p-2">
                        <img src="https://media.api-sports.io/football/teams/131.png" 
                             alt="Corinthians" 
                             class="h-12 w-12">
                    </div>
                    <div>
                        <p class="font-black text-xl text-white">TIMÃOHUB</p>
                        <p class="text-gray-400 text-sm">O site da Fiel</p>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="text-center md:text-right">
                    <p class="text-white font-bold">
                        © {{ date('Y') }} TimãoHub
                    </p>
                    <p class="text-gray-400 text-sm mt-1">
                        Dados fornecidos por API-Sports
                    </p>
                </div>

            </div>
        </div>
    </footer>

</body>
</html>