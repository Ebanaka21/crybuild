<x-app-layout>
    <x-slot name="title">
        Подтверждение пароля
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Подтверждение пароля</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Для продолжения подтвердите свой пароль
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="password" value="Текущий пароль" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div>
                    <x-input-label for="new_password" value="Новый пароль" />
                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Подтверждение пароля" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <x-validation-errors class="mb-4" />

                <x-primary-button class="w-full">
                    Подтвердить
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
