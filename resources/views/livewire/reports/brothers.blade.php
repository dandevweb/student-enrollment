<div>
    <h3 class="text-2xl font-semibold leading-6 text-gray-900">Irmãos</h3>
    <div class="">

        <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
            <div>
                <div>
                    <x-form.label>Buscar</x-form.label>
                    <x-form.input-icon type="search" icon="magnifying-glass"
                        wire:model.live.debounce.500ms="search"
                        placeholder="Busque alunos pelo nome da mãe ou do pai..." />
                </div>
            </div>
            <div class="flow-root mt-8">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Aluno</th>

                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Série</th>

                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Turma</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Período</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($this->students as $item)
                                        <tr>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $item->full_name }}</td>
                                            </td>

                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $item->grade_name }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $item->classes()->latest()->first()?->name ?? 'Não matriculado(a)' }}
                                            </td>

                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $item->classes()->latest()->first()?->shiftName ?? 'Não matriculado(a)' }}
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                Nenhum registro encontrado
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
