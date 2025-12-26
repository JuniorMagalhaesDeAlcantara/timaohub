<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central do Timão - {{ $title ?? 'Dashboard Corinthians' }}</title>

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
                        <h1 class="text-3xl font-black text-white tracking-wider">CENTRAL DO TIMÃO</h1>
                        <p class="text-gray-300 text-sm font-bold tracking-wide">VAI CORINTHIANS</p>
                    </div>
                </a>

                <!-- Navegação -->
                <nav class="flex gap-3 z-10">

                    <!-- Notícias (HOME) -->
                    <a href="/"
                        class="flex items-center gap-2 px-8 py-4 rounded-xl font-black text-sm transition-all duration-300 uppercase tracking-wide
              {{ request()->is('/') 
                  ? 'bg-white text-black shadow-2xl transform scale-105' 
                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm border border-white/30' }}">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 20H5a2 2 0 01-2-2V8a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v10a2 2 0 01-2 2z" />
                        </svg>
                        Notícias
                    </a>

                    <!-- Estatísticas -->
                    <a href="/estatisticas"
                        class="flex items-center gap-2 px-8 py-4 rounded-xl font-black text-sm transition-all duration-300 uppercase tracking-wide
              {{ request()->is('estatisticas') 
                  ? 'bg-white text-black shadow-2xl transform scale-105' 
                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm border border-white/30' }}">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M11 3v18m4-14v14m4-10v10M7 13v8M3 17v4" />
                        </svg>
                        Estatísticas
                    </a>

                    <!-- Jogos -->
                    <a href="/jogos"
                        class="flex items-center gap-2 px-8 py-4 rounded-xl font-black text-sm transition-all duration-300 uppercase tracking-wide
              {{ request()->is('jogos') 
                  ? 'bg-white text-black shadow-2xl transform scale-105' 
                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm border border-white/30' }}">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
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
                        <p class="font-black text-xl text-white">CENTRAL DO TIMÃO</p>
                        <p class="text-gray-400 text-sm">O site da Fiel</p>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="text-center md:text-right">
                    <p class="text-white font-bold">
                        © {{ date('Y') }} Central do Timão
                    </p>
                    <p class="text-gray-400 text-sm mt-1">
                        Dados fornecidos por API-Sports
                    </p>
                </div>

            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>