@props(['title'])
<div class="flex items-center justify-between rounded-t border-b p-4 pb-2">
    <div>
        <h3 class="text-xl font-semibold text-gray-700">
            {{ $title }}
        </h3>
    </div>
    <button type="button"
        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
        wire:click="$dispatch('closeModal')">
        <x-heroicon-o-x-mark class="h-5 w-5" />
    </button>
</div>
