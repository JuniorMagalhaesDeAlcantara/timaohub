@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

    <!-- DESTAQUE -->
    @if(!empty($destaque))
        <a href="{{ route('noticias.show', $destaque['slug']) }}"
           class="block mb-10 sm:mb-16 group">

            <div class="relative h-[360px] sm:h-[480px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">

                @if(!empty($destaque['image']))
                    <img src="{{ $destaque['image'] }}"
                         alt="{{ $destaque['title'] ?? 'Notícia em destaque' }}"
                         class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-gray-700 flex items-center justify-center">
                        <span class="text-white/20 font-black text-4xl">Central do Timão</span>
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                <div class="absolute inset-0 flex flex-col justify-end p-6 sm:p-10">
                    <span class="inline-flex items-center gap-2 bg-white/95 backdrop-blur-sm text-black px-4 py-1.5 rounded-full text-xs font-bold mb-4 w-fit shadow-lg">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        DESTAQUE
                    </span>

                    <h2 class="text-2xl sm:text-3xl lg:text-5xl font-extrabold text-white mb-3 leading-tight drop-shadow-2xl">
                        {{ $destaque['title'] ?? '' }}
                    </h2>

                    <p class="text-gray-100 text-sm sm:text-base max-w-3xl leading-relaxed line-clamp-2 drop-shadow-lg">
                        {{ $destaque['excerpt'] ?? '' }}
                    </p>
                </div>
            </div>
        </a>
    @endif

    <!-- GRID DE NOTÍCIAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        @foreach ($noticias as $noticia)
            <a href="{{ route('noticias.show', $noticia['slug']) }}"
               class="group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                <div class="relative overflow-hidden">
                    @if(!empty($noticia['image']))
                        <img src="{{ $noticia['image'] }}"
                             alt="{{ $noticia['title'] ?? 'Notícia' }}"
                             class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-48 sm:h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 font-semibold text-sm">Central do Timão</span>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                </div>

                <div class="p-5 sm:p-6">
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg mb-2 sm:mb-3 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                        {{ $noticia['title'] ?? '' }}
                    </h3>

                    <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                        {{ $noticia['excerpt'] ?? '' }}
                    </p>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs font-medium text-gray-500">
                            {{ $noticia['source']['name'] ?? 'Fonte desconhecida' }}
                        </span>
                        
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach

    </div>

    <!-- PAGINAÇÃO -->
    @if(isset($noticias) && method_exists($noticias, 'links'))
        <div class="mt-12">
            {{ $noticias->links() }}
        </div>
    @endif
</div>
@endsection
