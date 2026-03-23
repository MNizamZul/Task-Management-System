<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function create(Request $request, Project $project): View
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        return view('tasks.create', [
            'project' => $project,
            'statuses' => TaskStatus::cases(),
        ]);
    }

    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        $project->tasks()->create($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'Task created successfully.');
    }

    public function edit(Request $request, Project $project, Task $task): View
    {
        abort_unless($project->user_id === $request->user()->id && $task->project_id === $project->id, 404);

        return view('tasks.edit', [
            'project' => $project,
            'task' => $task,
            'statuses' => TaskStatus::cases(),
        ]);
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id && $task->project_id === $project->id, 404);

        $task->update($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'Task updated successfully.');
    }

    public function destroy(Request $request, Project $project, Task $task): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id && $task->project_id === $project->id, 404);

        $task->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'Task deleted successfully.');
    }
}
