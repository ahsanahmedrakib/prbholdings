@extends('layouts.admin')

@section('title', $amenity->exists ? 'Edit Amenity' : 'New Amenity')

@section('content')
    <div class="mb-5">
        <a href="{{ route('admin.amenities.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to amenities
        </a>
    </div>

    <form method="POST" action="{{ $amenity->exists ? route('admin.amenities.update', $amenity) : route('admin.amenities.store') }}" x-data="{ icon: @js(old('icon', $amenity->icon ?: 'sparkles')) }">
        @csrf
        @if ($amenity->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
            <div class="admin-card">
                <h2 class="text-sm font-extrabold text-ink-900">Amenity Details</h2>

                <div class="mt-5 space-y-4">
                    <div>
                        <label class="admin-label" for="title">Title *</label>
                        <input class="admin-input" type="text" id="title" name="title" value="{{ old('title', $amenity->title) }}" placeholder="e.g. 24/7 CCTV Security" required>
                    </div>

                    <div>
                        <label class="admin-label" for="description">Description</label>
                        <textarea class="admin-input min-h-24 resize-y" id="description" name="description" placeholder="A short line about this amenity...">{{ old('description', $amenity->description) }}</textarea>
                    </div>

                    <div>
                        <span class="admin-label">Icon *</span>
                        <div class="grid grid-cols-5 gap-2 sm:grid-cols-10">
                            @foreach ($icons as $icon)
                                <label class="cursor-pointer">
                                    <input type="radio" name="icon" value="{{ $icon }}" class="peer sr-only" @change="icon = $event.target.value" @checked(old('icon', $amenity->icon) === $icon)>
                                    <span class="grid aspect-square place-items-center rounded-xl border border-ink-900/10 bg-white text-ink-500 transition hover:border-brand-500/40 hover:text-brand-700 peer-checked:border-brand-700 peer-checked:bg-brand-700 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-brand-500/20">
                                        <x-icon :name="$icon" class="size-4" />
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $amenity->sort_order ?? 0) }}">
                        </div>
                        <label class="flex items-end gap-3 pb-1">
                            <input type="checkbox" name="is_active" value="1" class="size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $amenity->exists ? $amenity->is_active : true))>
                            <span class="text-xs font-extrabold text-ink-700">Active / Visible</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card self-start xl:sticky xl:top-24">
                <h2 class="text-sm font-extrabold text-ink-900">Live Preview</h2>
                <div class="mt-4 rounded-2xl border border-brand-700/10 bg-brand-50 p-5">
                    <span class="grid size-12 place-items-center rounded-2xl bg-brand-700 text-white shadow-lg shadow-brand-900/20" x-html="iconMarkup(icon)"></span>
                    <p class="mt-4 font-display text-xl text-ink-900">{{ old('title', $amenity->title) ?: 'Amenity title' }}</p>
                    <p class="mt-1.5 text-xs leading-relaxed text-ink-500">{{ old('description', $amenity->description) ?: 'Amenity description appears here.' }}</p>
                </div>

                <div class="mt-5 space-y-2">
                    <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                        <x-icon name="check" class="size-4" /> {{ $amenity->exists ? 'Save Amenity' : 'Create Amenity' }}
                    </button>
                    <a href="{{ route('admin.amenities.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    @if ($amenity->exists)
        <form method="POST" action="{{ route('admin.amenities.destroy', $amenity) }}" onsubmit="return confirm('Delete this amenity?');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger"><x-icon name="trash" class="size-4" /> Delete Amenity</button>
        </form>
    @endif

    @push('scripts')
        <script>
            function iconMarkup(name) {
                const icons = {
                    @foreach ($icons as $icon)
                        @php $svg = (new \App\View\Components\Icon($icon, 'size-6'))->paths(); @endphp
                        "{{ $icon }}": @json($svg),
                    @endforeach
                };
                return icons[name] || icons.sparkles || '';
            }
        </script>
    @endpush
@endsection