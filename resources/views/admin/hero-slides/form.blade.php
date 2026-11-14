@extends('layouts.admin')

@section('title', $slide->exists ? 'Edit Hero Slide' : 'New Hero Slide')

@section('content')
    <div class="mb-5">
        <a href="{{ route('admin.hero-slides.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to slides
        </a>
    </div>

    <form method="POST" action="{{ $slide->exists ? route('admin.hero-slides.update', $slide) : route('admin.hero-slides.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($slide->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_22rem]">
            <div class="admin-card">
                <h2 class="text-sm font-extrabold text-ink-900">Slide Content</h2>
                <p class="mt-1 text-[11px] text-ink-400">Keep titles short — the final word is elegantly italicised.</p>

                <div class="mt-5 space-y-4">
                    <div>
                        <label class="admin-label" for="eyebrow">Eyebrow / label</label>
                        <input class="admin-input" type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $slide->eyebrow) }}" placeholder="Now Open · PRB Shirin Garden">
                    </div>
                    <div>
                        <label class="admin-label" for="title">Title *</label>
                        <input class="admin-input" type="text" id="title" name="title" value="{{ old('title', $slide->title) }}" placeholder="Your satisfaction is our dream." required>
                    </div>
                    <div>
                        <label class="admin-label" for="subtitle">Subtitle</label>
                        <textarea class="admin-input min-h-24 resize-y" id="subtitle" name="subtitle" placeholder="A sentence about the project...">{{ old('subtitle', $slide->subtitle) }}</textarea>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="cta_label">CTA label</label>
                            <input class="admin-input" type="text" id="cta_label" name="cta_label" value="{{ old('cta_label', $slide->cta_label) }}" placeholder="Explore Shirin Garden">
                        </div>
                        <div>
                            <label class="admin-label" for="cta_url">CTA URL</label>
                            <input class="admin-input" type="text" id="cta_url" name="cta_url" value="{{ old('cta_url', $slide->cta_url) }}" placeholder="/projects/shirin-garden">
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}">
                        </div>
                        <label class="flex items-end gap-3 pb-1">
                            <input type="checkbox" name="is_active" value="1" class="size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $slide->exists ? $slide->is_active : true))>
                            <span class="text-xs font-extrabold text-ink-700">Active / Visible</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Slide Image</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Portrait orientation works best (e.g. 1000×1250px).</p>

                    @if ($slide->image)
                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="mt-4 aspect-4/5 w-full rounded-xl object-cover">
                    @endif

                    <input class="admin-input mt-4 py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" name="image_file" accept="image/*" @if (! $slide->exists) required @endif>

                    <div class="mt-5 space-y-2">
                        <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                            <x-icon name="check" class="size-4" /> {{ $slide->exists ? 'Save Slide' : 'Create Slide' }}
                        </button>
                        <a href="{{ route('admin.hero-slides.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($slide->exists)
        <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" onsubmit="return confirm('Delete this slide?');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger"><x-icon name="trash" class="size-4" /> Delete Slide</button>
        </form>
    @endif
@endsection