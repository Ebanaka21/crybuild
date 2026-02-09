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
    {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm']) }}
>
