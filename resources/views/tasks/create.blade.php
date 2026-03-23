<x-layouts.app :title="'Create Task | TaskFlow'">
    <section class="mx-auto max-w-3xl rounded-[2rem] border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Create task</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $project->name }}</h1>
        <p class="mt-2 text-sm text-slate-500">Add a task under this project and assign its current status.</p>

        <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="mt-8 space-y-5">
            @include('tasks._form', ['submitLabel' => 'Create task'])
        </form>
    </section>
</x-layouts.app>
