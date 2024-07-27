<div>
    <h3 class="text-2xl font-semibold leading-6 text-gray-900">Métricas</h3>
    <div class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-2">
        <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
            <div>
                <h5 class="mb-4 font-semibold uppercase border-b">Filtros</h5>
                <div class="flex gap-2">
                    <div class="lg:w-1/2">
                        <x-form.label>Segmento</x-form.label>
                        <x-form.select wire:model.live="segment" class="text-sm">
                            <option value="">Sem filtro</option>
                            @foreach ($this->segments as $segment)
                                <option value="{{ $segment['value'] }}">
                                    {{ $segment['name'] }}</option>
                            @endforeach
                        </x-form.select>
                    </div>

                    <div class="lg:w-1/2">
                        <x-form.label>Série</x-form.label>
                        <x-form.select wire:model.live="grade" class="text-sm"
                            disabled="{{ count($this->grades) < 1 }}">
                            <option value="">Sem filtro</option>
                            @foreach ($this->grades as $value => $name)
                                <option value="{{ $value }}">
                                    {{ $name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </div>
            <h3 class="mt-4 text-base font-medium text-gray-500">Total de alunos cadastrados</h3>
            <p class="mt-4 text-5xl font-semibold tracking-tight text-gray-800">
                {{ $this->totalStudents }}</p>
        </div>
        <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
            <div>
                <h5 class="mb-4 font-semibold uppercase border-b">Filtros</h5>
                <div>
                    <x-form.label>Turma</x-form.label>
                    <x-form.select wire:model.live="class" class="text-sm">
                        <option value="">Sem filtro</option>
                        @foreach ($this->classes as $class)
                            <option value="{{ $class->id }}">
                                {{ "{$class->gradeName} - {$class->name} | {$class->shiftName}" }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <h3 class="mt-4 text-base font-medium text-gray-500">Total de alunos matriculados</h3>
            <p class="mt-4 text-5xl font-semibold tracking-tight text-gray-800">
                {{ $this->totalEnrollments }}</p>
        </div>
    </div>
</div>
