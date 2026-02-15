@props(['product'])

<div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-3 sm:p-4 relative group flex flex-col h-full">
    <!-- Бейдж скидки -->
    @if($product->getDiscountPercent())
        <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-bold z-10">
            -{{ $product->getDiscountPercent() }}%
        </div>
    @endif
    
    <!-- Бейдж "Новинка" -->
    @if($product->is_new)
        <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold z-10">
            Новинка
        </div>
    @endif
    
    <!-- Бейдж "Хит продаж" -->
    @if($product->is_featured)
        <div class="absolute top-10 left-2 bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold z-10">
            Хит
        </div>
    @endif
    
    <!-- Изображение -->
    <a href="{{ route('product.show', $product->slug) }}" class="block mb-2 sm:mb-3 flex-shrink-0">
        @if($product->primaryImage())
            <img
                src="{{ asset('storage/' . $product->primaryImage()->image_path) }}"
                alt="{{ $product->name }}"
                class="w-full h-32 sm:h-40 object-contain"
            >
        @else
            <img
                src="{{ asset('images/no-image.png') }}"
                alt="{{ $product->name }}"
                class="w-full h-32 sm:h-40 object-contain"
            >
        @endif
    </a>
    
    <!-- Рейтинг -->
    <div class="flex items-center mb-1 sm:mb-2">
        @for($i = 1; $i <= 5; $i++)
            @if($i <= $product->rating)
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @else
                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @endif
        @endfor
        <span class="text-xs text-gray-500 ml-1">({{ $product->reviews_count }})</span>
    </div>
    
    <!-- Название -->
    <a href="{{ route('product.show', $product->slug) }}" class="block mb-1 sm:mb-2">
        <h3 class="text-xs sm:text-sm font-medium text-gray-900 hover:text-orange-600 line-clamp-2 leading-tight">
            {{ $product->name }}
        </h3>
    </a>

    <!-- Артикул -->
    <p class="text-xs text-gray-400 mb-2 sm:mb-3 leading-tight">
        Арт: {{ $product->sku }}
    </p>
    
    <!-- Цена -->
    <div class="mb-2 sm:mb-3">
        @if($product->old_price && $product->old_price > $product->price)
            <div class="flex items-center gap-1 sm:gap-2">
                <span class="text-base sm:text-lg font-bold text-orange-600">
                    {{ number_format($product->price, 0, ',', ' ') }} ₽
                </span>
                <span class="text-xs text-gray-400 line-through">
                    {{ number_format($product->old_price, 0, ',', ' ') }} ₽
                </span>
            </div>
        @else
            <span class="text-base sm:text-lg font-bold text-gray-900">
                {{ number_format($product->price, 0, ',', ' ') }} ₽
            </span>
        @endif
        <span class="text-xs text-gray-500">/ {{ $product->unit }}</span>
    </div>

    <!-- Наличие -->
    @if($product->isInStock())
        <p class="text-xs sm:text-sm text-green-600 mb-2 sm:mb-3">
            ✓ В наличии: {{ $product->stock }} {{ $product->unit }}
        </p>
    @else
        <p class="text-xs sm:text-sm text-red-600 mb-2 sm:mb-3">
            Нет в наличии
        </p>
    @endif

    <!-- Spacer to push button to bottom -->
    <div class="flex-grow"></div>
    
    <!-- Кнопка "В корзину" -->
    @if($product->isInStock())
        <button
            type="button"
            data-product-id="{{ $product->id }}"
            class="add-to-cart-btn w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold py-1.5 sm:py-2 px-3 sm:px-4 rounded-lg transition duration-200 text-xs sm:text-sm"
        >
            В корзину
        </button>
    @else
        <button
            disabled
            class="w-full bg-gray-300 text-gray-500 font-semibold py-1.5 sm:py-2 px-3 sm:px-4 rounded-lg cursor-not-allowed text-xs sm:text-sm"
        >
            Недоступно
        </button>
    @endif
</div>
