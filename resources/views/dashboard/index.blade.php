<x-layouts.app :title="'Dashboard | Task Management System'">
    <section class="space-y-8">
        <div class="flex flex-col gap-4 rounded-[2rem] border border-white/70 bg-white/85 p-6 shadow-lg shadow-slate-200/70 backdrop-blur md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Dashboard</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Track your workload at a glance</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-500">Monitor projects, task volume, and progress status from one place.</p>
            </div>

            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                Create project
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-[1.75rem] bg-slate-900 p-6 text-white shadow-lg shadow-slate-300/40">
                <p class="text-sm text-slate-300">Total Projects</p>
                <p class="mt-3 text-4xl font-semibold">{{ $projectCount }}</p>
            </div>
            <div class="rounded-[1.75rem] bg-white p-6 shadow-lg shadow-slate-200/60">
                <p class="text-sm text-slate-500">Total Tasks</p>
                <p class="mt-3 text-4xl font-semibold text-slate-900">{{ $taskCount }}</p>
            </div>
            @foreach ($statusCounts as $status)
                <div class="rounded-[1.75rem] p-6 shadow-lg {{ $status['card_classes'] }}">
                    <p class="text-sm {{ $status['label_classes'] }}">{{ $status['label'] }}</p>
                    <p class="mt-3 text-4xl font-semibold">{{ $status['count'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="rounded-[2rem] border border-white/70 bg-white/85 p-6 shadow-lg shadow-slate-200/70">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Recent projects</h2>
                    <p class="text-sm text-slate-500">Jump back into your most recently created workspaces.</p>
                </div>
                <a href="{{ route('projects.index') }}" class="text-sm font-semibold text-cyan-700 hover:text-cyan-800">View all projects</a>
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($recentProjects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:bg-white">
                        <p class="text-lg font-semibold text-slate-900">{{ $project->name }}</p>
                        <p class="mt-2 text-sm text-slate-500">{{ $project->tasks_count }} task{{ $project->tasks_count === 1 ? '' : 's' }}</p>
                        <p class="mt-4 text-xs uppercase tracking-[0.25em] text-slate-400">Created {{ $project->created_at->format('d M Y') }}</p>
                    </a>
                @empty
                    <div class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                        You have not created any projects yet. Start by creating your first project.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.app>
