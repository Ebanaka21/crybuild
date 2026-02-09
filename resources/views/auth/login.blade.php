<x-guest-layout>
    <x-slot name="title">
        Вход в личный кабинет
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 flex flex-col justify-center px-4 sm:px-6 py-8 sm:py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Логотип/Заголовок -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <span class="text-3xl sm:text-4xl font-bold text-orange-600">Cry build</span>
                </a>
                <p class="text-gray-600 text-sm sm:text-base">Ваш личный кабинет</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg p-6 sm:p-8">
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center">Вход</h2>
                    <p class="mt-2 text-sm text-gray-600 text-center">
                        Введите свои данные для входа в аккаунт
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Пароль" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-orange-600 underline rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('password.request') }}">
                                Забыли пароль?
                            </a>
                        @endif
                    </div>

                    <x-validation-errors class="mb-4" />

                    <x-primary-button class="w-full">
                        Войти
                    </x-primary-button>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Нет аккаунта?
                            <a class="text-orange-600 font-medium hover:text-orange-700 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('register') }}">
                                Зарегистрироваться
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
