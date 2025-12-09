<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimãoHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-black text-white py-4 mb-6 shadow">
        <div class="max-w-4xl mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">⚫⚪ TimãoHub</h1>

            <nav class="space-x-4">
                <a href="/" class="hover:text-gray-300">Home</a>
                <a href="/jogos" class="hover:text-gray-300">Jogos</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo -->
    <main class="max-w-4xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
