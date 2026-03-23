<?php

namespace Tests\Feature;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_project_and_task_counts_for_authenticated_user_only(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $project = Project::factory()->for($user)->create();
        Task::factory()->for($project)->create(['status' => TaskStatus::Todo->value]);
        Task::factory()->for($project)->create(['status' => TaskStatus::Done->value]);

        $otherProject = Project::factory()->for($otherUser)->create();
        Task::factory()->for($otherProject)->create(['status' => TaskStatus::InProgress->value]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Total Projects')
            ->assertSee('Total Tasks')
            ->assertSee((string) 1)
            ->assertSee((string) 2)
            ->assertDontSee($otherProject->name);
    }
}
