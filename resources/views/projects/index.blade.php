<x-layouts.app :title="'Projects | TaskFlow'">
    <section class="space-y-8">
        <div class="flex flex-col gap-4 rounded-[2rem] border border-white/70 bg-white/85 p-6 shadow-lg shadow-slate-200/70 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Projects</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Manage all of your projects</h1>
                <p class="mt-2 text-sm text-slate-500">Each project belongs only to your account and holds its own set of tasks.</p>
            </div>

            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                New project
            </a>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($projects as $project)
                <div class="rounded-[1.75rem] border border-white/70 bg-white/90 p-6 shadow-lg shadow-slate-200/60">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-slate-900">{{ $project->name }}</h2>
                            <p class="mt-2 text-sm text-slate-500">{{ $project->tasks_count }} task{{ $project->tasks_count === 1 ? '' : 's' }}</p>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
                            {{ $project->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('projects.show', $project) }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Open</a>
                        <a href="{{ route('projects.edit', $project) }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                            Edit
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white/80 p-8 text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                    No projects yet. Create your first project to begin organizing tasks.
                </div>
            @endforelse
        </div>

        <div>
            {{ $projects->links() }}
        </div>
    </section>
</x-layouts.app>
