@csrf

<label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Project name</span>
    <input
        type="text"
        name="name"
        value="{{ old('name', $project->name ?? '') }}"
        required
        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white"
    >
</label>

<div class="flex flex-wrap items-center gap-3 pt-2">
    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
        {{ $submitLabel }}
    </button>
    <a href="{{ isset($project) ? route('projects.show', $project) : route('projects.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
        Cancel
    </a>
</div>
