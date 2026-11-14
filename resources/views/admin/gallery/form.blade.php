@extends('layouts.admin')

@section('title', $image->exists ? 'Edit Gallery Image' : 'Upload Gallery Images')

@section('content')
    <div class="mb-5">
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to gallery
        </a>
    </div>

    <form method="POST" action="{{ $image->exists ? route('admin.gallery.update', $image) : route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($image->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
            <div class="admin-card">
                <h2 class="text-sm font-extrabold text-ink-900">{{ $image->exists ? 'Image Details' : 'Upload Images' }}</h2>

                <div class="mt-5 space-y-4">
                    @if ($image->exists)
                        <div>
                            <span class="admin-label">Current image</span>
                            <div class="mt-2 aspect-4/3 w-full max-w-sm overflow-hidden rounded-2xl border border-ink-900/10 bg-ink-50">
                                <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" class="h-full w-full object-cover">
                            </div>
                            <label class="admin-label mt-4" for="image_file">Replace image</label>
                            <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="image_file" name="image_file" accept="image/*">
                        </div>
                    @else
                        <div>
                            <label class="admin-label" for="images">Images *</label>
                            <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="images" name="images[]" accept="image/*" multiple required>
                            <p class="mt-1.5 text-[11px] text-ink-400">Select one or more images. Each becomes a separate gallery item.</p>
                        </div>
                    @endif

                    <div>
                        <label class="admin-label" for="caption">Caption</label>
                        <input class="admin-input" type="text" id="caption" name="caption" value="{{ old('caption', $image->caption) }}" placeholder="e.g. Rooftop garden, Shiri Serenity">
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $image->sort_order ?? 0) }}">
                        </div>
                        @if ($image->exists)
                            <label class="flex items-end gap-3 pb-1">
                                <input type="checkbox" name="is_active" value="1" class="size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $image->is_active))>
                                <span class="text-xs font-extrabold text-ink-700">Active / Visible</span>
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="admin-card self-start xl:sticky xl:top-24">
                <h2 class="text-sm font-extrabold text-ink-900">Tips</h2>
                <ul class="mt-4 space-y-2 text-xs leading-relaxed text-ink-500">
                    <li>• Landscape images (4:3) look best in the gallery grid.</li>
                    <li>• Use sort order to control the display sequence.</li>
                    <li>• Hidden images stay in the library but are not shown on the site.</li>
                </ul>

                <div class="mt-5 space-y-2">
                    <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                        <x-icon name="check" class="size-4" /> {{ $image->exists ? 'Save Image' : 'Upload Images' }}
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    @if ($image->exists)
        <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Delete this image?');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger"><x-icon name="trash" class="size-4" /> Delete Image</button>
        </form>
    @endif
@endsection
