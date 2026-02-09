<x-guest-layout>
    <x-slot name="title">
        Забыли пароль?
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-orange-100 flex flex-col justify-center px-4 sm:px-6 py-8 sm:py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Логотип/Заголовок -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <span class="text-3xl sm:text-4xl font-bold text-orange-600">Cry build</span>
                </a>
                <p class="text-gray-600 text-sm sm:text-base">Восстановление пароля</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg p-6 sm:p-8">
                <div class="text-center mb-6 sm:mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Забыли пароль?</h1>
                    <p class="mt-3 text-sm text-gray-600">
                        Введите свой email, и мы отправим вам ссылку для сброса пароля
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                    </div>

                    <x-validation-errors class="mb-4" />

                    <x-primary-button class="w-full">
                        Отправить ссылку
                    </x-primary-button>

                    <div class="mt-6 text-center">
                        <a class="text-sm text-orange-600 font-medium hover:text-orange-700 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('login') }}">
                            ← Вернуться на страницу входа
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
