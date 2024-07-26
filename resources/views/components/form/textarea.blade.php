@props([
    'max' => 60000,
    'disabled' => false,
])

<div x-data="{ chars: 0 }" x-init="chars = document.getElementById('{{ $attributes->get('id') }}')?.value.length">
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 resize-none shadow-md disabled:bg-gray-100 disabled:bg-gray-100 disabled:cursor-not-allowed disabled:text-gray-600',
        'rows' => 4,
    ]) !!}
        x-on:input="
        if ($event.target.value.length <= {{ $max }}) {
            chars = $event.target.value.length;
        } else {
            $event.target.value = $event.target.value.substring(0, {{ $max }});
        }
    ">{{ $slot }}</textarea>
    <div class="text-right text-xs text-gray-400">
        <span x-text="chars"></span> / {{ $max }} caracteres
    </div>
</div>
