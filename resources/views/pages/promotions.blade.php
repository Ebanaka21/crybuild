@extends('layouts.app')

@section('title', 'Акции - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Акции и скидки</h1>

    @if($promotions->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($promotions as $promotion)
                <a href="{{ route('promotions.show', $promotion->slug) }}" class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">
                    @if($promotion->image)
                        <img src="{{ asset('storage/' . $promotion->image) }}" 
                             alt="{{ $promotion->name }}"
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $promotion->name }}</h3>
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $promotion->discount_type === 'percent' ? $promotion->discount_value . '%' : number_format($promotion->discount_value, 0, ',', ' ') . ' ₽' }}
                            </span>
                        </div>
                        @if($promotion->description)
                            <p class="text-gray-600 mb-4">{{ $promotion->description }}</p>
                        @endif
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>с {{ $promotion->start_date->format('d.m.Y') }} по {{ $promotion->end_date->format('d.m.Y') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Пагинация -->
        <div class="flex justify-center mt-6">
            {{ $promotions->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Акций нет</h3>
            <p class="text-gray-600">В данный момент нет активных акций</p>
        </div>
    @endif
</div>
@endsection
