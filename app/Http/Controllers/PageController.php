<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $projects = Project::query()->active()->orderBy('sort_order')->get();
        $amenities = Amenity::query()->active()->get();
        $testimonials = Testimonial::query()->active()->orderBy('sort_order')->take(3)->get();

        $stats = [
            ['value' => $projects->count(), 'suffix' => '+', 'label' => 'Residential Projects'],
            ['value' => (int) $projects->sum('total_apartments'), 'suffix' => '+', 'label' => 'Apartments Designed'],
            ['value' => $projects->pluck('location')->unique()->count(), 'suffix' => '', 'label' => 'Prime Neighbourhoods'],
            ['value' => 24, 'suffix' => '/7', 'label' => 'Care & Security'],
        ];

        return view('pages.about', compact('projects', 'amenities', 'testimonials', 'stats'));
    }

    public function gallery(Request $request): View
    {
        $projects = Project::query()
            ->active()
            ->with(['gallery'])
            ->orderBy('sort_order')
            ->get();

        $activeProject = $request->query('project');

        $images = $projects
            ->when($activeProject, fn ($collection) => $collection->where('slug', $activeProject))
            ->flatMap(function (Project $project) {
                $items = collect();

                if ($project->hero_image) {
                    $items->push([
                        'url' => $project->hero_image_url,
                        'caption' => $project->name,
                        'project' => $project->name,
                        'slug' => $project->slug,
                    ]);
                }

                foreach ($project->gallery as $image) {
                    $items->push([
                        'url' => $image->image_url,
                        'caption' => $image->caption ?: $project->name,
                        'project' => $project->name,
                        'slug' => $project->slug,
                    ]);
                }

                return $items;
            })
            ->values();

        return view('pages.gallery', compact('projects', 'images', 'activeProject'));
    }

    public function contact(): View
    {
        $projects = Project::query()->active()->orderBy('sort_order')->get();

        return view('pages.contact', compact('projects'));
    }
}
