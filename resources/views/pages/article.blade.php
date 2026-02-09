@extends('layouts.app')

@section('title', $article->title . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <article class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Изображение -->
        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}"
                 alt="{{ $article->title }}"
                 class="w-full h-64 md:h-96 object-cover">
        @endif

        <!-- Контент -->
        <div class="p-6">
            <!-- Заголовок и дата -->
            <div class="mb-4">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $article->published_at ? $article->published_at->format('d.m.Y') : $article->created_at->format('d.m.Y') }}</span>
                    
                    <span class="mx-2">•</span>
                    
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>{{ $article->views }} просмотров</span>
                </div>
            </div>
            
            <!-- Краткое описание -->
            @if($article->excerpt)
                <p class="text-lg text-gray-700 mb-4 italic border-l-4 border-orange-500 pl-4">
                    {{ $article->excerpt }}
                </p>
            @endif
            
            <!-- Основной контент -->
            <div class="prose max-w-none text-gray-700">
                {!! $article->content !!}
            </div>
            
            <!-- Автор -->
            @if($article->user)
                <div class="mt-6 pt-6 border-t flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-semibold">
                        {{ substr($article->user->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-900">{{ $article->user->name }}</p>
                        <p class="text-sm text-gray-500">Автор статьи</p>
                    </div>
                </div>
            @endif
        </div>
    </article>
    
    <!-- Похожие статьи -->
    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
        <section class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Похожие статьи</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedArticles as $relatedArticle)
                    <a href="{{ route('blog.show', $relatedArticle->slug) }}" class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">
                        @if($relatedArticle->image)
                            <img src="{{ asset('storage/' . $relatedArticle->image) }}" 
                                 alt="{{ $relatedArticle->title }}"
                                 class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $relatedArticle->title }}</h3>
                            @if($relatedArticle->excerpt)
                                <p class="text-gray-600 text-sm line-clamp-2">{{ $relatedArticle->excerpt }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
