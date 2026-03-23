@csrf

<label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Title</span>
    <input
        type="text"
        name="title"
        value="{{ old('title', $task->title ?? '') }}"
        required
        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white"
    >
</label>

<label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700">Description</span>
    <textarea
        name="description"
        rows="4"
        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white"
    >{{ old('description', $task->description ?? '') }}</textarea>
</label>

<div class="grid gap-5 md:grid-cols-2">
    <label class="block">
        <span class="mb-2 block text-sm font-medium text-slate-700">Status</span>
        <select name="status" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(old('status', $task->status->value ?? '') === $status->value)>{{ $status->value }}</option>
            @endforeach
        </select>
    </label>

    <label class="block">
        <span class="mb-2 block text-sm font-medium text-slate-700">Due date</span>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white"
        >
    </label>
</div>

<div class="flex flex-wrap items-center gap-3 pt-2">
    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('projects.show', $project) }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
        Cancel
    </a>
</div>
