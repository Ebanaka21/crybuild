@extends('layouts.app')

@section('title', $promotion->name . ' - Акции - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <!-- Заголовок акции -->
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <span class="inline-block bg-white text-orange-600 px-4 py-2 rounded-full text-lg font-bold mb-4">
                    {{ $promotion->discount_type === 'percent' ? '-' . $promotion->discount_value . '%' : '-' . number_format($promotion->discount_value, 0, ',', ' ') . ' ₽' }}
                </span>
                <h1 class="text-4xl font-bold mb-2">{{ $promotion->name }}</h1>
                @if($promotion->description)
                    <p class="text-white/90 text-lg">{{ $promotion->description }}</p>
                @endif
            </div>
            @if($promotion->image)
                <img src="{{ asset('storage/' . $promotion->image) }}" 
                     alt="{{ $promotion->name }}"
                     class="w-48 h-48 object-contain hidden md:block">
            @endif
        </div>
        
        <div class="mt-6 flex items-center text-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Акция действует с {{ $promotion->start_date->format('d.m.Y') }} по {{ $promotion->end_date->format('d.m.Y') }}</span>
        </div>
    </div>
    
    <!-- Товары акции -->
    @if(isset($products) && $products->count() > 0)
        <div class="mb-4">
            <h2 class="text-2xl font-bold mb-4">Товары по акции</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
        
        <!-- Пагинация -->
        <div class="flex justify-center mt-6">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Товары не найдены</h3>
            <p class="text-gray-600">В данной акции пока нет товаров</p>
        </div>
    @endif
</div>
@endsection
