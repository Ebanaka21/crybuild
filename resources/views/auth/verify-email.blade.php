<x-app-layout>
    <x-slot name="title">
        Подтверждение email
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Подтверждение email</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Спасибо за регистрацию! Пожалуйста, подтвердите свой email.
                </p>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Если вы не получили письмо, вы можете запросить новое:
                </p>
                <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
                    @csrf
                    <x-primary-button type="submit" class="w-full">
                        Отправить письмо повторно
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
