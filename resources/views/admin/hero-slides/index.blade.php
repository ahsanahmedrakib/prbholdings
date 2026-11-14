@extends('layouts.admin')

@section('title', 'Hero Slides')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-xs text-ink-500">Slides shown in the homepage hero. Drag-free ordering via the sort value.</p>
        <a href="{{ route('admin.hero-slides.create') }}" class="admin-btn admin-btn-primary">
            <x-icon name="plus" class="size-4" /> Add Slide
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($slides as $slide)
            <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
                <div class="relative aspect-16/10 overflow-hidden bg-ink-900">
                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-linear-to-t from-ink-950/80 to-transparent"></div>
                    <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-ink-700">Order {{ $slide->sort_order }}</span>
                    @if (! $slide->is_active)
                        <span class="absolute right-3 top-3 rounded-full bg-accent-600 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-white">Hidden</span>
                    @endif
                    <div class="absolute inset-x-4 bottom-3">
                        <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-gold-300">{{ $slide->eyebrow }}</p>
                        <p class="mt-1 font-display text-lg text-white">{{ $slide->title }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between gap-2 p-4">
                    <div class="min-w-0">
                        <p class="truncate text-[11px] text-ink-500">{{ $slide->cta_label ?: 'No CTA' }}</p>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                            <x-icon name="edit" class="size-3.5" />
                        </a>
                        <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" onsubmit="return confirm('Delete this slide?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="grid size-8 place-items-center rounded-lg border border-accent-500/15 text-accent-500 transition hover:bg-accent-50" title="Delete">
                                <x-icon name="trash" class="size-3.5" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-ink-900/15 bg-white px-6 py-16 text-center">
                <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="image" class="size-5" /></span>
                <p class="mt-3 text-sm font-semibold text-ink-600">No hero slides yet</p>
                <a href="{{ route('admin.hero-slides.create') }}" class="admin-btn admin-btn-primary mt-4">Create a slide</a>
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $slides->links() }}</div>
@endsection