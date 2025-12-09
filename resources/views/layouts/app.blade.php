<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimãoHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="bg-black text-white py-5 mb-8 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div class="flex items-center space-x-4">
                <!-- Escudo do Corinthians -->
                <img src="/images/corinthians.png" 
                     alt="Corinthians" 
                     class="h-14 w-14 object-contain">
                <h1 class="text-3xl font-bold">TimãoHub</h1>
            </div>

            <nav class="flex gap-12 text-base font-medium">
                <a href="/" class="hover:text-gray-300 transition-colors duration-200">Home</a>
                <a href="/jogos" class="hover:text-gray-300 transition-colors duration-200">Jogos</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo -->
    <main class="max-w-7xl mx-auto px-6 pb-12">
        @yield('content')
    </main>

</body>
</html>