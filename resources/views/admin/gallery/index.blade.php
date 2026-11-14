@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-xs text-ink-500">Images shown on the public gallery page. Upload, reorder, hide or remove them here.</p>
        <a href="{{ route('admin.gallery.create') }}" class="admin-btn admin-btn-primary">
            <x-icon name="plus" class="size-4" /> Add Images
        </a>
    </div>

    @if ($images->isEmpty())
        <div class="rounded-2xl border border-dashed border-ink-900/15 bg-white px-6 py-20 text-center">
            <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="image" class="size-5" /></span>
            <p class="mt-3 text-sm font-semibold text-ink-600">No gallery images yet</p>
            <a href="{{ route('admin.gallery.create') }}" class="admin-btn admin-btn-primary mt-4">Upload images</a>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($images as $image)
                <div class="group overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
                    <div class="relative aspect-4/3 overflow-hidden bg-ink-50">
                        <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" loading="lazy" class="h-full w-full object-cover">
                        <span class="absolute left-3 top-3 inline-flex rounded-full px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide {{ $image->is_active ? 'bg-brand-50 text-brand-700 ring-1 ring-brand-500/20' : 'bg-ink-100 text-ink-500' }}">
                            {{ $image->is_active ? 'Active' : 'Hidden' }}
                        </span>
                        <span class="absolute right-3 top-3 inline-flex rounded-full bg-ink-950/70 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-white backdrop-blur">
                            #{{ $image->sort_order }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-3 p-4">
                        <p class="truncate text-xs font-semibold text-ink-700">{{ $image->caption ?: '—' }}</p>
                        <div class="flex shrink-0 items-center gap-1.5">
                            <a href="{{ route('admin.gallery.edit', $image) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                                <x-icon name="edit" class="size-3.5" />
                            </a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="grid size-8 place-items-center rounded-lg border border-accent-500/15 text-accent-500 transition hover:bg-accent-50" title="Delete">
                                    <x-icon name="trash" class="size-3.5" />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5">{{ $images->links() }}</div>
    @endif
@endsection
