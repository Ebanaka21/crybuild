@extends('layouts.app')

@section('title', 'Избранное - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Избранное</h1>

    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
                @php
                    $product = $item->product;
                @endphp

                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="relative">
                        <a href="{{ route('product.show', $product->slug) }}" class="block">
                            @if($product->primaryImage())
                                <img src="{{ asset('storage/' . $product->primaryImage()->image_path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-64 object-contain p-4">
                            @else
                                <img src="{{ asset('images/no-image.png') }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-64 object-contain p-4">
                            @endif
                        </a>

                        <!-- Кнопка удаления из избранного -->
                        <button onclick="toggleWishlist({{ $product->id }}, this)"
                                class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-6 h-6 text-red-500 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>

                        @if($product->discount > 0)
                            <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                -{{ $product->discount }}%
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <a href="{{ route('product.show', $product->slug) }}"
                           class="block text-gray-900 hover:text-orange-600 font-medium mb-2 line-clamp-2">
                            {{ $product->name }}
                        </a>

                        @if($product->sku)
                            <p class="text-sm text-gray-500 mb-3">Арт: {{ $product->sku }}</p>
                        @endif

                        <div class="flex items-center justify-between mb-4">
                            @if($product->discount > 0)
                                <div>
                                    <p class="text-2xl font-bold text-orange-600">
                                        {{ number_format($product->price, 0, ',', ' ') }} ₽
                                    </p>
                                    <p class="text-sm text-gray-500 line-through">
                                        {{ number_format($product->old_price, 0, ',', ' ') }} ₽
                                    </p>
                                </div>
                            @else
                                <p class="text-2xl font-bold text-orange-600">
                                    {{ number_format($product->price, 0, ',', ' ') }} ₽
                                </p>
                            @endif
                        </div>

                        @if($product->stock > 0)
                            <button onclick="addToCart({{ $product->id }})"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                В корзину
                            </button>
                        @else
                            <button disabled
                                    class="w-full bg-gray-300 text-gray-500 font-semibold py-2 px-4 rounded-lg cursor-not-allowed">
                                Нет в наличии
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Пустое состояние -->
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Ваш список избранного пуст</h2>
            <p class="text-gray-600 mb-6">Добавьте товары в избранное, чтобы не потерять их</p>
            <a href="{{ route('catalog.index') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                Перейти в каталог
            </a>
        </div>
    @endif
</div>

<script>
function toggleWishlist(productId, button) {
    fetch('/api/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Удаляем карточку товара из DOM
            button.closest('.bg-white').parentElement.remove();

            // Проверяем, остались ли товары
            const remainingItems = document.querySelectorAll('.grid > div').length;
            if (remainingItems === 0) {
                location.reload();
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при удалении из избранного');
    });
}

function addToCart(productId) {
    fetch('/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Товар добавлен в корзину');
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при добавлении в корзину');
    });
}
</script>
@endsection
