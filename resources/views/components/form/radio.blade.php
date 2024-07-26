@props(['checked' => false, 'label' => ''])

<label class="whitespace-nowrap">
    <input type="radio"
        {{ $attributes->merge(['class' => 'w-4 h-4 border-gray-300 cursor-pointer text-gray-600 focus:ring-gray-600']) }}
        {{ $checked ? 'checked' : '' }}>
    {{ $label }}
</label>
