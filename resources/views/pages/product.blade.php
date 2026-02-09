@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Галерея изображений -->
            <div>
                <div class="mb-4">
                    @if($product->primaryImage())
                        <img id="mainImage" 
                             src="{{ asset('storage/' . $product->primaryImage()->image_path) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-96 object-contain rounded-lg">
                    @else
                        <img id="mainImage" 
                             src="{{ asset('images/no-image.png') }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-96 object-contain rounded-lg">
                    @endif
                </div>
                
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->images as $index => $image)
                            <button onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')" 
                                    class="border-2 {{ $image->is_primary ? 'border-orange-500' : 'border-gray-200' }} rounded-lg p-2 hover:border-orange-500 transition">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-20 object-contain">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Информация о товаре -->
            <div>
                <!-- Бейджи -->
                <div class="flex items-center space-x-2 mb-4">
                    @if($product->getDiscountPercent())
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            -{{ $product->getDiscountPercent() }}%
                        </span>
                    @endif
                    @if($product->is_new)
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Новинка
                        </span>
                    @endif
                    @if($product->is_featured)
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Хит продаж
                        </span>
                    @endif
                </div>
                
                <!-- Название и артикул -->
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <p class="text-gray-500 mb-4">Артикул: {{ $product->sku }}</p>
                
                <!-- Рейтинг -->
                <div class="flex items-center mb-4">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $product->rating)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-600 ml-2">{{ $product->rating }} ({{ $product->reviews_count }} отзывов)</span>
                </div>
                
                <!-- Цена -->
                <div class="mb-6">
                    @if($product->old_price && $product->old_price > $product->price)
                        <div class="flex items-center gap-3">
                            <span class="text-4xl font-bold text-orange-600">
                                {{ number_format($product->price, 0, ',', ' ') }} ₽
                            </span>
                            <span class="text-xl text-gray-400 line-through">
                                {{ number_format($product->old_price, 0, ',', ' ') }} ₽
                            </span>
                        </div>
                    @else
                        <span class="text-4xl font-bold text-gray-900">
                            {{ number_format($product->price, 0, ',', ' ') }} ₽
                        </span>
                    @endif
                    <span class="text-gray-500">/ {{ $product->unit }}</span>
                </div>
                
                <!-- Наличие -->
                <div class="mb-6">
                    @if($product->isInStock())
                        <p class="text-green-600 font-medium">
                            ✓ В наличии: {{ $product->stock }} {{ $product->unit }}
                        </p>
                    @else
                        <p class="text-red-600 font-medium">
                            ✗ Нет в наличии
                        </p>
                    @endif
                </div>
                
                <!-- Кнопки действий -->
                <div class="flex items-center space-x-4 mb-6">
                    @if($product->isInStock())
                        <div class="flex items-center space-x-2">
                            <button onclick="decrementQuantity()" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="quantity" value="{{ $product->min_order_quantity }}" min="{{ $product->min_order_quantity }}" 
                                   class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <button onclick="incrementQuantity()" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                        <button type="button" data-product-id="{{ $product->id }}"
                                class="add-to-cart-btn flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                            В корзину
                        </button>
                    @else
                        <button disabled class="flex-1 bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-lg cursor-not-allowed">
                            Недоступно
                        </button>
                    @endif
                    
                    <button onclick="toggleWishlist({{ $product->id }})"
                            class="w-12 h-12 border border-gray-300 hover:border-orange-500 rounded-lg flex items-center justify-center transition">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Категория и бренд -->
                <div class="border-t pt-4">
                    <div class="flex items-center mb-2">
                        <span class="text-gray-500 w-24">Категория:</span>
                        <a href="{{ route('catalog.category', $product->category->slug) }}" class="text-orange-600 hover:text-orange-700">
                            {{ $product->category->name }}
                        </a>
                    </div>
                    @if($product->brand)
                        <div class="flex items-center">
                            <span class="text-gray-500 w-24">Бренд:</span>
                            <a href="{{ route('catalog.brand', $product->brand->slug) }}" class="text-orange-600 hover:text-orange-700 font-medium">
                                {{ $product->brand->name }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Описание и характеристики -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Описание -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Описание</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
        
        <!-- Характеристики -->
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Характеристики</h2>
                @php
                    $features = is_string($product->features) ? json_decode($product->features, true) ?? [] : ($product->features ?? []);
                @endphp
                @if(!empty($features))
                    <div class="space-y-3">
                        @foreach($features as $key => $value)
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">{{ $key }}</span>
                                <span class="font-medium">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Характеристики не указаны</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Похожие товары -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-6">Похожие товары</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
