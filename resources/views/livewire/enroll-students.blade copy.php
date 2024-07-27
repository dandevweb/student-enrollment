<div>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Classes') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <label for="grade" class="block text-sm font-medium text-gray-700">Selecionar
                    Série</label>
                <select wire:model.live="grade" id="grade" name="grade"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="">Selecione</option>
                    @foreach ($this->grades as $grade)
                        <option value="{{ $grade['value'] }}">{{ $grade['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <h2 class="mb-2 text-xl font-bold">Alunos</h2>
                    <div class="h-96 overflow-y-auto rounded-lg bg-white p-4 shadow-md">
                        <!-- Lista de Alunos -->
                        <div id="students-list" class="space-y-2">
                            @foreach ($students as $student)
                                <div id="student-{{ $student->id }}"
                                    class="cursor-pointer rounded-lg bg-gray-200 p-2"
                                    draggable="true" ondragstart="drag(event)">
                                    <span class="font-semibold">{{ $student->registration }}</span>
                                    - {{ $student->full_name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="mb-2 text-xl font-bold">Turmas</h2>
                    <div class="grid h-96 gap-4 overflow-y-auto rounded-lg bg-white p-4 shadow-md">
                        @foreach ($classes as $class)
                            <div id="class-{{ $class->id }}"
                                class="cursor-pointer rounded-lg border-b bg-gray-200 p-2"
                                ondrop="drop(event)" ondragover="allowDrop(event)">
                                <h3 class="font-semibold">{{ $class->name }}</h3>
                                <p>Turno: {{ $class->shiftName }}</p>
                                <p>Vagas: {{ $class->vacancies }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function allowDrop(event) {
        event.preventDefault();
    }

    function drag(event) {
        event.dataTransfer.setData("text", event.target.id);
    }

    function drop(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("text");
        event.target.appendChild(document.getElementById(data));
    }
</script>
