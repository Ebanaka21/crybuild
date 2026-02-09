@extends('layouts.app')

@section('title', 'Главная - ' . config('app.name'))

@section('content')

{{-- Основной отступ всей страницы --}}
<div class="space-y-16 pb-16">

    <!-- БАННЕРЫ (Оставляем как было, работает хорошо) -->
    @if(isset($banners) && $banners->count() > 0)
        <section class="relative group">
            <div class="container mx-auto px-4 mt-6">
                <div class="relative overflow-hidden rounded-2xl shadow-xl bg-gray-100 h-64 sm:h-80 md:h-125" id="hero-slider">
                    @foreach($banners as $index => $banner)
                        <div class="banner-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                             data-slide="{{ $index }}">
                            @if($banner->image)
                                <img src="{{ asset('storage/' . $banner->image) }}"
                                     alt="{{ $banner->title }}"
                                     class="w-full h-full object-contain sm:object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-orange-400 to-orange-600"></div>
                            @endif

                            @if($banner->title || $banner->description)
                                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent flex items-center">
                                    <div class="max-w-3xl px-8 md:px-16 text-white">
                                        @if($banner->title)
                                            <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg tracking-tight">
                                                {{ $banner->title }}
                                            </h2>
                                        @endif
                                        @if($banner->description)
                                            <p class="text-lg md:text-xl mb-8 opacity-90 font-light max-w-xl leading-relaxed">
                                                {{ $banner->description }}
                                            </p>
                                        @endif
                                        @if($banner->button_text && $banner->button_url)
                                            <a href="{{ $banner->button_url }}"
                                               class="inline-block bg-orange-600 text-white hover:bg-orange-700 font-bold px-8 py-4 rounded-lg transition duration-300 shadow-lg hover:-translate-y-1 transform">
                                                {{ $banner->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    @if($banners->count() > 1)
                        <div class="absolute bottom-8 left-8 md:left-16 flex gap-3 z-20">
                            @foreach($banners as $index => $banner)
                                <button onclick="setSlide({{ $index }})"
                                        class="banner-dot h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-orange-500 w-8' : 'bg-white/50 w-2 hover:bg-white' }}"
                                        data-dot="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <div class="container mx-auto px-4 space-y-16">

        <!-- АКЦИИ -->
        @if(isset($promotions) && $promotions->count() > 0)
            <section x-data="promotionsSlider({{ $promotions->count() }})" x-init="init()">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-l-4 border-orange-600 pl-4 leading-none">
                        Горячие акции
                    </h2>
                    <a href="{{ route('promotions.index') }}" class="hidden md:block text-gray-500 hover:text-orange-600 font-medium transition flex items-center group">
                        Все акции
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <!-- Мобильный слайдер с touch-свайпом -->
                <div class="relative md:hidden">
                    <div class="overflow-hidden rounded-xl"
                         @touchstart="touchStart($event)"
                         @touchmove="touchMove($event)"
                         @touchend="touchEnd()">
                        <div class="flex transition-transform duration-300 ease-out"
                             :style="`transform: translateX(calc(-${mobileSlide * 100}% + ${swipeOffset}px))`">
                            @foreach($promotions as $promotion)
                                <div class="w-full flex-shrink-0 px-1">
                                    <a href="{{ route('promotions.show', $promotion->slug) }}"
                                       class="flex flex-col relative bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100">
                                        <div class="absolute top-4 left-4 z-10 bg-red-600 text-white px-3 py-1 rounded font-bold shadow-md text-sm">
                                            -{{ $promotion->discount_type === 'percent' ? $promotion->discount_value . '%' : number_format($promotion->discount_value, 0, ',', ' ') . ' ₽' }}
                                        </div>
                                        <div class="h-48 md:h-56 overflow-hidden relative">
                                            @if($promotion->image)
                                                <img src="{{ asset('storage/' . $promotion->image) }}" alt="{{ $promotion->name }}" class="w-full h-full object-contain md:object-cover group-hover:scale-105 transition-transform duration-500" draggable="false">
                                            @else
                                                <div class="w-full h-full bg-gray-200"></div>
                                            @endif
                                            <div class="absolute bottom-0 left-0 w-full p-3 bg-gradient-to-t from-black/60 to-transparent">
                                                <p class="text-white text-xs font-medium">До {{ $promotion->end_date->format('d.m.Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $promotion->name }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Точки навигации (стиль как у баннеров) -->
                    <div class="flex justify-center mt-4 gap-2">
                        @foreach($promotions as $index => $promotion)
                            <button @click="mobileSlide = {{ $index }}"
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="mobileSlide === {{ $index }} ? 'bg-orange-500 w-6' : 'bg-gray-300 w-2 hover:bg-gray-400'">
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Десктоп карусель -->
                <div class="hidden md:block relative">
                    <div class="overflow-hidden rounded-xl">
                        <div class="flex transition-transform duration-500 ease-out"
                             :style="`transform: translateX(-${desktopSlide * (100 / 3)}%)`">
                            @foreach($promotions as $promotion)
                                <div class="w-1/3 flex-shrink-0 px-3">
                                    <a href="{{ route('promotions.show', $promotion->slug) }}"
                                       class="flex flex-col relative bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 h-full">
                                        <div class="absolute top-4 left-4 z-10 bg-red-600 text-white px-3 py-1 rounded font-bold shadow-md text-sm">
                                            -{{ $promotion->discount_type === 'percent' ? $promotion->discount_value . '%' : number_format($promotion->discount_value, 0, ',', ' ') . ' ₽' }}
                                        </div>
                                        <div class="h-56 md:h-64 overflow-hidden relative">
                                            @if($promotion->image)
                                                <img src="{{ asset('storage/' . $promotion->image) }}" alt="{{ $promotion->name }}" class="w-full h-full object-contain md:object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full bg-gray-200"></div>
                                            @endif
                                            <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/60 to-transparent">
                                                <p class="text-white text-sm font-medium">Действует до {{ $promotion->end_date->format('d.m.Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="p-6 flex flex-col flex-grow">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">{{ $promotion->name }}</h3>
                                            @if($promotion->description)
                                                <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">{{ $promotion->description }}</p>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Стрелки навигации (показываем только если акций > 3) -->
                    <template x-if="total > 3">
                        <div>
                            <button @click="prevDesktop()"
                                    class="absolute top-1/2 -left-5 -translate-y-1/2 p-3 bg-white rounded-full shadow-lg border border-gray-200 hover:border-orange-500 hover:shadow-xl transition z-10">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="nextDesktop()"
                                    class="absolute top-1/2 -right-5 -translate-y-1/2 p-3 bg-white rounded-full shadow-lg border border-gray-200 hover:border-orange-500 hover:shadow-xl transition z-10">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </section>
        @endif
        <!-- ХИТЫ ПРОДАЖ -->
        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 border-l-4 border-orange-600 pl-4 leading-none">
                        Хиты продаж
                    </h2>
                    <a href="{{ route('catalog.index') }}" class="text-gray-500 hover:text-orange-600 font-medium transition flex items-center group">
                        В каталог
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- НОВИНКИ -->
        @if(isset($newProducts) && $newProducts->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 border-l-4 border-orange-600 pl-4 leading-none">
                        Новинки
                    </h2>
                    <a href="{{ route('catalog.index') }}" class="text-gray-500 hover:text-orange-600 font-medium transition flex items-center group">
                        Смотреть все
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($newProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- КАТЕГОРИИ (ИСПРАВЛЕНО: Белые плитки, никаких серых шаров) -->
        @if(isset($categories) && $categories->count() > 0)
            <section>
                <h2 class="text-3xl font-bold text-gray-900 mb-8 border-l-4 border-orange-600 pl-4 leading-none">
                    Популярные категории
                </h2>

                {{-- Сетка плиток --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($categories->take(12) as $category)
                        <a href="{{ route('catalog.category', $category->slug) }}"
                           class="group flex flex-col items-center justify-between p-6 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:shadow-lg transition-all duration-300 h-full">

                            {{-- Контейнер для иконки/картинки --}}
                            <div class="w-full h-24 mb-4 flex items-center justify-center">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                         alt="{{ $category->name }}"
                                         class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                                @else
                                    {{-- Если картинки нет - аккуратная SVG иконка "коробки/категории" --}}
                                    <svg class="w-12 h-12 text-gray-300 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                @endif
                            </div>

                            {{-- Название категории --}}
                            <h3 class="text-sm md:text-base font-bold text-gray-800 text-center leading-tight group-hover:text-orange-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- БРЕНДЫ -->
        @if(isset($brands) && $brands->count() > 0)
            <section class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 border-l-4 border-orange-600 pl-4 leading-none">
                        Бренды
                    </h2>
                    <a href="{{ route('brands.index') }}" class="text-gray-500 hover:text-orange-600 font-medium transition flex items-center group">
                        Все бренды
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8">
                    @foreach($brands->take(6) as $brand)
                        <a href="{{ route('catalog.brand', $brand->slug) }}"
                           class="bg-white rounded-lg p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md transition-all duration-300 group opacity-70 hover:opacity-100">
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="max-w-full max-h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            @else
                                <span class="text-sm font-bold text-gray-400 group-hover:text-orange-600">{{ $brand->name }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </section>
        @endif


        <!-- БЛОГ -->
        @if(isset($articles) && $articles->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 border-l-4 border-orange-600 pl-4 leading-none">
                        Идеи и советы
                    </h2>
                    <a href="{{ route('blog.index') }}" class="text-gray-500 hover:text-orange-600 font-medium transition flex items-center group">
                        Журнал
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($articles->take(3) as $article)
                        <a href="{{ route('blog.show', $article->slug) }}" class="group block h-full flex flex-col">
                            <div class="bg-gray-100 rounded-xl overflow-hidden mb-4 relative aspect-video shadow-sm group-hover:shadow-lg transition-all duration-300">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-200"></div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-orange-600 transition-colors leading-tight">
                                    {{ $article->title }}
                                </h3>
                                @if($article->excerpt)
                                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">{{ $article->excerpt }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Баннеры
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        const dots = document.querySelectorAll('.banner-dot');
        const totalSlides = slides.length;

        if (totalSlides < 2) return;

        window.setSlide = function(index) {
            currentSlide = index;
            updateSlider();
        }

        window.changeSlide = function(direction) {
            currentSlide += direction;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            updateSlider();
        }

        function updateSlider() {
            slides.forEach((slide, index) => {
                if (index === currentSlide) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                }
            });

            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-white/50', 'w-2');
                    dot.classList.add('bg-orange-500', 'w-8');
                } else {
                    dot.classList.remove('bg-orange-500', 'w-8');
                    dot.classList.add('bg-white/50', 'w-2');
                }
            });
        }

        setInterval(() => { changeSlide(1) }, 6000);
    });

    // Карусель акций
    function promotionsSlider(totalCount) {
        return {
            total: totalCount,
            // Мобильный
            mobileSlide: 0,
            swipeOffset: 0,
            touchStartX: 0,
            touchCurrentX: 0,
            isSwiping: false,
            // Десктоп
            desktopSlide: 0,

            init() {},

            // Touch-свайп
            touchStart(e) {
                this.touchStartX = e.touches[0].clientX;
                this.touchCurrentX = this.touchStartX;
                this.isSwiping = true;
                this.swipeOffset = 0;
            },
            touchMove(e) {
                if (!this.isSwiping) return;
                this.touchCurrentX = e.touches[0].clientX;
                let diff = this.touchCurrentX - this.touchStartX;
                // Ограничиваем свайп на краях
                if (this.mobileSlide === 0 && diff > 0) diff = diff * 0.3;
                if (this.mobileSlide === this.total - 1 && diff < 0) diff = diff * 0.3;
                this.swipeOffset = diff;
            },
            touchEnd() {
                if (!this.isSwiping) return;
                this.isSwiping = false;
                const threshold = 50;
                if (this.swipeOffset < -threshold && this.mobileSlide < this.total - 1) {
                    this.mobileSlide++;
                } else if (this.swipeOffset > threshold && this.mobileSlide > 0) {
                    this.mobileSlide--;
                }
                this.swipeOffset = 0;
            },

            // Десктоп навигация
            nextDesktop() {
                if (this.desktopSlide >= this.total - 3) {
                    this.desktopSlide = 0;
                } else {
                    this.desktopSlide++;
                }
            },
            prevDesktop() {
                if (this.desktopSlide <= 0) {
                    this.desktopSlide = this.total - 3;
                } else {
                    this.desktopSlide--;
                }
            }
        }
    }
</script>
@endpush

