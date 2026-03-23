<x-layouts.app :title="'Edit Project | TaskFlow'">
    <section class="mx-auto max-w-2xl rounded-[2rem] border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Edit project</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $project->name }}</h1>
        <p class="mt-2 text-sm text-slate-500">Update the project name or remove the project if it is no longer needed.</p>

        <form method="POST" action="{{ route('projects.update', $project) }}" class="mt-8 space-y-5">
            @method('PUT')
            @include('projects._form', ['submitLabel' => 'Save changes', 'project' => $project])
        </form>

        <form method="POST" action="{{ route('projects.destroy', $project) }}" class="mt-8 border-t border-slate-200 pt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-2xl border border-rose-200 px-5 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
                Delete project
            </button>
        </form>
    </section>
</x-layouts.app>
