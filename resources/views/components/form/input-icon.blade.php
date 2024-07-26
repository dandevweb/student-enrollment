@props([
    'disabled' => false,
    'icon' => 'dashboard',
    'value' => null,
])

<div class="relative mt-2 rounded-md shadow-md">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <x-dynamic-component :component="'icon.' . $icon" class="h-5 w-5 text-gray-400" />
    </div>
    <input value="{{ $value ?? old('title') }}" {!! $attributes->merge([
        'class' =>
            'block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
    ]) !!}>
</div>
