@extends('layouts.app')

@section('title', 'Доставка - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Доставка</h1>

    <div class="space-y-6">
        <!-- Способы доставки -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Способы доставки</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Курьерская доставка -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Курьерская доставка</h3>
                            <p class="text-gray-600 mb-3">Доставим ваш заказ в удобное для вас время</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• По Москве: 300 ₽ (бесплатно от 5 000 ₽)</li>
                                <li>• По Московской области: 500 ₽ (бесплатно от 10 000 ₽)</li>
                                <li>• Срок доставки: 1-3 рабочих дня</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Самовывоз -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Самовывоз</h3>
                            <p class="text-gray-600 mb-3">Заберите заказ из нашего магазина бесплатно</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Бесплатно</li>
                                <li>• Готов к выдаче на следующий день</li>
                                <li>• Хранение заказа: 5 дней</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Доставка транспортной компанией -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Транспортная компания</h3>
                            <p class="text-gray-600 mb-3">Доставка в любой регион России</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Стоимость рассчитывается индивидуально</li>
                                <li>• СДЭК, Деловые линии, ПЭК</li>
                                <li>• Срок доставки: от 3 рабочих дней</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Экспресс-доставка -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Экспресс-доставка</h3>
                            <p class="text-gray-600 mb-3">Получите заказ в день оформления</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• По Москве: 800 ₽</li>
                                <li>• При заказе до 12:00</li>
                                <li>• Доставка в течение 4-6 часов</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Условия доставки -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Условия доставки</h2>

            <div class="prose max-w-none text-gray-700 space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Зоны доставки</h3>
                    <p>Мы доставляем заказы по всей России. Для Москвы и Московской области доступна курьерская доставка с возможностью выбора времени. В другие регионы осуществляем отправку через надежные транспортные компании.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Время доставки</h3>
                    <p>Стандартная доставка по Москве занимает 1-3 рабочих дня. Экспресс-доставка - в день заказа при оформлении до 12:00. Доставка в регионы зависит от удаленности и выбранной транспортной компании.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Оплата при получении</h3>
                    <p>Вы можете оплатить заказ при получении наличными или банковской картой курьеру. Также доступна предварительная оплата онлайн на сайте.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Крупногабаритные товары</h3>
                    <p>Для доставки крупногабаритных товаров стоимость и сроки рассчитываются индивидуально. Наши менеджеры свяжутся с вами для уточнения деталей.</p>
                </div>
            </div>
        </div>

        <!-- Адреса самовывоза -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Адреса пунктов самовывоза</h2>

            @if(isset($stores) && $stores->count() > 0)
                <div class="space-y-4">
                    @foreach($stores as $store)
                        <div class="border-l-4 border-orange-500 pl-4">
                            <h3 class="font-bold text-gray-900 mb-2">{{ $store->city }}, {{ $store->address }}</h3>
                            <p class="text-gray-600 mb-1">{{ $store->opening_time->format('H:i') }} - {{ $store->closing_time->format('H:i') }}</p>
                            @if($store->phone)
                                <a href="tel:{{ $store->phone }}" class="text-orange-600 hover:text-orange-700">{{ $store->phone }}</a>
                            @endif
                            @if($store->email)
                                <br><a href="mailto:{{ $store->email }}" class="text-orange-600 hover:text-orange-700 text-sm">{{ $store->email }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('stores.index') }}"
                   class="inline-block mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                    Все магазины на карте
                </a>
            @else
                <p class="text-gray-600 mb-4">Информация о пунктах самовывоза временно недоступна.</p>
                <a href="{{ route('stores.index') }}"
                   class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                    Посмотреть магазины
                </a>
            @endif
        </div>

        <!-- Контактная информация -->
        <div class="bg-orange-50 rounded-lg p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-orange-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Нужна помощь с доставкой?</h3>
                    <p class="text-gray-700 mb-2">Наши менеджеры помогут выбрать оптимальный способ доставки и ответят на все вопросы.</p>
                    <p class="text-gray-900 font-semibold">
                        Телефон: <a href="tel:+74951234567" class="text-orange-600 hover:text-orange-700">+7 (495) 123-45-67</a>
                    </p>
                    <p class="text-gray-900 font-semibold">
                        Email: <a href="mailto:info@Crybuild.ru" class="text-orange-600 hover:text-orange-700">info@Crybuild.ru</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
