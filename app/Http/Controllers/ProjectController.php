<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = trim((string) $request->query('q', ''));

        $projects = Project::query()
            ->active()
            ->when(in_array($status, ['ongoing', 'upcoming', 'completed', 'ready'], true), fn ($query) => $query->where('status', $status))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('tagline', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->paginate(9)
            ->withQueryString();

        $statusCounts = [
            'all' => Project::query()->active()->count(),
            'ongoing' => Project::query()->active()->where('status', 'ongoing')->count(),
            'upcoming' => Project::query()->active()->where('status', 'upcoming')->count(),
            'completed' => Project::query()->active()->where('status', 'completed')->count(),
            'ready' => Project::query()->active()->where('status', 'ready')->count(),
        ];

        return view('pages.projects.index', compact('projects', 'status', 'search', 'statusCounts'));
    }

    public function show(Project $project): View
    {
        abort_unless($project->is_active, 404);

        $project->load(['gallery', 'floorPlans']);

        $related = Project::query()
            ->active()
            ->whereKeyNot($project->getKey())
            ->orderByRaw('CASE WHEN status = ? THEN 0 ELSE 1 END', [$project->status])
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $amenities = Amenity::query()->active()->get();

        return view('pages.projects.show', compact('project', 'related', 'amenities'));
    }
}
