@extends('layouts.app')

@section('title', 'Магазины - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Наши магазины</h1>
    
    @if($stores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stores as $store)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $store->name }}</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-900">{{ $store->city }}</p>
                                <p class="text-gray-600 text-sm">{{ $store->address }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2v3a2 2 0 002 2h3.28a1 1 0 00.948-.684l1.498-4.493a1 1 0 01-.502-1.21l-2.257-1.13a11.042 11.042 0 01-5.516-5.517A4.368 4.368 0 0010 6.636 4.368 4.368 0 00-3.505 1.636 11.042 11.042 0 01-5.517 5.517l-2.257 1.13a1 1 0 01-.502 1.21l1.498 4.493a1 1 0 00.948.684H13a2 2 0 002-2V5a2 2 0 00-2-2H5z"></path>
                            </svg>
                            <a href="tel:{{ $store->phone }}" class="text-orange-600 hover:text-orange-700">
                                {{ $store->phone }}
                            </a>
                        </div>
                        
                        @if($store->email)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $store->email }}" class="text-orange-600 hover:text-orange-700">
                                    {{ $store->email }}
                                </a>
                            </div>
                        @endif
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-600">
                                {{ $store->opening_time->format('H:i') }} - {{ $store->closing_time->format('H:i') }}
                            </span>
                        </div>
                    </div>
                    
                    @if($store->latitude && $store->longitude)
                        <a href="https://maps.google.com/?q={{ $store->latitude }},{{ $store->longitude }}" 
                           target="_blank"
                           class="mt-4 block w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg text-center transition duration-200">
                            Показать на карте
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Магазины не найдены</h3>
            <p class="text-gray-600">В данный момент информация о магазинах недоступна</p>
        </div>
    @endif
</div>
@endsection
