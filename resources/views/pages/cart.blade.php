@extends('layouts.app')

@section('title', 'Корзина - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Корзина</h1>
    
    @php
    use Gloudemans\Shoppingcart\Facades\Cart;
    $cartItems = Cart::content();
    $subtotal = Cart::subtotal();
    $total = Cart::total();
    @endphp
    
    @if($cartItems && count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Товары в корзине -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    @foreach($cartItems as $item)
                        <div class="flex items-center p-4 border-b last:border-b-0">
                            <!-- Изображение -->
                            <div class="w-24 h-24 flex-shrink-0">
                                @if($item->options->image)
                                    <img src="{{ $item->options->image }}" 
                                         alt="{{ $item->name }}"
                                         class="w-full h-full object-contain">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" 
                                         alt="{{ $item->name }}"
                                         class="w-full h-full object-contain">
                                @endif
                            </div>
                            
                            <!-- Информация -->
                            <div class="flex-1 ml-4">
                                @if(!empty($item->options->slug))
                                    <a href="{{ route('product.show', $item->options->slug) }}" class="text-lg font-medium text-gray-900 hover:text-orange-600">
                                        {{ $item->name }}
                                    </a>
                                @else
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $item->name }}
                                    </h3>
                                @endif
                                <p class="text-sm text-gray-500">Арт: {{ $item->options->sku ?? '' }}</p>
                                <p class="text-lg font-bold text-orange-600 mt-2">
                                    {{ number_format($item->price, 0, ',', ' ') }} ₽
                                </p>
                            </div>
                            
                            <!-- Количество -->
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2 mx-4">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                <input type="hidden" name="quantity" value="{{ max(1, $item->qty - 1) }}">
                                <button type="submit" class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                            </form>
                            <span class="w-12 text-center font-medium">{{ $item->qty }}</span>
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2 mx-4">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                <input type="hidden" name="quantity" value="{{ $item->qty + 1 }}">
                                <button type="submit" class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </form>
                            
                            <!-- Сумма и удаление -->
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-900">
                                    {{ number_format($item->qty * $item->price, 0, ',', ' ') }} ₽
                                </p>
                                <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Кнопки действий -->
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('catalog.index') }}" class="text-orange-600 hover:text-orange-700 font-medium">
                        ← Вернуться в каталог
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 font-medium">
                            Очистить корзину
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Итого -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">Итого</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Товаров:</span>
                            <span class="font-medium">{{ $cartItems->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Подытог:</span>
                            <span class="font-medium">{{ number_format((float)str_replace([',', ' '], '', $subtotal), 0, ',', ' ') }} ₽</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Доставка:</span>
                            <span class="font-medium text-green-600">Бесплатно</span>
                        </div>
                    </div>

                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between text-xl font-bold">
                            <span>К оплате:</span>
                            <span class="text-orange-600">{{ number_format((float)str_replace([',', ' '], '', $subtotal), 0, ',', ' ') }} ₽</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" 
                       class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-200">
                        Оформить заказ
                    </a>
                    
                    <p class="text-xs text-gray-500 mt-4 text-center">
                        Нажимая кнопку, вы соглашаетесь с условиями обработки персональных данных
                    </p>
                </div>
            </div>
        </div>
    @else
        <!-- Корзина пуста -->
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Ваша корзина пуста</h2>
            <p class="text-gray-600 mb-6">Добавьте товары из каталога, чтобы оформить заказ</p>
            <a href="{{ route('catalog.index') }}" 
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                Перейти в каталог
            </a>
        </div>
    @endif
</div>
@endsection
