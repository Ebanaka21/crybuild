<footer class="bg-gray-900 text-gray-300 mt-16 pt-8 sm:pt-12 pb-6 relative z-10 -mt-1 shadow-[0_-2px_0_0_#111827]">
    <div class="container mx-auto px-4">

        <!-- Верхняя часть: Рассылка (компактнее на мобильных) -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-6 mb-8 pb-8 border-b border-gray-800">
            <div class="w-full sm:w-auto">
                <h3 class="text-white text-lg sm:text-xl font-bold mb-2">Подпишитесь на скидки</h3>
                <p class="text-xs sm:text-sm text-gray-400 mb-3">Узнавайте первыми о новых поступлениях.</p>
                <form action="#" class="flex gap-2">
                    <input type="email" placeholder="Ваш email" class="flex-1 sm:flex-auto bg-gray-800 text-white px-3 sm:px-4 py-2 rounded-lg text-sm outline-none focus:ring-2 focus:ring-orange-500">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-4 sm:px-6 py-2 rounded-lg font-semibold text-sm transition">
                        OK
                    </button>
                </form>
            </div>

            <!-- Соцсети -->
            <div class="flex gap-3 sm:gap-4">
                <a href="#" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-600 text-gray-400 hover:text-white transition flex-shrink-0">
                    <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-600 text-gray-400 hover:text-white transition flex-shrink-0">
                    <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                </a>
            </div>
        </div>

        <!-- Сетка ссылок (адаптивная высота строк) -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-8 sm:mb-12">

            <!-- О компании -->
            <div>
                <h3 class="text-white text-sm sm:text-base lg:text-lg font-bold mb-2 sm:mb-4">О компании</h3>
                <ul class="flex flex-col gap-1 sm:gap-2 text-xs sm:text-sm">
                    <li><a href="{{ route('page.show', ['page' => 'about']) }}" class="text-gray-400 hover:text-orange-500 transition">О нас</a></li>
                    <li><a href="{{ route('page.show', ['page' => 'vacancy']) }}" class="text-gray-400 hover:text-orange-500 transition">Вакансии</a></li>
                    <li><a href="{{ route('stores.index') }}" class="text-gray-400 hover:text-orange-500 transition">Магазины</a></li>
                </ul>
            </div>

            <!-- Покупателям -->
            <div>
                <h3 class="text-white text-sm sm:text-base lg:text-lg font-bold mb-2 sm:mb-4">Покупателям</h3>
                <ul class="flex flex-col gap-1 sm:gap-2 text-xs sm:text-sm">
                    <li><a href="{{ route('delivery') }}" class="text-gray-400 hover:text-orange-500 transition">Доставка и оплата</a></li>
                    <li><a href="{{ route('page.show', ['page' => 'return']) }}" class="text-gray-400 hover:text-orange-500 transition">Возврат товара</a></li>
                    <li><a href="{{ route('page.show', ['page' => 'guarantee']) }}" class="text-gray-400 hover:text-orange-500 transition">Гарантия</a></li>
                </ul>
            </div>

            <!-- Каталог -->
            <div>
                <h3 class="text-white text-sm sm:text-base lg:text-lg font-bold mb-2 sm:mb-4">Каталог</h3>
                <ul class="flex flex-col gap-1 sm:gap-2 text-xs sm:text-sm">
                    <li><a href="{{ route('catalog.index') }}" class="text-gray-400 hover:text-orange-500 transition">Все категории</a></li>
                    <li><a href="{{ route('promotions.index') }}" class="text-orange-500 font-medium hover:text-orange-400 transition">Акции и скидки</a></li>
                    <li><a href="{{ route('brands.index') }}" class="text-gray-400 hover:text-orange-500 transition">Бренды</a></li>
                </ul>
            </div>

            <!-- Контакты -->
            <div class="col-span-2 sm:col-span-1">
                <h3 class="text-white text-sm sm:text-base lg:text-lg font-bold mb-2 sm:mb-4">Контакты</h3>
                <div class="flex flex-col gap-3 sm:gap-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wide mb-0.5 sm:mb-1">Горячая линия</p>
                        <a href="tel:+74951234567" class="text-lg sm:text-xl lg:text-2xl font-bold text-white hover:text-orange-500 transition">+7 (495) 123-45-67</a>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wide mb-0.5 sm:mb-1">Email</p>
                        <a href="mailto:info@Crybuild.ru" class="text-xs sm:text-sm text-gray-300 hover:text-orange-500 transition break-all">info@Crybuild.ru</a>
                    </div>

                    <div class="flex items-start gap-2 text-xs sm:text-sm text-gray-400">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"></path>
                        </svg>
                        <span>9:00 - 21:00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Нижняя часть -->
        <div class="border-t border-gray-800 pt-4 sm:pt-8 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 text-xs sm:text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} OOO Край Строй. Все права защищены.</p>

            <!-- Иконки оплаты -->
            <div class="flex items-center gap-2 sm:gap-3 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition">
                <div class="h-5 sm:h-6 w-8 sm:w-10 bg-white rounded flex items-center justify-center text-center">
                    <span class="font-bold text-blue-800 italic text-[8px] sm:text-[10px]">VISA</span>
                </div>
                <div class="h-5 sm:h-6 w-8 sm:w-10 bg-white rounded flex items-center justify-center">
                    <span class="font-bold text-red-600 text-[8px] sm:text-[10px]">MC</span>
                </div>
                <div class="h-5 sm:h-6 w-8 sm:w-10 bg-white rounded flex items-center justify-center">
                    <span class="font-bold text-green-600 text-[7px] sm:text-[8px]">МИР</span>
                </div>
            </div>
        </div>
    </div>
</footer>
