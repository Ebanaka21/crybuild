@extends('layouts.app')

@section('title', 'Мои заказы - Личный кабинет - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Мои заказы</h1>
    
    @if($orders->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @foreach($orders as $order)
                <div class="p-6 border-b last:border-b-0">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="font-semibold text-lg">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-xl text-orange-600">{{ number_format($order->total, 0, ',', ' ') }} ₽</p>
                            <span class="inline-block px-3 py-1 rounded text-sm font-semibold
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ \App\Models\Order::getStatuses()[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <div>
                            <p>Товаров: {{ $order->items->count() }}</p>
                            <p>Способ доставки: {{ $order->delivery_method === 'pickup' ? 'Самовывоз' : ($order->delivery_method === 'courier' ? 'Курьер' : 'Почта') }}</p>
                        </div>
                        <a href="{{ route('account.orders.show', $order->order_number) }}" class="text-orange-600 hover:text-orange-700 font-medium">
                            Подробнее →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Пагинация -->
        <div class="flex justify-center mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">У вас пока нет заказов</h3>
            <p class="text-gray-600 mb-6">Перейдите в каталог и сделайте первый заказ</p>
            <a href="{{ route('catalog.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Перейти в каталог
            </a>
        </div>
    @endif
</div>
@endsection
