@extends('layouts.app')

@section('title', 'Идеи и советы - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Идеи и советы</h1>

    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($articles as $article)
                <a href="{{ route('blog.show', $article->slug) }}" class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}"
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $article->title }}</h3>
                        @if($article->excerpt)
                            <p class="text-gray-600 text-sm line-clamp-3">{{ $article->excerpt }}</p>
                        @endif
                        <div class="flex items-center mt-4 text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $article->published_at ? $article->published_at->format('d.m.Y') : $article->created_at->format('d.m.Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Пагинация -->
        <div class="flex justify-center mt-6">
            {{ $articles->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Статьи не найдены</h3>
            <p class="text-gray-600">В данный момент нет опубликованных статей</p>
        </div>
    @endif
</div>
@endsection
