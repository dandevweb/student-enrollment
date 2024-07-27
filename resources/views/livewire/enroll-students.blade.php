<div>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Classes') }}
        </h1>
    </x-slot>

    <div class="py-12 overflow-auto">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl mb-4">
                <label for="grade" class="block text-sm font-medium text-gray-700">Selecionar
                    Série</label>
                <select wire:model.live="grade"
                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="">Selecione</option>
                    @foreach ($this->grades as $grade)
                        <option value="{{ $grade['value'] }}">{{ $grade['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-4 overflow-x-auto">

                <div class="flex gap-4" x-data x-init="Sortablejs.create($el, {
                    animation: 150,
                    handle: '.move-class',
                    onSort: ({ to }) => {
                        const classIds = Array.from(to.children).map((item) => item.getAttribute('class-id'));
                        @this.updateClassesOrder(classIds);
                    }
                })">

                    <div class="w-80" class-id="">
                        <div class="flex items-center justify-between">
                            <div class="mb-2">
                                <h2 class="text-xl font-bold">Alunos</h2>
                                <p>Alunos sem turma</p>
                            </div>


                        </div>
                        <x-students-group :students="$students" />
                    </div>

                    @foreach ($classes as $class)
                        <div class="w-80" class-id="{{ $class->id }}">
                            <div class="flex items-center justify-between">
                                <div class="mb-2">
                                    <h2 class="font-semibold">{{ $class->gradeName }} -
                                        Turma {{ $class->name }}
                                    </h2>
                                    <p>
                                        {{ $class->shiftName }} -
                                        {{ $class->enrollments->count() }}/{{ $class->vacancies }}
                                        vagas
                                    </p>
                                </div>

                                <button type="button"
                                    class="inline-flex items-center justify-center text-sm text-gray-400 bg-gray-200 rounded-lg ms-auto h-7 w-7 hover:bg-gray-300 hover:text-gray-900">
                                    <x-heroicon-o-arrows-right-left
                                        class="w-6 h-6 font-semibold move-class" />
                                </button>
                            </div>
                            <x-students-group :students="$class->students" :classId="$class->id" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
