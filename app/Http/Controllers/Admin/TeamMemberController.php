<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Support\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        $members = TeamMember::query()->orderBy('category')->orderBy('sort_order')->paginate(15);

        return view('admin.team.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.team.form', [
            'member' => new TeamMember([
                'category' => 'management',
                'is_active' => true,
                'sort_order' => (TeamMember::max('sort_order') ?? 0) + 1,
            ]),
            'categories' => TeamMember::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMember($request);
        $validated['image'] = ImageUpload::store($request->file('image_file'), 'team', 'member');
        $validated['is_active'] = $request->boolean('is_active');

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.form', [
            'member' => $team,
            'categories' => TeamMember::CATEGORIES,
        ]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('image_file')) {
            ImageUpload::delete($team->image);
            $validated['image'] = ImageUpload::store($request->file('image_file'), 'team', 'member');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        ImageUpload::delete($team->image);
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'designation' => ['nullable', 'string', 'max:120'],
            'category' => ['required', 'in:'.implode(',', array_keys(TeamMember::CATEGORIES))],
            'bio' => ['nullable', 'string', 'max:5000'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:60'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_file' => ['nullable', 'image', 'max:6144'],
        ]);
    }
}
