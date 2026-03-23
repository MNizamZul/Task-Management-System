<?php

namespace Database\Seeders;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Assessment Demo',
            'email' => 'admin@example.com',
        ]);

        $projects = collect([
            'Website Redesign',
            'Client Onboarding',
            'Internal Tools Refresh',
        ])->map(fn (string $name) => $user->projects()->create(['name' => $name]));

        $statuses = TaskStatus::cases();

        foreach ($projects as $index => $project) {
            foreach (range(1, 4) as $number) {
                $status = $statuses[($index + $number - 1) % count($statuses)];

                $project->tasks()->create([
                    'title' => "{$project->name} Task {$number}",
                    'description' => "Sample task {$number} for {$project->name}.",
                    'status' => $status->value,
                    'due_date' => now()->addDays($number + ($index * 2))->toDateString(),
                ]);
            }
        }
    }
}
