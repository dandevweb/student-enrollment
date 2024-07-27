<div class="rounded-lg border shadow-lg">
    <x-header-modal title="{{ isset($class->id) ? 'Editar Turma' : 'Cadastrar Turma' }}" />
    <form wire:submit='save' class="space-y-4 p-4">
        <div class="grid items-center gap-4 lg:flex">
            <div class="lg:w-1/2">
                <x-form.label>Nome da turma*</x-form.label>
                <x-form.input wire:model.lazy="form.name" />
                <x-form.input-error for="form.name" />
            </div>

            <div class="lg:w-1/2">
                <x-form.label>Turno*</x-form.label>
                <x-form.select wire:model.lazy="form.shift" class="text-sm">
                    <option value="">Selecione</option>
                    @foreach ($this->shifts as $shift)
                        <option value="{{ $shift['value'] }}">
                            {{ $shift['name'] }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input-error for="form.shift" />
            </div>
        </div>

        <div class="grid items-center gap-4 lg:flex">

            <div class="lg:w-1/3">
                <x-form.label>Vagas*</x-form.label>
                <x-form.input type="number" wire:model.lazy="form.vacancies" />
                <x-form.input-error for="form.vacancies" />
            </div>

            <div class="lg:w-1/3">
                <x-form.label>Ano letivo*</x-form.label>
                <x-form.input type="number" min="1900" max="2099" step="1"
                    value="{{ date('Y') }}" wire:model.lazy="form.school_year" />
                <x-form.input-error for="form.school_year" />
            </div>

            <div class="lg:w-1/3">
                <x-form.label>Série*</x-form.label>
                <x-form.select wire:model.lazy="form.grade" class="text-sm">
                    <option value="">Selecione</option>
                    @foreach ($this->grades as $grade)
                        <option value="{{ $grade['value'] }}">
                            {{ $grade['name'] }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input-error for="form.grade" />
            </div>
        </div>

        <div class="flex justify-end border-t pt-4">
            <x-primary-button>Salvar</x-primary-button>
        </div>
    </form>
</div>
