<div>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Classes') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-base font-semibold leading-6 text-gray-900">Turmas</h2>
                        <p class="mt-2 text-sm text-gray-700">Listagem de Turmas</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <x-primary-button
                            wire:click="$dispatch('openModal', {
                            component: 'classes.form' })">Adicionar</x-primary-button>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Nome</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Turno</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Vagas</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Ano letivo</th>

                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Série</th>
                                            <th scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @forelse ($this->classes as $item)
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ $item->name }}</td>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $item->shiftName }}</td>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $item->vacancies }}
                                                </td>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $item->school_year }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $item->gradeName }}
                                                </td>

                                                <td
                                                    class="flex items-center justify-evenly py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                                    <button
                                                        wire:click="$dispatch('openModal', {
                            component: 'classes.form',  arguments: { class: {{ $item }}} })"
                                                        class="text-yellow-500 hover:text-yellow-700">
                                                        <x-tooltip title="Editar">
                                                            <x-heroicon-o-pencil class="h-6 w-6" />
                                                        </x-tooltip>
                                                    </button>

                                                    <button type="button"
                                                        wire:click="tryDelete({{ $item->id }})"
                                                        class="text-red-600 hover:text-red-900">
                                                        <x-tooltip title="Excluir">
                                                            <x-heroicon-o-trash class="h-6 w-6" />
                                                        </x-tooltip>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"
                                                    class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                    Nenhum registro encontrado
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="border-t px-6 py-4">
                                    {{ $this->classes->links() }}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
