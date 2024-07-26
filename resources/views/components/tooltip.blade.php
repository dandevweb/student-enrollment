<span x-cloak x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
    class="relative z-20">
    <span>
        {{ $slot }}
    </span>
    <div x-show="tooltip"
        class="absolute -right-3 bottom-7 w-40 transform rounded bg-gray-400 p-2 text-center text-sm text-white">
        {{ $title }}
    </div>
</span>
