@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-2 sm:px-3 md:px-4 py-3 sm:py-4 md:py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <div class="bg-white rounded-lg shadow p-3 sm:p-5 md:p-6 mb-4 sm:mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Галерея изображений -->
            <div>
                <div class="mb-2 sm:mb-3 md:mb-4">
                    @if($product->primaryImage())
                        <img id="mainImage"
                             src="{{ asset('storage/' . $product->primaryImage()->image_path) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-40 sm:h-64 md:h-96 object-contain rounded-lg transition-opacity duration-300">
                    @else
                        <img id="mainImage"
                             src="{{ asset('images/no-image.png') }}"
                             alt="{{ $product->name }}"
                             class="w-full h-40 sm:h-64 md:h-96 object-contain rounded-lg transition-opacity duration-300">
                    @endif
                </div>

                @if($product->images->count() > 1)
                    <div class="overflow-x-auto pb-2 -mx-3 sm:-mx-5 md:-mx-6 px-3 sm:px-5 md:px-6">
                        <div class="flex gap-1 sm:gap-2 w-max">
                            @foreach($product->images as $index => $image)
                                <button type="button"
                                        onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                        class="border-2 border-gray-200 hover:border-orange-500 rounded-lg p-1 sm:p-2 hover:shadow-md active:shadow-lg transition cursor-pointer shrink-0"
                                        title="{{ $product->name }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                         alt="{{ $product->name }}"
                                         class="h-16 sm:h-20 w-16 sm:w-20 object-contain">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Информация о товаре -->
            <div>
                <!-- Бейджи -->
                <div class="flex items-center space-x-1 sm:space-x-2 mb-2 sm:mb-3">
                    @if($product->getDiscountPercent())
                        <span class="bg-red-500 text-white px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">
                            -{{ $product->getDiscountPercent() }}%
                        </span>
                    @endif
                    @if($product->is_new)
                        <span class="bg-green-500 text-white px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">
                            Новинка
                        </span>
                    @endif
                    @if($product->is_featured)
                        <span class="bg-orange-500 text-white px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">
                            Хит продаж
                        </span>
                    @endif
                </div>
                
                <!-- Название и артикул -->
                <h1 class="text-base sm:text-2xl md:text-3xl font-bold text-gray-900 mb-1 sm:mb-2 leading-tight break-words">{{ $product->name }}</h1>
                <p class="text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">Артикул: {{ $product->sku }}</p>
                
                <!-- Рейтинг -->
                <div class="flex items-center mb-2 sm:mb-3">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $product->rating)
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-xs sm:text-sm text-gray-600 ml-1 sm:ml-2">{{ $product->rating }} ({{ $product->reviews_count }})</span>
                </div>
                
                <!-- Цена -->
                <div class="mb-2 sm:mb-4 md:mb-6">
                    @if($product->old_price && $product->old_price > $product->price)
                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3">
                            <span class="text-xl sm:text-3xl md:text-4xl font-bold text-orange-600">
                                {{ number_format($product->price, 0, ',', ' ') }} ₽
                            </span>
                            <span class="text-xs sm:text-base md:text-lg text-gray-400 line-through">
                                {{ number_format($product->old_price, 0, ',', ' ') }} ₽
                            </span>
                        </div>
                    @else
                        <span class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-900">
                            {{ number_format($product->price, 0, ',', ' ') }} ₽
                        </span>
                    @endif
                    <span class="text-xs text-gray-500">/ {{ $product->unit }}</span>
                </div>
                
                <!-- Наличие -->
                <div class="mb-2 sm:mb-4 md:mb-6">
                    @if($product->isInStock())
                        <p class="text-xs sm:text-sm text-green-600 font-medium">
                            ✓ В наличии: {{ $product->stock }} {{ $product->unit }}
                        </p>
                    @else
                        <p class="text-xs sm:text-sm text-red-600 font-medium">
                            ✗ Нет в наличии
                        </p>
                    @endif
                </div>

                <!-- Кнопки действий -->
                <div class="mb-3 sm:mb-5 md:mb-6">
                    @if($product->isInStock())
                        <div class="flex flex-col gap-2 sm:gap-3">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="flex items-center space-x-1 sm:space-x-2">
                                    <button onclick="decrementQuantity()" class="w-7 h-7 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center shrink-0 text-sm">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity" value="{{ $product->min_order_quantity }}" min="{{ $product->min_order_quantity }}"
                                           class="w-10 sm:w-16 text-center border border-gray-300 rounded-lg py-1 sm:py-1.5 md:py-2 text-xs sm:text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <button onclick="incrementQuantity()" class="w-7 h-7 sm:w-9 sm:h-9 md:w-10 md:h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center shrink-0 text-sm">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>
                                <button onclick="toggleWishlist({{ $product->id }})"
                                        class="w-7 h-7 sm:w-10 sm:h-10 md:w-12 md:h-12 shrink-0 border border-gray-300 hover:border-orange-500 rounded-lg flex items-center justify-center transition">
                                    <svg class="w-3 h-3 sm:w-5 sm:h-5 md:w-6 md:h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <button type="button" data-product-id="{{ $product->id }}"
                                    class="add-to-cart-btn w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold py-2 sm:py-2.5 md:py-3 px-3 sm:px-5 md:px-6 rounded-lg transition duration-200 text-xs sm:text-sm md:text-base">
                                В корзину
                            </button>
                        </div>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-semibold py-2 sm:py-2.5 md:py-3 px-3 sm:px-5 md:px-6 rounded-lg cursor-not-allowed text-xs sm:text-sm md:text-base">
                            Недоступно
                        </button>
                    @endif
                </div>
                
                <!-- Категория и бренд -->
                <div class="border-t pt-2 sm:pt-3">
                    <div class="flex flex-col sm:flex-row sm:items-center mb-1 sm:mb-2 text-xs">
                        <span class="text-gray-500 font-medium mb-0.5 sm:mb-0 sm:w-20">Категория:</span>
                        <a href="{{ route('catalog.category', $product->category->slug) }}" class="text-orange-600 hover:text-orange-700 text-xs">
                            {{ $product->category->name }}
                        </a>
                    </div>
                    @if($product->brand)
                        <div class="flex flex-col sm:flex-row sm:items-center text-xs">
                            <span class="text-gray-500 font-medium mb-0.5 sm:mb-0 sm:w-20">Бренд:</span>
                            <a href="{{ route('catalog.brand', $product->brand->slug) }}" class="text-orange-600 hover:text-orange-700 font-medium text-xs">
                                {{ $product->brand->name }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Описание и характеристики -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-4 md:gap-6 mb-4 sm:mb-6">
        <!-- Описание -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Описание</h2>
                <div class="prose prose-sm sm:prose max-w-none text-gray-700 text-sm sm:text-base">
                    {!! $product->description !!}
                </div>
            </div>
        </div>

        <!-- Характеристики -->
        <div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Характеристики</h2>
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
        <section class="mb-4 sm:mb-6">
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 sm:mb-4">Похожие товары</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-3">
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </section>
    @endif
</div>

<script>
// Функция для смены основного изображения товара
window.changeMainImage = function(src) {
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.style.opacity = '0';
        setTimeout(() => {
            mainImage.src = src;
            mainImage.style.opacity = '1';
        }, 150);
    }
};

// Функции для управления количеством товара
window.incrementQuantity = function() {
    const input = document.getElementById('quantity');
    if (input) {
        input.value = parseInt(input.value) + 1;
    }
};

window.decrementQuantity = function() {
    const input = document.getElementById('quantity');
    if (input) {
        const currentValue = parseInt(input.value);
        const minValue = parseInt(input.getAttribute('min')) || 1;
        if (currentValue > minValue) {
            input.value = currentValue - 1;
        }
    }
};

// Функция для добавления в корзину
window.addToCart = function(productId, buttonEl = null, quantity = 1) {
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantity = parseInt(quantityInput.value);
    }

    if (buttonEl) {
        buttonEl.disabled = true;
        buttonEl.style.opacity = '0.6';
        const originalText = buttonEl.textContent;
        buttonEl.textContent = 'Добавляю...';
    }

    fetch('/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('✓ Товар добавлен в корзину!', 'success');
        } else {
            showNotification('✗ Ошибка при добавлении товара', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('✗ Ошибка сети', 'error');
    })
    .finally(() => {
        if (buttonEl) {
            buttonEl.disabled = false;
            buttonEl.style.opacity = '1';
            buttonEl.textContent = 'В корзину';
        }
    });
};

// Функция для переключения wishlist
window.toggleWishlist = function(productId) {
    fetch('/api/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
        } else if (data.message === 'Требуется авторизация') {
            showNotification('Пожалуйста, войдите в аккаунт', 'error');
            setTimeout(() => window.location.href = '/login', 1500);
        } else {
            showNotification('Ошибка при изменении wishlist', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Ошибка сети', 'error');
    });
};

// Функция для показа уведомлений
window.showNotification = function(message, type = 'success') {
    const oldNotif = document.querySelector('.notification-toast');
    if (oldNotif) oldNotif.remove();

    const notif = document.createElement('div');
    notif.className = `notification-toast fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    notif.textContent = message;
    document.body.appendChild(notif);

    setTimeout(() => notif.remove(), 3000);
};
</script>
@endsection
