<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Support\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::query()->orderBy('sort_order')->orderBy('id')->paginate(24);

        return view('admin.gallery.index', compact('images'));
    }

    public function create(): View
    {
        return view('admin.gallery.form', [
            'image' => new GalleryImage([
                'is_active' => true,
                'sort_order' => (GalleryImage::max('sort_order') ?? 0) + 1,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:150'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'max:6144'],
        ]);

        $sort = $validated['sort_order'] ?? ((GalleryImage::max('sort_order') ?? 0) + 1);

        foreach ($request->file('images', []) as $file) {
            GalleryImage::create([
                'caption' => $validated['caption'] ?? null,
                'image' => ImageUpload::store($file, 'gallery', 'gallery'),
                'sort_order' => $sort++,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery images uploaded successfully.');
    }

    public function edit(GalleryImage $gallery): View
    {
        return view('admin.gallery.form', ['image' => $gallery]);
    }

    public function update(Request $request, GalleryImage $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:150'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_file' => ['nullable', 'image', 'max:6144'],
        ]);

        if ($request->hasFile('image_file')) {
            ImageUpload::delete($gallery->image);
            $validated['image'] = ImageUpload::store($request->file('image_file'), 'gallery', 'gallery');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $gallery): RedirectResponse
    {
        ImageUpload::delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }
}
