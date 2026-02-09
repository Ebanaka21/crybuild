@extends('layouts.app')

@section('title', 'Заказ ' . $order->order_number . ' - Личный кабинет - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Хлебные крошки -->
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-600">Главная</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('account.orders') }}" class="hover:text-orange-600">Мои заказы</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">{{ $order->order_number }}</span>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Информация о заказе -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Информация о заказе</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Номер заказа</p>
                        <p class="font-semibold">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Дата создания</p>
                        <p class="font-semibold">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Статус</p>
                        <span class="inline-block px-3 py-1 rounded text-sm font-semibold
                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ \App\Models\Order::getStatuses()[$order->status] ?? $order->status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Статус оплаты</p>
                        <span class="inline-block px-3 py-1 rounded text-sm font-semibold
                            {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 
                               ($order->payment_status === 'failed' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ $order->payment_status === 'paid' ? 'Оплачен' : ($order->payment_status === 'failed' ? 'Ошибка' : 'Ожидает') }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Данные покупателя -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Данные покупателя</h2>
                
                <div class="space-y-2">
                    <div class="flex">
                        <span class="text-sm text-gray-500 w-32">Имя:</span>
                        <span class="font-medium">{{ $order->customer_name }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-sm text-gray-500 w-32">Email:</span>
                        <span class="font-medium">{{ $order->customer_email }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-sm text-gray-500 w-32">Телефон:</span>
                        <span class="font-medium">{{ $order->customer_phone }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-sm text-gray-500 w-32">Город:</span>
                        <span class="font-medium">{{ $order->city }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-sm text-gray-500 w-32">Адрес:</span>
                        <span class="font-medium">{{ $order->shipping_address }}</span>
                    </div>
                    @if($order->comment)
                        <div class="flex">
                            <span class="text-sm text-gray-500 w-32">Комментарий:</span>
                            <span class="font-medium">{{ $order->comment }}</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Товары -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Товары</h2>
                
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between py-4 border-b last:border-b-0">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10l-8 4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} шт. × {{ number_format($item->price, 0, ',', ' ') }} ₽</p>
                                </div>
                            </div>
                            <span class="font-bold">{{ number_format($item->total, 0, ',', ' ') }} ₽</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Итого -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                <h2 class="text-xl font-bold mb-4">Итого</h2>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Подытог:</span>
                        <span class="font-medium">{{ number_format($order->subtotal, 0, ',', ' ') }} ₽</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Доставка:</span>
                        <span class="font-medium">{{ number_format($order->shipping_cost, 0, ',', ' ') }} ₽</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Скидка:</span>
                            <span class="font-medium">-{{ number_format($order->discount, 0, ',', ' ') }} ₽</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-xl font-bold border-t pt-2 mt-2">
                        <span>Итого:</span>
                        <span class="text-orange-600">{{ number_format($order->total, 0, ',', ' ') }} ₽</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
