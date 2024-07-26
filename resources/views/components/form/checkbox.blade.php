@props(['checked' => false, 'id' => null])

<div class="flex items-center">
    <input id="{{ $id }}" {{ $checked ? 'checked' : '' }} {!! $attributes->merge([
        'class' => 'w-4 h-4 border-gray-300 rounded cursor-pointer text-gray-600 focus:ring-gray-600',
        'type' => 'checkbox',
    ]) !!} />
    <label for="{{ $id }}"
        class="ml-1 cursor-pointer text-sm text-gray-700">{{ $slot }}</label>
</div>
