@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Каталог' : 'Каталог товаров')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Хлебные крошки -->
    @if(isset($breadcrumbs))
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
    @endif

    <div class="flex flex-col lg:flex-row gap-6" x-data="{ filtersOpen: false }">
        <!-- Кнопка открытия фильтров на мобильных -->
        <button @click="filtersOpen = !filtersOpen" class="lg:hidden flex items-center gap-2 mb-4 px-4 py-3 bg-white rounded-lg shadow border border-gray-300 hover:border-orange-500 transition">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span class="font-semibold">Фильтры</span>
        </button>

        <!-- Оверлей для мобильных -->
        <div @click="filtersOpen = false"
             x-show="filtersOpen"
             class="fixed inset-0 bg-black/50 z-30 lg:hidden"
             style="display: none;"></div>

        <!-- Боковая панель с фильтрами -->
        <aside class="fixed lg:relative top-0 left-0 h-screen lg:h-auto w-80 lg:w-64 bg-white lg:bg-transparent overflow-y-auto lg:overflow-visible flex-shrink-0 transition-transform duration-300 z-40 lg:z-auto lg:translate-x-0"
               :class="filtersOpen ? 'translate-x-0' : '-translate-x-full'">
            <!-- Кнопка закрытия на мобильных -->
            <button @click="filtersOpen = false" class="lg:hidden absolute top-4 right-4 p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="p-4 lg:p-0 mt-12 lg:mt-0">
                <!-- Дерево категорий -->
                @if(isset($categories) && $categories->count() > 0)
                    <div class="bg-white lg:rounded-lg lg:shadow p-4 mb-4">
                        <h3 class="font-semibold mb-3">Категории</h3>
                        <x-category-tree :categories="$categories" :currentCategory="$category ?? null" />
                    </div>
                @endif

                <!-- Фильтры -->
                <form action="{{ route('catalog.index') }}" method="GET" class="bg-white lg:rounded-lg lg:shadow p-4">
                    <!-- Фильтр по цене -->
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Цена</h4>
                        <div class="flex items-center gap-2">
                            <input type="number" name="price_from" placeholder="От" value="{{ request('price_from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <span>-</span>
                            <input type="number" name="price_to" placeholder="До" value="{{ request('price_to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>

                    <!-- Фильтр по брендам -->
                    @if(isset($brands) && $brands->count() > 0)
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Бренды</h4>
                        @foreach($brands as $brand)
                            <label class="flex items-center mb-1 cursor-pointer">
                                <input type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                    {{ in_array($brand->id, (array)request('brands', [])) ? 'checked' : '' }}
                                    class="mr-2 rounded text-orange-500">
                                <span class="text-sm">{{ $brand->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @endif

                    <!-- Фильтр наличия -->
                    <div class="mb-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} class="mr-2 rounded text-orange-500">
                            <span class="text-sm">Только в наличии</span>
                        </label>
                    </div>

                    <!-- Кнопки -->
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 text-sm">
                            Применить
                        </button>
                        <a href="{{ route('catalog.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded-lg transition duration-200 text-sm text-center">
                            Сброс
                        </a>
                    </div>
                </form>
            </div>
        </aside>
        
        <!-- Основной контент -->
        <main class="flex-1">
            <!-- Заголовок категории / бренда -->
            @if(isset($category))
                <div class="mb-4">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="text-gray-600">{{ $category->description }}</p>
                    @endif
                </div>
            @elseif(isset($brand))
                <div class="mb-4">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Бренд: {{ $brand->name }}</h1>
                    @if($brand->description)
                        <p class="text-gray-600">{{ $brand->description }}</p>
                    @endif
                </div>
            @elseif(isset($query))
                <div class="mb-4">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Поиск: "{{ $query }}"</h1>
                </div>
            @else
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Каталог товаров</h1>
            @endif

            <!-- Сортировка и количество -->
            <div class="mb-4 bg-white rounded-lg shadow p-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="text-sm text-gray-600 font-medium">
                        Найдено: <span class="font-bold text-gray-900">{{ $products->total() }}</span> товаров
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <label class="text-sm font-medium text-gray-700 whitespace-nowrap hidden sm:block">Сортировка:</label>
                        <select onchange="handleSort(this.value)" class="flex-1 sm:flex-none max-w-xs sm:max-w-none px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm bg-white">
                            <option value="popular" {{ (request('sort', 'popular') == 'popular') ? 'selected' : '' }}>Популярные</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Дешевле</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Дороже</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Новинки</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Рейтинг</option>
                        </select>
                        <a href="{{ route('catalog.index') }}" class="sm:hidden px-3 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition text-xs text-center whitespace-nowrap shrink-0">
                            Сброс
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Сетка товаров -->
            @if($products->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                
                <!-- Пагинация -->
                <div class="flex justify-center">
                    {{ $products->appends(request()->all())->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Товары не найдены</h3>
                    <p class="text-gray-600 mb-4">Попробуйте изменить параметры фильтрации</p>
                    <a href="{{ route('catalog.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                        Сбросить фильтры
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

<script>
function handleSort(value) {
    const url = new URL(window.location);
    url.searchParams.set('sort', value);
    window.location.href = url.toString();
}
</script>
