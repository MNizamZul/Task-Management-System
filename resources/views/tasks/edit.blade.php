<x-layouts.app :title="'Edit Task | TaskFlow'">
    <section class="mx-auto max-w-3xl rounded-[2rem] border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Edit task</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $task->title }}</h1>
        <p class="mt-2 text-sm text-slate-500">Update the task details while keeping it inside the {{ $project->name }} project.</p>

        <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}" class="mt-8 space-y-5">
            @method('PUT')
            @include('tasks._form', ['submitLabel' => 'Save task', 'task' => $task])
        </form>
    </section>
</x-layouts.app>
