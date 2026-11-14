@extends('layouts.app')

@section('title', 'Gallery | '.setting('site_name'))
@section('meta_description', 'Explore residences, interiors and project moments from PRB Holdings developments across Uttara, Dhaka.')

@section('content')
    <x-page-hero
        :image="setting('banner_image_gallery')"
        eyebrow="Gallery"
        title="A closer look at life at PRB."
        subtitle="Architectural renders, interior inspiration and project details from our growing collection of residential addresses."
    />

    <section class="bg-cream py-16 lg:py-20">
        <div class="container-x">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-ink-500">
                    <span class="font-extrabold text-ink-900">{{ $images->count() }}</span> images
                </p>
            </div>

            @if ($images->isEmpty())
                <div class="mt-10 rounded-4xl border border-dashed border-ink-900/15 bg-white px-6 py-20 text-center">
                    <span class="mx-auto grid size-16 place-items-center rounded-full bg-cream text-brand-700">
                        <x-icon name="image" class="size-7" />
                    </span>
                    <h2 class="mt-5 font-display text-2xl text-ink-900">No images yet</h2>
                    <p class="mt-2 text-sm text-ink-500">Gallery photographs will be added here soon.</p>
                    <a href="{{ route('projects.index') }}" class="btn-primary mt-6">Explore Projects</a>
                </div>
            @else
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($images as $image)
                        <button
                            type="button"
                            data-lightbox="{{ $image->image_url }}"
                            data-lightbox-alt="{{ $image->caption }}"
                            class="group relative overflow-hidden rounded-[1.75rem] bg-ink-900 text-left {{ $loop->first ? 'sm:col-span-2' : '' }}"
                            data-reveal="zoom"
                            style="transition-delay: {{ ($loop->index % 3) * 60 }}ms"
                        >
                            <div class="{{ $loop->first ? 'aspect-4/3 sm:aspect-16/10' : 'aspect-4/3' }}">
                                <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                            </div>
                            <div class="absolute inset-0 bg-linear-to-t from-ink-950/85 via-ink-950/5 to-transparent opacity-90"></div>
                            <div class="absolute inset-x-5 bottom-5 flex items-end justify-between gap-3 text-white">
                                <div>
                                    <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-gold-300">PRB Holdings</p>
                                    <p class="mt-1 text-xs font-bold">{{ $image->caption ?: 'Project photograph' }}</p>
                                </div>
                                <span class="grid size-9 shrink-0 place-items-center rounded-full border border-white/25 bg-white/10 backdrop-blur transition duration-500 group-hover:bg-white group-hover:text-brand-800">
                                    <x-icon name="image" class="size-4" />
                                </span>
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="relative overflow-hidden bg-ink-950 py-16 text-white">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Visit in Person</p>
                <h2 class="mt-3 font-display text-3xl font-medium sm:text-4xl">A photograph can only say so much.</h2>
                <p class="mt-3 max-w-xl text-sm text-white/55">Book a site visit and experience the spaces, materials and neighbourhood for yourself.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-accent btn-shine shrink-0">Schedule a Visit <x-icon name="arrow-up-right" class="size-4" /></a>
        </div>
    </section>
@endsection
