@props(['students' => [], 'classId' => null])

<div
    class="min-h-96 group max-h-[calc(100vh-400px)] w-full overflow-y-auto rounded-lg bg-white p-4 shadow-lg">
    <div class="space-y-2" x-data class-id="{{ $classId }}" x-init="Sortablejs.create($el, {
        animation: 150,
        group: 'group',
        onSort: ({ from, to }) => {
            const classFromId = from.getAttribute('class-id') ?? null;
            const classToId = to.getAttribute('class-id');
            const studentFromIds = Array.from(from.children).map((item) => item.getAttribute('student-id'));
            const studentToIds = Array.from(to.children).map((item) => item.getAttribute('student-id'));

            @this.enrollStudent(studentFromIds, studentToIds, classFromId, classToId);
        }

    })">
        @forelse ($students as $student)
            <div student-id="{{ $student->id }}" class="cursor-pointer rounded-lg bg-gray-200 p-2">
                <span class="font-semibold">{{ $student->registration }}</span>
                - {{ $student->full_name }}
            </div>
        @empty
        @endforelse
    </div>
</div>
