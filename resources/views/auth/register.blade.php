<x-guest-layout>
    <x-slot name="title">
        Регистрация
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 flex flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Логотип/Заголовок -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-600 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">OBI</h1>
                <p class="mt-2 text-gray-600">Присоединяйтесь к нам</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center">Регистрация</h2>
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
                        <a class="text-sm text-gray-600 underline hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('login') }}">
                            Уже есть аккаунт? Войти
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
