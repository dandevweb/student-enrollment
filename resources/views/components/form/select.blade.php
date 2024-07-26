@props([
    'options' => [],
    'value' => null,
    'name' => '',
    'defaultSelect' => 'Selecione',
    'icon' => null,
    'disabled' => false,
])

@if ($icon)
    <div class="relative mt-2 rounded-md shadow-sm">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <x-dynamic-component :component="'icon.' . $icon" class="h-5 w-5 text-gray-400" />
        </div>
        <select name="{{ $name }}" {!! $attributes->merge([
            'class' =>
                'text-black-400 block w-full rounded-md border-gray-300 p-2 px-10 shadow-sm focus:border-gray-500 focus:ring-gray-500',
        ]) !!}>
            <option value="">{{ $defaultSelect }}</option>
            @forelse ($options as $key => $label)
                <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @empty
                <option value="0">Nenhum item disponível</option>
            @endforelse
        </select>
    </div>
@else
    <select name="{{ $name }}" {!! $attributes->merge([
        'class' =>
            'text-black-400 block w-full rounded-md border-gray-300 p-2 pr-10 shadow-md focus:border-gray-500 focus:ring-gray-500 disabled:cursor-not-allowed	disabled:bg-gray-100',
    ]) !!}
        {{ $disabled != false ? 'disabled' : '' }}>
        @if (!$options)
            {{ $slot }}
        @else
            <option value="">{{ $defaultSelect }}
            </option>
            @forelse ($options as $key => $label)
                <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @empty
                <option value="0">Nenhum item disponível</option>
            @endforelse
        @endif
    </select>

@endif
