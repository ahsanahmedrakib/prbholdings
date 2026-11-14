<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $members = TeamMember::query()->active()->orderBy('sort_order')->get();

        $management = $members->where('category', 'management')->values();

        $chairman = $management->first(
            fn (TeamMember $member) => str_contains(strtolower((string) $member->designation), 'chairman')
        ) ?? $management->first();

        return view('pages.about', compact('management', 'chairman'));
    }

    public function team(): View
    {
        $members = TeamMember::query()->active()->orderBy('sort_order')->get();

        $teamGroups = $members
            ->groupBy('category')
            ->sortBy(fn ($group, $category) => array_search($category, array_keys(TeamMember::CATEGORIES), true));

        return view('pages.team', compact('members', 'teamGroups'));
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function gallery(): View
    {
        $images = GalleryImage::query()->active()->get();

        return view('pages.gallery', compact('images'));
    }

    public function contact(): View
    {
        $projects = Project::query()->active()->orderBy('sort_order')->get();

        return view('pages.contact', compact('projects'));
    }
}
