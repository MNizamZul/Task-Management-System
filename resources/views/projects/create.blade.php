<x-layouts.app :title="'Create Project | TaskFlow'">
    <section class="mx-auto max-w-2xl rounded-[2rem] border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Create project</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Start a new project space</h1>
        <p class="mt-2 text-sm text-slate-500">Give your project a clear name so related tasks are easy to find later.</p>

        <form method="POST" action="{{ route('projects.store') }}" class="mt-8 space-y-5">
            @include('projects._form', ['submitLabel' => 'Create project'])
        </form>
    </section>
</x-layouts.app>
