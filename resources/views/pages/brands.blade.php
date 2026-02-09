@extends('layouts.app')

@section('title', 'Бренды - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <h1 class="text-3xl font-bold text-gray-900 mb-6">Бренды</h1>

    @if($brands->count() > 0)
        <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-3 mb-6">
            @foreach($brands as $brand)
                <a href="{{ route('catalog.brand', $brand->slug) }}"
                   class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-6 text-center group">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}"
                             alt="{{ $brand->name }}"
                             class="w-24 h-24 mx-auto mb-4 object-contain">
                    @else
                        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-3xl font-bold text-gray-400">{{ substr($brand->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-600 transition mb-2">
                        {{ $brand->name }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $brand->products_count }} {{ $brand->products_count == 1 ? 'товар' : ($brand->products_count < 5 ? 'товара' : 'товаров') }}
                    </p>
                </a>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="flex justify-center">
            {{ $brands->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Бренды не найдены</h3>
            <p class="text-gray-600 mb-4">В данный момент нет доступных брендов</p>
            <a href="{{ route('catalog.index') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Перейти в каталог
            </a>
        </div>
    @endif
</div>
@endsection
