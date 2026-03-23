<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_authentication(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_user_can_create_update_and_delete_tasks_inside_own_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();

        $this->actingAs($user)
            ->post("/projects/{$project->id}/tasks", [
                'title' => 'Ship MVP',
                'description' => 'Finalize the first release.',
                'status' => TaskStatus::InProgress->value,
                'due_date' => now()->addWeek()->toDateString(),
            ])
            ->assertRedirect("/projects/{$project->id}");

        $task = Task::query()->firstOrFail();

        $this->actingAs($user)
            ->put("/projects/{$project->id}/tasks/{$task->id}", [
                'title' => 'Ship MVP v2',
                'description' => 'Finalize the second release.',
                'status' => TaskStatus::Done->value,
                'due_date' => now()->addDays(10)->toDateString(),
            ])
            ->assertRedirect("/projects/{$project->id}");

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Ship MVP v2',
            'status' => TaskStatus::Done->value,
        ]);

        $this->actingAs($user)
            ->delete("/projects/{$project->id}/tasks/{$task->id}")
            ->assertRedirect("/projects/{$project->id}");

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_task_status_is_validated_against_allowed_values(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();

        $this->actingAs($user)
            ->post("/projects/{$project->id}/tasks", [
                'title' => 'Broken status',
                'status' => 'Blocked',
            ])
            ->assertSessionHasErrors('status');
    }

    public function test_task_filtering_only_returns_matching_statuses(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();

        Task::factory()->for($project)->create([
            'title' => 'Todo task',
            'status' => TaskStatus::Todo->value,
        ]);

        Task::factory()->for($project)->create([
            'title' => 'Done task',
            'status' => TaskStatus::Done->value,
        ]);

        $this->actingAs($user)
            ->get('/projects/'.$project->id.'?status='.urlencode(TaskStatus::Done->value))
            ->assertOk()
            ->assertSee('Done task')
            ->assertDontSee('Todo task');
    }

    public function test_users_cannot_manage_tasks_from_another_users_project(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->for($otherUser)->create();
        $task = Task::factory()->for($project)->create();

        $this->actingAs($user)
            ->get("/projects/{$project->id}/tasks/{$task->id}/edit")
            ->assertNotFound();
    }
}
