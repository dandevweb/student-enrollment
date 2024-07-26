@props([
    'options' => [],
    'value' => '',
    'name' => '',
    'defaultSelect' => 'Selecione',
    'wireFunction' => '',
])

<div x-cloak x-data="{
    {{ $name }}: {{ $value }},
    open: false,
    filter: '',
    selected: '{{ data_get($options, $value, 'Selecione') }}'
}" class="relative mt-1 w-full">
    <div x-on:click="open = !open"
        class="flex min-h-[2rem] w-full items-center gap-2 rounded-lg border border-gray-300 p-2 shadow-md"
        x-text="selected">
    </div>
    <div class="absolute z-[49] flex w-full cursor-pointer flex-col gap-3 rounded-lg bg-white p-3 pt-1 shadow-lg"
        x-show="open" x-trap="open" @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200"
        x-transition:enter-start="!opacity-0 !mt-0" x-transition:enter-end="!opacity-1 !mt-3"
        x-transition:leave=" ease-out duration-200" x-transition:leave-start="!opacity-1 !mt-3"
        x-transition:leave-end="!opacity-0 !mt-0">
        <input x-model="filter" placeholder="Filtrar"
            class="-mx-3 rounded border-b px-3 py-1 outline-none focus:border-gray-500 focus:ring-gray-500"
            type="text">
        <p x-show="! $el.parentNode.innerText.toLowerCase().includes(filter.toLowerCase())"
            class="font-bolc text-center text-2xl text-gray-400">
            –
        </p>

        @forelse ($options as $key => $val)
            <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())"
                class="flex items-center">
                <input x-on:click="open = false; selected = '{{ $val }}'"
                    wire:click="{{ $wireFunction . '(' . $key . ')' }}"
                    x-model="{{ $name }}" name="{{ $name }}[]"
                    id="{{ $name . $key }}" type="radio" value="{{ $key }}"
                    class="h-4 w-4 rounded-full border-gray-300 bg-gray-100 text-gray-600 focus:ring-gray-500">
                <label for="{{ $name . $key }}"
                    class="ml-2 flex-grow cursor-pointer text-sm font-medium text-gray-900">{{ $val }}</label>
            </div>
        @empty
            <p class="text-center text-xl text-gray-400">
                Nenhum item disponível
            </p>
        @endforelse
    </div>
</div>
