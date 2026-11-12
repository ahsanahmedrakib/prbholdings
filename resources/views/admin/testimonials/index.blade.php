@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-xs text-ink-500">Resident stories displayed on the homepage and project pages.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="admin-btn admin-btn-primary">
            <x-icon name="plus" class="size-4" /> Add Testimonial
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($testimonials as $testimonial)
            <div class="admin-card flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        @if ($testimonial->image_url)
                            <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" class="size-11 rounded-full object-cover ring-2 ring-brand-100">
                        @else
                            <span class="grid size-11 shrink-0 place-items-center rounded-full bg-brand-700 text-xs font-extrabold text-white">{{ $testimonial->initials }}</span>
                        @endif
                        <div>
                            <p class="text-sm font-extrabold text-ink-900">{{ $testimonial->name }}</p>
                            <p class="text-[10px] text-ink-400">{{ $testimonial->designation ?: 'Resident' }}</p>
                        </div>
                    </div>
                    @if (! $testimonial->is_active)
                        <span class="rounded-full bg-ink-100 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-ink-500">Hidden</span>
                    @endif
                </div>

                <div class="mt-3 flex items-center gap-0.5 text-gold-500">
                    @for ($i = 1; $i <= 5; $i++)
                        <x-icon name="star" class="size-3.5 {{ $i <= $testimonial->rating ? 'text-gold-500' : 'text-ink-200' }}" />
                    @endfor
                </div>

                <p class="mt-3 flex-1 text-xs leading-relaxed text-ink-600 line-clamp-3">“{{ $testimonial->message }}”</p>

                <div class="mt-4 flex items-center justify-between border-t border-ink-900/5 pt-3">
                    <span class="truncate text-[10px] font-semibold text-ink-400">{{ $testimonial->project?->name ?: 'General testimonial' }}</span>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                            <x-icon name="edit" class="size-3.5" />
                        </a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete this testimonial?');">
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
                <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="quote" class="size-5" /></span>
                <p class="mt-3 text-sm font-semibold text-ink-600">No testimonials yet</p>
                <a href="{{ route('admin.testimonials.create') }}" class="admin-btn admin-btn-primary mt-4">Add a testimonial</a>
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $testimonials->links() }}</div>
@endsection