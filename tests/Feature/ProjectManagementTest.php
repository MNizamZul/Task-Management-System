<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_route_requires_authentication(): void
    {
        $this->get('/projects')->assertRedirect('/login');
    }

    public function test_users_only_see_their_own_projects(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Project::factory()->for($user)->create(['name' => 'Owned Project']);
        Project::factory()->for($otherUser)->create(['name' => 'Hidden Project']);

        $this->actingAs($user)
            ->get('/projects')
            ->assertOk()
            ->assertSee('Owned Project')
            ->assertDontSee('Hidden Project');
    }

    public function test_authenticated_user_can_create_update_and_delete_project(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/projects', ['name' => 'Launch Plan'])
            ->assertRedirect();

        $project = Project::query()->firstOrFail();

        $this->actingAs($user)
            ->put("/projects/{$project->id}", ['name' => 'Updated Launch Plan'])
            ->assertRedirect("/projects/{$project->id}");

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Updated Launch Plan',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->delete("/projects/{$project->id}")
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_users_cannot_access_another_users_project_details(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->for($otherUser)->create();

        $this->actingAs($user)
            ->get("/projects/{$project->id}")
            ->assertNotFound();
    }
}
