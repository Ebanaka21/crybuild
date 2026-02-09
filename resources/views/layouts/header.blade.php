<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <!-- Верхняя полоса -->
        <div class="flex items-center justify-between py-3 border-b gap-2">
            <!-- Логотип -->
            <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                <span class="text-2xl font-bold text-orange-600">Cry build</span>
            </a>

            <!-- Поиск (десктоп) -->
            <div class="hidden md:block flex-1 max-w-lg">
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            placeholder="Поиск товаров..."
                            class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm"
                        >
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Иконки -->
            <div class="flex items-center space-x-3 md:space-x-6 flex-shrink-0">
                <!-- Личный кабинет -->
                @auth
                    <a href="{{ route('account.index') }}" class="flex items-center text-gray-600 hover:text-orange-600">
                        <svg class="w-9 h-9 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="hidden lg:inline ml-1 md:ml-2 text-sm">{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center text-gray-600 hover:text-orange-600">
                        <svg class="w-9 h-9 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="hidden lg:inline ml-1 md:ml-2 text-sm">Войти</span>
                    </a>
                @endauth

                <!-- Избранное -->
                <a href="{{ route('wishlist') }}" class="relative flex items-center text-gray-600 hover:text-orange-600">
                    <svg class="w-9 h-9 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    @auth
                        <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full h-4 w-4 md:h-5 md:w-5 flex items-center justify-center">
                            {{ Auth::user()->wishlists?->count() ?? 0 }}
                        </span>
                    @endauth
                </a>

                <!-- Корзина -->
                <a href="{{ route('cart.index') }}" class="relative flex items-center text-gray-600 hover:text-orange-600">
                    <svg class="w-9 h-9 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
