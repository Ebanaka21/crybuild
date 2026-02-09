@extends('layouts.app')

@section('title', 'Оформление заказа - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Оформление заказа</h1>
    
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Форма заказа -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Контактные данные -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Контактные данные</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Имя *</label>
                            <input type="text" name="customer_name" required
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('customer_name') ? 'border-red-500' : '' }}">
                            @error('customer_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="customer_email" required
                                   value="{{ old('customer_email') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('customer_email') ? 'border-red-500' : '' }}">
                            @error('customer_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Телефон *</label>
                            <input type="tel" name="customer_phone" required
                                   value="{{ old('customer_phone') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('customer_phone') ? 'border-red-500' : '' }}"
                                   placeholder="+7 (___) ___-__-__">
                            @error('customer_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Город *</label>
                            <input type="text" name="city" required
                                   value="{{ old('city') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('city') ? 'border-red-500' : '' }}">
                            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Адрес доставки *</label>
                        <textarea name="shipping_address" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('shipping_address') ? 'border-red-500' : '' }}"
                                  placeholder="Улица, дом, квартира">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Почтовый индекс</label>
                        <input type="text" name="postal_code"
                               value="{{ old('postal_code') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 {{ $errors->has('postal_code') ? 'border-red-500' : '' }}">
                        @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Способ доставки -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Способ доставки</h2>

                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('delivery_method') === 'pickup' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="delivery_method" value="pickup" {{ old('delivery_method') === 'pickup' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Самовывоз</span>
                                <p class="text-sm text-gray-500">Бесплатно</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('delivery_method') === 'courier' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="delivery_method" value="courier" {{ old('delivery_method') === 'courier' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Курьерская доставка</span>
                                <p class="text-sm text-gray-500">500 ₽</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('delivery_method') === 'post' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="delivery_method" value="post" {{ old('delivery_method') === 'post' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Почта России</span>
                                <p class="text-sm text-gray-500">от 350 ₽</p>
                            </div>
                        </label>
                    </div>
                    @error('delivery_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Способ оплаты -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Способ оплаты</h2>

                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('payment_method') === 'cash' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="payment_method" value="cash" {{ old('payment_method') === 'cash' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Наличными при получении</span>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('payment_method') === 'card' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="payment_method" value="card" {{ old('payment_method') === 'card' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Банковской картой при получении</span>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-orange-500 transition {{ old('payment_method') === 'online' ? 'border-orange-500 bg-orange-50' : '' }}">
                            <input type="radio" name="payment_method" value="online" {{ old('payment_method') === 'online' ? 'checked' : '' }} class="w-4 h-4 text-orange-600">
                            <div class="ml-3">
                                <span class="font-medium">Онлайн оплата</span>
                                <p class="text-sm text-gray-500">Visa, MasterCard, МИР</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Комментарий -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Комментарий к заказу</h2>
                    <textarea name="comment" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                              placeholder="Укажите пожелания к заказу...">{{ old('comment') }}</textarea>
                </div>
            </div>
            
            <!-- Итого -->
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">Ваш заказ</h2>
                    
                    <!-- Товары -->
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex items-center">
                                <div class="w-12 h-12 flex-shrink-0">
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
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium line-clamp-1">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->qty }} шт.</p>
                                </div>
                                <span class="text-sm font-medium">{{ number_format($item->qty * $item->price, 0, ',', ' ') }} ₽</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Итоговая сумма -->
                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Товаров:</span>
                            <span class="font-medium">{{ $cartItems->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Подытог:</span>
                            <span class="font-medium">{{ number_format($subtotal, 0, ',', ' ') }} ₽</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Доставка:</span>
                            <span class="font-medium">{{ number_format($shippingCost, 0, ',', ' ') }} ₽</span>
                        </div>
                        @if($discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Скидка:</span>
                                <span class="font-medium">-{{ number_format($discount, 0, ',', ' ') }} ₽</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-xl font-bold border-t pt-2 mt-2">
                            <span>Итого:</span>
                            <span class="text-orange-600">{{ number_format($total, 0, ',', ' ') }} ₽</span>
                        </div>
                    </div>
                    
                    <!-- Кнопка оформления -->
                    <button type="submit" 
                            class="w-full mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Подтвердить заказ
                    </button>
                    
                    <p class="text-xs text-gray-500 mt-4 text-center">
                        Нажимая кнопку, вы соглашаетесь с условиями обработки персональных данных
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
