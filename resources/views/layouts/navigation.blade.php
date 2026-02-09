<nav class="bg-white border-b" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4">
        <!-- Поиск (мобильный) -->
        <div class="md:hidden py-3">
            <form action="{{ route('search') }}" method="GET">
                <div class="relative">
                    <input
                        type="text"
                        name="q"
                        placeholder="Поиск товаров..."
                        class="w-full px-5 py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-base"
                    >
                    <svg class="absolute left-4 top-3.5 h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-between py-2 md:py-3">
            <!-- Кнопка меню (мобильная) -->
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 text-gray-600 hover:text-orange-600 focus:outline-none"
                aria-label="Открыть меню"
            >
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                </svg>
            </button>

            <!-- Категории (десктоп) -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('catalog.index') }}" class="text-gray-700 hover:text-orange-600 font-medium whitespace-nowrap">
                    Каталог
                </a>
                <a href="{{ route('brands.index') }}" class="text-gray-700 hover:text-orange-600 font-medium whitespace-nowrap">
                    Бренды
                </a>
                <a href="{{ route('promotions.index') }}" class="text-gray-700 hover:text-orange-600 font-medium whitespace-nowrap">
                    Акции
                </a>
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-orange-600 font-medium whitespace-nowrap">
                    Идеи и советы
                </a>
                <a href="{{ route('stores.index') }}" class="text-gray-700 hover:text-orange-600 font-medium whitespace-nowrap">
                    Магазины
                </a>
            </div>

            <!-- Дополнительно (десктоп) -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('delivery') }}" class="text-sm text-gray-600 hover:text-orange-600">
                    Доставка
                </a>
                <a href="{{ route('payment') }}" class="text-sm text-gray-600 hover:text-orange-600">
                    Оплата
                </a>
                <a href="{{ route('contacts') }}" class="text-sm text-gray-600 hover:text-orange-600">
                    Контакты
                </a>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden border-t py-4 space-y-3"
            style="display: none;"
        >
            <a href="{{ route('catalog.index') }}" class="block py-3 text-gray-700 hover:text-orange-600 font-medium text-lg border-b">
                Каталог
            </a>
            <a href="{{ route('brands.index') }}" class="block py-3 text-gray-700 hover:text-orange-600 font-medium text-lg border-b">
                Бренды
            </a>
            <a href="{{ route('promotions.index') }}" class="block py-3 text-gray-700 hover:text-orange-600 font-medium text-lg border-b">
                Акции
            </a>
            <a href="{{ route('blog.index') }}" class="block py-3 text-gray-700 hover:text-orange-600 font-medium text-lg border-b">
                Идеи и советы
            </a>
            <a href="{{ route('stores.index') }}" class="block py-3 text-gray-700 hover:text-orange-600 font-medium text-lg border-b">
                Магазины
            </a>
            <div class="pt-2 space-y-2">
                <a href="{{ route('delivery') }}" class="block py-2 text-gray-600 hover:text-orange-600 text-base">
                    Доставка
                </a>
                <a href="{{ route('payment') }}" class="block py-2 text-gray-600 hover:text-orange-600 text-base">
                    Оплата
                </a>
                <a href="{{ route('contacts') }}" class="block py-2 text-gray-600 hover:text-orange-600 text-base">
                    Контакты
                </a>
            </div>
        </div>
    </div>
</nav>
