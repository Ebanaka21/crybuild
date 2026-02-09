<x-guest-layout>
    <x-slot name="title">
        Забыли пароль?
    </x-slot>

    <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Забыли пароль?</h1>
                    <p class="mt-2 text-sm text-gray-600">
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
                        <a class="text-sm text-gray-600 underline hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2" href="{{ route('login') }}">
                            Вернуться на страницу входа
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
