@props([
    'options' => [],
    'value' => '[]',
    'name' => '',
    'defaultSelect' => 'Selecione',
    'allOption' => false,
])

<div x-cloak x-data="{
    {{ $name }}: {{ $value }},
    open: false,
    filter: ''
}" class="relative mt-1 w-full">
    <div x-on:click="open = !open"
        class="flex h-10 w-full cursor-pointer items-center gap-2 truncate rounded-lg border border-gray-300 p-3 shadow-md"
        x-text="{{ $name }}.length > 0 ? {{ $name }}.length + ' Itens selecionados' : 'Selecione'">
    </div>
    <div class="absolute z-[52] flex h-auto max-h-52 w-full flex-col gap-3 overflow-y-auto rounded-lg border border-gray-300 bg-white p-3 pt-1 shadow-lg"
        x-show="open" x-trap="open" @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200"
        x-transition:enter-start="!opacity-0 !mt-0" x-transition:enter-end="!opacity-1 !mt-3"
        x-transition:leave=" ease-out duration-200" x-transition:leave-start="!opacity-1 !mt-3"
        x-transition:leave-end="!opacity-0 !mt-0">
        <input x-model="filter" placeholder="Filtrar"
            class="-mx-3 rounded-md border-b px-3 py-1 outline-none focus:border-gray-500 focus:ring-gray-500"
            type="text">
        <p x-show="! $el.parentNode.innerText.toLowerCase().includes(filter.toLowerCase())"
            class="font-bolc text-center text-2xl text-gray-400">
            –
        </p>
        <div x-show="'{{ $allOption }}' == 'true'" class="flex items-center">
            <input
                x-on:click="if ($event.target.checked) {{ $name }} = Object.keys({{ json_encode($options) }})"
                id="{{ $name }}" type="checkbox" value=""
                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-gray-600 focus:ring-gray-500">
            <label for="{{ $name }}"
                class="ml-2 flex-grow text-sm font-medium text-gray-900">Selecionar todos</label>
        </div>
        @forelse ($options as $key => $val)
            <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())"
                class="flex items-center">
                <input wire:model.defer="{{ $name }}" x-model="{{ $name }}"
                    name="{{ $name }}[]" id="{{ $name . $key }}" type="checkbox"
                    value="{{ $key }}"
                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-gray-600 focus:ring-gray-500">
                <label for="{{ $name . $key }}"
                    class="ml-2 flex-grow text-sm font-medium text-gray-900">{{ $val }}</label>
            </div>
        @empty
            <p class="font-bolc text-center text-2xl text-gray-400">
                Nenhum item disponível
            </p>
        @endforelse
    </div>
</div>
