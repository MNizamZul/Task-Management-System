<x-layouts.app :title="$project->name . ' | TaskFlow'">
    <section class="space-y-8">
        <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-lg shadow-slate-200/70">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Project overview</p>
                    <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $project->name }}</h1>
                    <p class="mt-2 text-sm text-slate-500">Created on {{ $project->created_at->format('d M Y') }}. Filter tasks by status or manage them individually below.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('projects.tasks.create', $project) }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Add task
                    </a>
                    <a href="{{ route('projects.edit', $project) }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                        Edit project
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-lg shadow-slate-200/70 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Tasks</h2>
                <p class="text-sm text-slate-500">Filter the list to focus on one workflow stage.</p>
            </div>

            <form method="GET" action="{{ route('projects.show', $project) }}" class="flex flex-wrap items-center gap-3">
                <select name="status" onchange="this.form.submit()" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ $status }}</option>
                    @endforeach
                </select>
                @if ($selectedStatus)
                    <a href="{{ route('projects.show', $project) }}" class="rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">Reset</a>
                @endif
            </form>
        </div>

        <div class="space-y-4">
            @forelse ($tasks as $task)
                <article class="rounded-[1.75rem] border border-white/70 bg-white/90 p-6 shadow-lg shadow-slate-200/60">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl">
                            <div class="flex flex-wrap items-center gap-3">
                                <h3 class="text-xl font-semibold text-slate-900">{{ $task->title }}</h3>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] {{ $task->status->badgeClasses() }}">
                                    {{ $task->status->value }}
                                </span>
                            </div>

                            @if ($task->description)
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $task->description }}</p>
                            @endif

                            <div class="mt-4 flex flex-wrap gap-5 text-sm text-slate-500">
                                <span>Created {{ $task->created_at->format('d M Y') }}</span>
                                <span>Due {{ $task->due_date?->format('d M Y') ?? 'Not set' }}</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-2xl border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white/80 p-8 text-sm text-slate-500">
                    No tasks match this project yet. Create a task to get started.
                </div>
            @endforelse
        </div>

        <div>
            {{ $tasks->links() }}
        </div>
    </section>
</x-layouts.app>
