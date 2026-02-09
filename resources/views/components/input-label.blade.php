@props(['for', 'value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-700 mb-2']) }} for="{{ $for }}">
    {{ $value }}
</label>
