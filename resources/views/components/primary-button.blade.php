@props(['type' => 'submit'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-lg shadow-md text-base sm:text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 active:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
