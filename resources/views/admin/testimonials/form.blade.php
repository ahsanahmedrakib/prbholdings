@extends('layouts.admin')

@section('title', $testimonial->exists ? 'Edit Testimonial' : 'New Testimonial')

@section('content')
    <div class="mb-5">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to testimonials
        </a>
    </div>

    <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($testimonial->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
            <div class="admin-card">
                <h2 class="text-sm font-extrabold text-ink-900">Resident Details</h2>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="admin-label" for="name">Name *</label>
                        <input class="admin-input" type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" placeholder="e.g. Tanvir Ahmed" required>
                    </div>
                    <div>
                        <label class="admin-label" for="designation">Designation / relation</label>
                        <input class="admin-input" type="text" id="designation" name="designation" value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g. Resident, Shirin Garden">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="admin-label" for="message">Testimonial *</label>
                        <textarea class="admin-input min-h-36 resize-y" id="message" name="message" placeholder="What did they say about the experience?" required>{{ old('message', $testimonial->message) }}</textarea>
                    </div>
                    <div>
                        <label class="admin-label" for="rating">Rating *</label>
                        <select class="admin-input" id="rating" name="rating" required>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="admin-label" for="project_id">Related project</label>
                        <select class="admin-input" id="project_id" name="project_id">
                            <option value="">General testimonial</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected((int) old('project_id', $testimonial->project_id) === $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Photo & Publishing</h2>

                    @if ($testimonial->image)
                        <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" class="mt-4 size-20 rounded-full object-cover ring-4 ring-brand-50">
                    @endif

                    <div class="mt-4">
                        <label class="admin-label" for="image_file">Client photo</label>
                        <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="image_file" name="image_file" accept="image/*">
                    </div>

                    <div class="mt-4 space-y-3">
                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
                        </div>
                        <label class="flex items-center gap-3 rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                            <input type="checkbox" name="is_active" value="1" class="size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $testimonial->exists ? $testimonial->is_active : true))>
                            <span class="text-xs font-extrabold text-ink-700">Active / Visible</span>
                        </label>
                    </div>

                    <div class="mt-5 space-y-2">
                        <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                            <x-icon name="check" class="size-4" /> {{ $testimonial->exists ? 'Save Testimonial' : 'Create Testimonial' }}
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($testimonial->exists)
        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete this testimonial?');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger"><x-icon name="trash" class="size-4" /> Delete Testimonial</button>
        </form>
    @endif
@endsection