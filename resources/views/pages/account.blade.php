@extends('layouts.app')

@section('title', 'Личный кабинет - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Личный кабинет</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Меню -->
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center mb-6 pb-4 border-b">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-semibold text-xl">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <nav class="space-y-1">
                    <a href="{{ route('account.index') }}" 
                       class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('account.index') ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Профиль
                    </a>
                    <a href="{{ route('account.orders') }}" 
                       class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('account.orders*') ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Мои заказы
                    </a>
                    <a href="{{ route('wishlist') }}" 
                       class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('wishlist') ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Избранное
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Выйти
                        </button>
                    </form>
                </nav>
            </div>
        </aside>
        
        <!-- Контент -->
        <main class="lg:col-span-3">
            <!-- Информация о пользователе -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Личная информация</h2>
                
                <form wire:submit="updateProfile">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Имя</label>
                            <input type="text" wire:model="name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model="email" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Телефон</label>
                            <input type="tel" wire:model="phone" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   placeholder="+7 (___) ___-__-__">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                            Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Статистика -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $orderCount }}</div>
                    <div class="text-gray-600 mt-2">Заказов</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $wishlistCount }}</div>
                    <div class="text-gray-600 mt-2">В избранном</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $totalSpent }}</div>
                    <div class="text-gray-600 mt-2">Потрачено ₽</div>
                </div>
            </div>
            
            <!-- Последние заказы -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold">Последние заказы</h2>
                    <a href="{{ route('account.orders') }}" class="text-orange-600 hover:text-orange-700 font-medium">
                        Все заказы →
                    </a>
                </div>
                
                @if($recentOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="flex items-center justify-between p-4 border rounded-lg">
                                <div>
                                    <p class="font-medium">{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">{{ number_format($order->total, 0, ',', ' ') }} ₽</p>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                        {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ \App\Models\Order::getStatuses()[$order->status] ?? $order->status }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">У вас пока нет заказов</p>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
