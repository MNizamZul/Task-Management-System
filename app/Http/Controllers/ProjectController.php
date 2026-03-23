<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        return view('projects.index', [
            'projects' => $request->user()->projects()
                ->withCount('tasks')
                ->latest()
                ->paginate(9),
        ]);
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $project = $request->user()->projects()->create($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'Project created successfully.');
    }

    public function show(Request $request, Project $project): View
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        $selectedStatus = $request->string('status')->value();
        $statuses = TaskStatus::values();
        $statusFilter = in_array($selectedStatus, $statuses, true) ? $selectedStatus : null;

        $tasks = $project->tasks()
            ->when($statusFilter, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.show', [
            'project' => $project,
            'tasks' => $tasks,
            'selectedStatus' => $statusFilter,
            'statuses' => $statuses,
        ]);
    }

    public function edit(Request $request, Project $project): View
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        return view('projects.edit', [
            'project' => $project,
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        $project->update($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'Project updated successfully.');
    }

    public function destroy(Request $request, Project $project): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project deleted successfully.');
    }
}
