<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Support\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        $slides = HeroSlide::query()->orderBy('sort_order')->paginate(12);

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create(): View
    {
        $slide = new HeroSlide([
            'is_active' => true,
            'sort_order' => (HeroSlide::max('sort_order') ?? 0) + 1,
        ]);

        return view('admin.hero-slides.form', compact('slide'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSlide($request, true);
        $validated['image'] = ImageUpload::store($request->file('image_file'), 'hero-slides', 'slide');
        $validated['is_active'] = $request->boolean('is_active');

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        return view('admin.hero-slides.form', ['slide' => $heroSlide]);
    }

    public function update(Request $request, HeroSlide $heroSlide): RedirectResponse
    {
        $validated = $this->validateSlide($request, false);

        if ($request->hasFile('image_file')) {
            ImageUpload::delete($heroSlide->image);
            $validated['image'] = ImageUpload::store($request->file('image_file'), 'hero-slides', 'slide');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        ImageUpload::delete($heroSlide->image);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted successfully.');
    }

    private function validateSlide(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:150'],
            'title' => ['required', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:300'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url' => ['nullable', 'string', 'max:200'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_file' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:6144'],
        ]);
    }
}