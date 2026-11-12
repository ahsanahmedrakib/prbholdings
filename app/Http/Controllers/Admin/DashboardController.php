<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\ContactMessage;
use App\Models\HeroSlide;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            ['label' => 'Total Projects', 'value' => Project::count(), 'icon' => 'building'],
            ['label' => 'Published Projects', 'value' => Project::where('is_active', true)->count(), 'icon' => 'check'],
            ['label' => 'Hero Slides', 'value' => HeroSlide::count(), 'icon' => 'sparkles'],
            ['label' => 'Unread Enquiries', 'value' => ContactMessage::where('is_read', false)->count(), 'icon' => 'mail'],
        ];

        $recentMessages = ContactMessage::query()->latest()->take(6)->get();
        $recentProjects = Project::query()->latest('updated_at')->take(5)->get();

        $counts = [
            'testimonials' => Testimonial::count(),
            'amenities' => Amenity::count(),
        ];

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects', 'counts'));
    }
}