@props(['disabled' => false, 'type' => 'text', 'name' => '', 'id' => '', 'value' => '', 'placeholder' => '', 'required' => false, 'autocomplete' => ''])

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $id ?: $name }}" 
    value="{{ $value }}" 
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $autocomplete ? "autocomplete=\"$autocomplete\"" : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'block w-full mt-2 px-4 py-2 sm:py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 text-gray-900 placeholder-gray-400 transition duration-200 disabled:bg-gray-50 disabled:text-gray-500 disabled:border-gray-200']) }}
>
