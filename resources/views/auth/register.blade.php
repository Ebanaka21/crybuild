<x-guest-layout>
    <x-slot name="title">
        Регистрация
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 flex flex-col justify-center px-4 sm:px-6 py-8 sm:py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Логотип/Заголовок -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <span class="text-3xl sm:text-4xl font-bold text-orange-600">Cry build</span>
                </a>
                <p class="text-gray-600 text-sm sm:text-base">Присоединяйтесь к нам</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg p-6 sm:p-8">
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center">Регистрация</h2>
                    <p class="mt-2 text-sm text-gray-600 text-center">
                        Создайте новый аккаунт для доступа
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Имя" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Пароль" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Подтверждение пароля" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <x-validation-errors class="mb-4" />

                    <x-primary-button class="w-full">
                        Зарегистрироваться
                    </x-primary-button>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Уже есть аккаунт?
                            <a class="text-orange-600 font-medium hover:text-orange-700 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('login') }}">
                                Войти
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
