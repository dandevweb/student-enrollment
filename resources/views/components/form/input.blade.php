@props([
    'disabled' => false,
    'value' => null,
])

<input value="{{ $value }}" {!! $attributes->merge([
    'class' =>
        'w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 shadow disabled:bg-gray-100 disabled:cursor-not-allowed disabled:text-gray-600',
    'type' => 'text',
]) !!} {{ $disabled ? 'disabled' : '' }}>
