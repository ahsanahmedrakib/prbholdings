<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmenityController extends Controller
{
    public const ICONS = ['shield', 'car', 'bolt', 'users', 'leaf', 'map', 'tools', 'sun', 'sparkles', 'building'];

    public function index(): View
    {
        $amenities = Amenity::query()->orderBy('sort_order')->paginate(20);

        return view('admin.amenities.index', compact('amenities'));
    }

    public function create(): View
    {
        return view('admin.amenities.form', [
            'amenity' => new Amenity([
                'icon' => 'sparkles',
                'is_active' => true,
                'sort_order' => (Amenity::max('sort_order') ?? 0) + 1,
            ]),
            'icons' => self::ICONS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAmenity($request);
        $validated['is_active'] = $request->boolean('is_active');

        Amenity::create($validated);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity created successfully.');
    }

    public function edit(Amenity $amenity): View
    {
        return view('admin.amenities.form', [
            'amenity' => $amenity,
            'icons' => self::ICONS,
        ]);
    }

    public function update(Request $request, Amenity $amenity): RedirectResponse
    {
        $validated = $this->validateAmenity($request);
        $validated['is_active'] = $request->boolean('is_active');

        $amenity->update($validated);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity updated successfully.');
    }

    public function destroy(Amenity $amenity): RedirectResponse
    {
        $amenity->delete();

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity deleted successfully.');
    }

    private function validateAmenity(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'icon' => ['required', 'in:'.implode(',', self::ICONS)],
            'description' => ['nullable', 'string', 'max:300'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}