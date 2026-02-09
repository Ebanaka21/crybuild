@extends('layouts.app')

@section('title', 'Оплата - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Оплата</h1>

    <div class="space-y-6">
        <!-- Способы оплаты -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Способы оплаты</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Онлайн оплата -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Банковской картой онлайн</h3>
                            <p class="text-gray-600 mb-3">Безопасная оплата через защищенное соединение</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Visa, MasterCard, МИР</li>
                                <li>• Моментальное зачисление</li>
                                <li>• 3D-Secure защита</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 mt-4">
                        <img src="https://via.placeholder.com/50x30/4285f4/ffffff?text=VISA" alt="Visa" class="h-8">
                        <img src="https://via.placeholder.com/50x30/eb001b/ffffff?text=MC" alt="MasterCard" class="h-8">
                        <img src="https://via.placeholder.com/50x30/4db45e/ffffff?text=MIR" alt="МИР" class="h-8">
                    </div>
                </div>

                <!-- Оплата при получении -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Оплата при получении</h3>
                            <p class="text-gray-600 mb-3">Оплатите заказ курьеру при доставке</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Наличными</li>
                                <li>• Банковской картой</li>
                                <li>• Доступно для курьерской доставки</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Оплата по счету -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Оплата по счету</h3>
                            <p class="text-gray-600 mb-3">Для юридических лиц и ИП</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Безналичный расчет</li>
                                <li>• Предоставим все документы</li>
                                <li>• Работаем с НДС и без НДС</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Электронные кошельки -->
                <div class="border rounded-lg p-6">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Электронные кошельки</h3>
                            <p class="text-gray-600 mb-3">Быстрая оплата через популярные сервисы</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• ЮMoney (Яндекс.Деньги)</li>
                                <li>• QIWI Кошелек</li>
                                <li>• WebMoney</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Условия оплаты -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Условия оплаты</h2>

            <div class="prose max-w-none text-gray-700 space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Безопасность платежей</h3>
                    <p>Все платежи на нашем сайте защищены по стандарту PCI DSS. Данные вашей банковской карты передаются в зашифрованном виде и не хранятся на нашем сервере. Мы используем протокол 3D-Secure для дополнительной защиты.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Время зачисления</h3>
                    <p>При оплате банковской картой онлайн платеж зачисляется моментально. При оплате по счету заказ будет обработан после поступления средств на наш расчетный счет (обычно 1-3 рабочих дня).</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Отмена заказа и возврат</h3>
                    <p>Вы можете отменить заказ до момента его отправки. Возврат денежных средств осуществляется на ту же карту, с которой была произведена оплата, в течение 5-10 рабочих дней с момента получения возвращенного товара.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Рассрочка и кредит</h3>
                    <p>Для покупок от 10 000 рублей доступна рассрочка на 3, 6 или 12 месяцев без процентов и переплат. Оформление происходит онлайн, решение принимается за несколько минут.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Для юридических лиц</h3>
                    <p>Юридические лица и ИП могут оплатить заказ по безналичному расчету. После оформления заказа наш менеджер свяжется с вами для выставления счета. Предоставляем все необходимые документы: счет, счет-фактуру, товарную накладную.</p>
                </div>
            </div>
        </div>

        <!-- Гарантии безопасности -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Гарантии безопасности</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">SSL шифрование</h3>
                    <p class="text-sm text-gray-600">Все данные передаются в зашифрованном виде</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">3D-Secure</h3>
                    <p class="text-sm text-gray-600">Дополнительная защита платежей</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">PCI DSS</h3>
                    <p class="text-sm text-gray-600">Соответствие международным стандартам</p>
                </div>
            </div>
        </div>

        <!-- Часто задаваемые вопросы -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Часто задаваемые вопросы</h2>

            <div class="space-y-4">
                <div class="border-b pb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Можно ли оплатить заказ частями?</h3>
                    <p class="text-gray-600">Да, при оформлении заказа вы можете выбрать оплату в рассрочку на 3, 6 или 12 месяцев без процентов для заказов от 10 000 рублей.</p>
                </div>

                <div class="border-b pb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Безопасно ли оплачивать картой на сайте?</h3>
                    <p class="text-gray-600">Да, абсолютно безопасно. Мы используем защищенное SSL-соединение, а данные карты передаются напрямую в платежный сервис и не хранятся у нас.</p>
                </div>

                <div class="border-b pb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Когда спишутся деньги с карты?</h3>
                    <p class="text-gray-600">Списание происходит сразу после подтверждения заказа. Если заказ будет отменен, деньги вернутся на карту в течение 5-10 рабочих дней.</p>
                </div>

                <div class="pb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Можно ли получить чек?</h3>
                    <p class="text-gray-600">Да, при оплате онлайн электронный чек придет вам на email. При оплате курьеру вы получите кассовый чек вместе с заказом.</p>
                </div>
            </div>
        </div>

        <!-- Контактная информация -->
        <div class="bg-orange-50 rounded-lg p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-orange-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Остались вопросы по оплате?</h3>
                    <p class="text-gray-700 mb-2">Свяжитесь с нами удобным способом, и мы поможем разобраться.</p>
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
