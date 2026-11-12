<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\HeroSlide;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()->active()->orderBy('sort_order')->get();
        $featuredProjects = $projects->where('is_featured', true)->take(8);
        $completedProjects = $projects->where('status', 'completed')->take(8);
        $slides = HeroSlide::query()->active()->orderBy('sort_order')->get();
        $amenities = Amenity::query()->active()->get();
        $testimonials = Testimonial::query()->active()->with('project')->orderBy('sort_order')->take(6)->get();

        $stats = [
            ['value' => $projects->count(), 'suffix' => '+', 'label' => 'Residential Projects'],
            ['value' => (int) $projects->sum('total_apartments'), 'suffix' => '+', 'label' => 'Apartments Designed'],
            ['value' => $projects->pluck('location')->unique()->count(), 'suffix' => '', 'label' => 'Prime Neighbourhoods'],
            ['value' => 24, 'suffix' => '/7', 'label' => 'Care & Security'],
        ];

        return view('pages.home', compact(
            'projects',
            'featuredProjects',
            'completedProjects',
            'slides',
            'amenities',
            'testimonials',
            'stats'
        ));
    }
}
