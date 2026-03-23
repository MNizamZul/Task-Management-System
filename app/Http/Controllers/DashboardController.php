<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $taskCounts = $user->tasks()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return view('dashboard.index', [
            'projectCount' => $user->projects()->count(),
            'taskCount' => $user->tasks()->count(),
            'statusCounts' => collect(TaskStatus::cases())->map(
                static fn (TaskStatus $status) => [
                    'label' => $status->value,
                    'count' => (int) ($taskCounts[$status->value] ?? 0),
                    'card_classes' => $status->dashboardCardClasses(),
                    'label_classes' => $status->dashboardLabelClasses(),
                ]
            ),
            'recentProjects' => $user->projects()
                ->withCount('tasks')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
