@extends('layouts.app')

@section('title', $page->title . ' - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif
    
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $page->title }}</h1>
        
        <div class="prose max-w-none text-gray-700">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
