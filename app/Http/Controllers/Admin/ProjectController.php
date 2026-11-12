<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Support\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));

        $projects = Project::query()
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%")->orWhere('location', 'like', "%{$search}%"))
            ->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        return view('admin.projects.index', compact('projects', 'search'));
    }

    public function create(): View
    {
        $project = new Project([
            'status' => 'ongoing',
            'nature' => 'Residential',
            'is_active' => true,
            'sort_order' => (Project::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.projects.form', [
            'project' => $project,
            'statuses' => Project::STATUSES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProject($request);
        $data = $this->payload($request, $validated);
        $data['hero_image'] = ImageUpload::store($request->file('hero_image_file'), 'projects/'.$data['slug'], 'hero');
        $data['cover_image'] = ImageUpload::store($request->file('cover_image_file'), 'projects/'.$data['slug'], 'cover') ?: $data['hero_image'];
        $data['location_image'] = ImageUpload::store($request->file('location_image_file'), 'projects/'.$data['slug'], 'location');
        $data['brochure_file'] = ImageUpload::store($request->file('brochure_file'), 'projects/'.$data['slug'], 'brochure');

        $project = Project::create($data);

        $this->storeImages($project, $request);

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        $project->load('images');

        return view('admin.projects.form', [
            'project' => $project,
            'statuses' => Project::STATUSES,
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validateProject($request, $project);
        $data = $this->payload($request, $validated, $project);

        foreach (['hero_image_file' => 'hero_image', 'cover_image_file' => 'cover_image', 'location_image_file' => 'location_image', 'brochure_file' => 'brochure_file'] as $input => $column) {
            if ($request->hasFile($input)) {
                ImageUpload::delete($project->{$column});
                $prefix = Str::beforeLast($column, '_image') ?: 'file';
                $data[$column] = ImageUpload::store($request->file($input), 'projects/'.$data['slug'], $prefix);
            }
        }

        $project->update($data);

        if ($request->filled('remove_images')) {
            $images = ProjectImage::whereIn('id', (array) $request->input('remove_images'))
                ->where('project_id', $project->id)
                ->get();

            foreach ($images as $image) {
                ImageUpload::delete($image->image);
                $image->delete();
            }
        }

        $this->storeImages($project, $request);

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        foreach ($project->images as $image) {
            ImageUpload::delete($image->image);
        }

        foreach (['hero_image', 'cover_image', 'location_image', 'brochure_file'] as $column) {
            ImageUpload::delete($project->{$column});
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    private function validateProject(Request $request, ?Project $project = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:170', 'alpha_dash', Rule::unique('projects', 'slug')->ignore($project?->id)],
            'tagline' => ['nullable', 'string', 'max:200'],
            'location' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:ongoing,upcoming,completed'],
            'nature' => ['nullable', 'string', 'max:100'],
            'floors' => ['nullable', 'string', 'max:100'],
            'land_area' => ['nullable', 'string', 'max:100'],
            'facing' => ['nullable', 'string', 'max:100'],
            'total_apartments' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'total_lifts' => ['nullable', 'integer', 'min:0', 'max:99'],
            'ground_floor' => ['nullable', 'string'],
            'handover_year' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'features' => ['nullable', 'string'],
            'apartment_types' => ['nullable', 'array'],
            'apartment_types.*.type' => ['nullable', 'string', 'max:60'],
            'apartment_types.*.size' => ['nullable', 'string', 'max:60'],
            'hero_image_file' => ['nullable', 'image', 'max:6144'],
            'cover_image_file' => ['nullable', 'image', 'max:6144'],
            'location_image_file' => ['nullable', 'image', 'max:6144'],
            'brochure_file' => ['nullable', 'mimes:pdf', 'max:20480'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'image', 'max:6144'],
            'floor_plan_images' => ['nullable', 'array'],
            'floor_plan_images.*' => ['nullable', 'image', 'max:6144'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
        ]);
    }

    private function payload(Request $request, array $validated, ?Project $project = null): array
    {
        $slug = filled($validated['slug'] ?? null) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $apartmentTypes = collect($request->input('apartment_types', []))
            ->filter(fn ($row) => filled($row['type'] ?? null) || filled($row['size'] ?? null))
            ->map(fn ($row) => ['type' => trim((string) ($row['type'] ?? '')), 'size' => trim((string) ($row['size'] ?? ''))])
            ->values()
            ->all();

        $features = collect(preg_split('/\r\n|\r|\n/', (string) $request->input('features', '')))
            ->map(fn ($feature) => trim($feature))
            ->filter()
            ->values()
            ->all();

        return [
            'name' => $validated['name'],
            'slug' => $slug,
            'tagline' => $validated['tagline'] ?? null,
            'location' => $validated['location'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'nature' => $validated['nature'] ?? 'Residential',
            'floors' => $validated['floors'] ?? null,
            'land_area' => $validated['land_area'] ?? null,
            'facing' => $validated['facing'] ?? null,
            'total_apartments' => $validated['total_apartments'] ?? null,
            'total_lifts' => $validated['total_lifts'] ?? null,
            'ground_floor' => $validated['ground_floor'] ?? null,
            'handover_year' => $validated['handover_year'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
            'apartment_types' => $apartmentTypes,
            'features' => $features,
        ];
    }

    private function storeImages(Project $project, Request $request): void
    {
        $sort = (int) ($project->images()->max('sort_order') ?? 0);

        foreach ((array) $request->file('gallery_images', []) as $file) {
            if (! $file) {
                continue;
            }

            $path = ImageUpload::store($file, 'projects/'.$project->slug, 'gallery');
            ProjectImage::create([
                'project_id' => $project->id,
                'image' => $path,
                'type' => 'gallery',
                'sort_order' => ++$sort,
            ]);
        }

        foreach ((array) $request->file('floor_plan_images', []) as $file) {
            if (! $file) {
                continue;
            }

            $path = ImageUpload::store($file, 'projects/'.$project->slug, 'floor-plan');
            ProjectImage::create([
                'project_id' => $project->id,
                'image' => $path,
                'type' => 'floor_plan',
                'sort_order' => ++$sort,
            ]);
        }
    }
}