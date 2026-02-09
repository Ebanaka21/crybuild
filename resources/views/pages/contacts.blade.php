@extends('layouts.app')

@section('title', 'Контакты - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Контакты</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Контактная информация -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Свяжитесь с нами</h2>

            <div class="space-y-4">
                <!-- Телефон -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Телефон</h3>
                        <a href="tel:+74951234567" class="text-orange-600 hover:text-orange-700 text-lg">+7 (495) 123-45-67</a>
                        <p class="text-sm text-gray-600 mt-1">Ежедневно с 9:00 до 21:00</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <a href="mailto:info@Crybuild.ru" class="text-orange-600 hover:text-orange-700 text-lg">info@Crybuild.ru</a>
                        <p class="text-sm text-gray-600 mt-1">Ответим в течение 24 часов</p>
                    </div>
                </div>

                <!-- Адрес -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Главный офис</h3>
                        <p class="text-gray-700">г. Москва, ул. Примерная, д. 1</p>
                        <p class="text-sm text-gray-600 mt-1">Пн-Пт: 9:00 - 20:00, Сб-Вс: 10:00 - 18:00</p>
                    </div>
                </div>

                <!-- Социальные сети -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Мы в соцсетях</h3>
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-full flex items-center justify-center hover:from-purple-700 hover:to-pink-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Реквизиты -->
            <div class="mt-6 pt-6 border-t">
                <h3 class="font-semibold text-gray-900 mb-3">Реквизиты компании</h3>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><span class="font-medium">ИНН:</span> 7700000000</p>
                    <p><span class="font-medium">КПП:</span> 770001001</p>
                    <p><span class="font-medium">ОГРН:</span> 1234567890123</p>
                    <p><span class="font-medium">Юр. адрес:</span> 123456, г. Москва, ул. Примерная, д. 1</p>
                </div>
            </div>
        </div>

        <!-- Форма обратной связи -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Напишите нам</h2>

            <form id="contactForm" class="space-y-4">
                @csrf

                <div id="formSuccess" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    <p class="font-medium">Заявка отправлена!</p>
                    <p class="text-sm">Мы свяжемся с вами в ближайшее время.</p>
                </div>
                <div id="formError" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg"></div>

                <!-- Имя -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Ваше имя <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="Иван Иванов">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="ivan@example.com">
                </div>

                <!-- Телефон -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Телефон
                    </label>
                    <input type="tel"
                           id="phone"
                           name="phone"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="+7 (495) 123-45-67">
                </div>

                <!-- Тема -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                        Тема обращения <span class="text-red-500">*</span>
                    </label>
                    <select id="subject"
                            name="subject"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Выберите тему</option>
                        <option value="order">Вопрос по заказу</option>
                        <option value="product">Вопрос о товаре</option>
                        <option value="delivery">Доставка</option>
                        <option value="payment">Оплата</option>
                        <option value="return">Возврат/обмен</option>
                        <option value="cooperation">Сотрудничество</option>
                        <option value="other">Другое</option>
                    </select>
                </div>

                <!-- Сообщение -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Сообщение <span class="text-red-500">*</span>
                    </label>
                    <textarea id="message"
                              name="message"
                              rows="5"
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                              placeholder="Опишите ваш вопрос..."></textarea>
                </div>

                <!-- Согласие на обработку данных -->
                <div class="flex items-start">
                    <input type="checkbox"
                           id="agreement"
                           name="agreement"
                           required
                           class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                    <label for="agreement" class="ml-2 text-sm text-gray-600">
                        Я согласен на обработку персональных данных в соответствии с
                        <a href="#" class="text-orange-600 hover:text-orange-700">политикой конфиденциальности</a>
                    </label>
                </div>

                <!-- Кнопка отправки -->
                <button type="submit"
                        id="submitBtn"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Отправить сообщение
                </button>

                <p class="text-xs text-gray-500 text-center">
                    Мы свяжемся с вами в течение 24 часов
                </p>
            </form>

            <script>
                document.getElementById('contactForm').addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const btn = document.getElementById('submitBtn');
                    const successDiv = document.getElementById('formSuccess');
                    const errorDiv = document.getElementById('formError');

                    btn.disabled = true;
                    btn.textContent = 'Отправка...';
                    successDiv.classList.add('hidden');
                    errorDiv.classList.add('hidden');

                    try {
                        const response = await fetch('/api/callback', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                name: document.getElementById('name').value,
                                email: document.getElementById('email').value,
                                phone: document.getElementById('phone').value,
                                subject: document.getElementById('subject').value,
                                message: document.getElementById('message').value,
                            })
                        });
                        const data = await response.json();
                        if (data.success) {
                            successDiv.classList.remove('hidden');
                            this.reset();
                        } else {
                            errorDiv.textContent = data.message || 'Произошла ошибка';
                            errorDiv.classList.remove('hidden');
                        }
                    } catch (error) {
                        errorDiv.textContent = 'Ошибка сети. Попробуйте позже.';
                        errorDiv.classList.remove('hidden');
                    }
                    btn.disabled = false;
                    btn.textContent = 'Отправить сообщение';
                });
            </script>
        </div>
    </div>

    <!-- Карта -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="h-96 bg-gray-200 relative">
            <!-- Здесь будет интеграция с картой (Yandex Maps или Google Maps) -->
            <iframe
                src="https://yandex.ru/map-widget/v1/?um=constructor%3Axxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&amp;source=constructor"
                class="w-full h-full border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <!-- Дополнительная информация -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Режим работы</h3>
            <p class="text-gray-600 text-sm">Ежедневно с 9:00 до 21:00</p>
            <p class="text-gray-600 text-sm">Без выходных и праздников</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Поддержка 24/7</h3>
            <p class="text-gray-600 text-sm">Онлайн-консультант всегда на связи</p>
            <p class="text-gray-600 text-sm">Ответим на любые вопросы</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">Опытные консультанты</h3>
            <p class="text-gray-600 text-sm">Помогут с выбором товара</p>
            <p class="text-gray-600 text-sm">Профессиональные рекомендации</p>
        </div>
    </div>
</div>
@endsection
