<div class="rounded-lg border shadow-lg">
    <x-header-modal title="Cadastrar Aluno" />
    <form wire:submit='save' class="space-y-4 p-4">
        <div class="grid items-center gap-4 lg:flex">
            <div class="lg:w-2/4">
                <x-form.label>Nome completo*</x-form.label>
                <x-form.input wire:model.lazy="form.full_name" />
                <x-form.input-error for="form.full_name" />
            </div>

            <div class="lg:w-1/4">
                <x-form.label>Data de nascimento*</x-form.label>
                <x-form.input type="date" wire:model.lazy="form.birth_date" />
                <x-form.input-error for="form.birth_date" />
            </div>

            <div class="lg:w-1/4">
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

        <div class="grid items-center gap-4 lg:flex">
            <div class="lg:w-2/4">
                <x-form.label>Nome da mãe*</x-form.label>
                <x-form.input wire:model.lazy="form.mother_name" />
                <x-form.input-error for="form.mother_name" />
            </div>

            <div class="lg:w-2/4">
                <x-form.label>Nome do pai*</x-form.label>
                <x-form.input wire:model.lazy="form.father_name" />
                <x-form.input-error for="form.father_name" />
            </div>
        </div>

        <div class="border-b py-2">
            <h4 class="text-lg text-gray-700">
                Endereço
            </h4>
        </div>

        <div class="grid items-center gap-4 lg:flex">

            <div class="lg:w-2/12">
                <x-form.label>Tipo*</x-form.label>
                <x-form.select wire:model.lazy="form.address_type" class="text-sm">
                    <option value="">Selecione*</option>
                    @foreach ($this->addressTypes as $address)
                        <option value="{{ $address['value'] }}">
                            {{ $address['name'] }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input-error for="form.address_type" />
            </div>

            <div class="lg:w-3/12">
                <x-form.label>CEP*</x-form.label>
                <x-form.input wire:model.lazy="form.zip_code" x-mask="99999-999" />
                <x-form.input-error for="form.zip_code" />
            </div>

            <div class="lg:w-4/12">
                <x-form.label>Rua*</x-form.label>
                <x-form.input wire:model.lazy="form.street" />
                <x-form.input-error for="form.street" />
            </div>

            <div class="lg:w-1/12">
                <x-form.label>Número*</x-form.label>
                <x-form.input wire:model.lazy="form.number" />
                <x-form.input-error for="form.number" />
            </div>

            <div class="lg:w-2/12">
                <x-form.label>Complemento</x-form.label>
                <x-form.input wire:model.lazy="form.complement" />
                <x-form.input-error for="form.complement" />
            </div>
        </div>

        <div class="flex justify-end border-t pt-4">
            <x-primary-button>Salvar</x-primary-button>
        </div>
    </form>
</div>
