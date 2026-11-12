@extends('layouts.app')

@section('title', 'Gallery | '.setting('site_name'))
@section('meta_description', 'Explore residences, interiors and project moments from PRB Holdings developments across Uttara, Dhaka.')

@section('content')
    <x-page-hero
        eyebrow="Gallery"
        title="A closer look at life at PRB."
        subtitle="Architectural renders, interior inspiration and project details from our growing collection of residential addresses."
    />

    <section class="bg-cream py-16 lg:py-20">
        <div class="container-x">
            <div class="-mx-1 flex gap-2 overflow-x-auto px-1 pb-2">
                <a href="{{ route('gallery') }}" class="shrink-0 rounded-full px-4 py-2.5 text-xs font-bold transition {{ ! $activeProject ? 'bg-brand-700 text-white shadow-md shadow-brand-900/20' : 'bg-white text-ink-600 hover:text-brand-800' }}">
                    All Projects
                </a>
                @foreach ($projects as $project)
                    <a href="{{ route('gallery', ['project' => $project->slug]) }}" class="shrink-0 rounded-full px-4 py-2.5 text-xs font-bold transition {{ $activeProject === $project->slug ? 'bg-brand-700 text-white shadow-md shadow-brand-900/20' : 'bg-white text-ink-600 hover:text-brand-800' }}">
                        {{ $project->name }}
                    </a>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between">
                <p class="text-xs font-semibold text-ink-500">
                    <span class="font-extrabold text-ink-900">{{ $images->count() }}</span> images
                </p>
                @if ($activeProject)
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 text-xs font-bold text-ink-500 transition hover:text-accent-600">
                        Clear filter <x-icon name="close" class="size-3.5" />
                    </a>
                @endif
            </div>

            @if ($images->isEmpty())
                <div class="mt-10 rounded-[2rem] border border-dashed border-ink-900/15 bg-white px-6 py-20 text-center">
                    <span class="mx-auto grid size-16 place-items-center rounded-full bg-cream text-brand-700">
                        <x-icon name="image" class="size-7" />
                    </span>
                    <h2 class="mt-5 font-display text-2xl text-ink-900">No images yet</h2>
                    <p class="mt-2 text-sm text-ink-500">Project photographs will be added here soon.</p>
                    <a href="{{ route('projects.index') }}" class="btn-primary mt-6">Explore Projects</a>
                </div>
            @else
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($images as $image)
                        <button
                            type="button"
                            data-lightbox="{{ $image['url'] }}"
                            data-lightbox-alt="{{ $image['caption'] }}"
                            class="group relative overflow-hidden rounded-[1.75rem] bg-ink-900 text-left {{ $loop->first ? 'sm:col-span-2' : '' }}"
                            data-reveal="zoom"
                            style="transition-delay: {{ ($loop->index % 3) * 60 }}ms"
                        >
                            <div class="{{ $loop->first ? 'aspect-[4/3] sm:aspect-[16/10]' : 'aspect-[4/3]' }}">
                                <img src="{{ $image['url'] }}" alt="{{ $image['caption'] }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                            </div>
                            <div class="absolute inset-0 bg-linear-to-t from-ink-950/85 via-ink-950/5 to-transparent opacity-90"></div>
                            <div class="absolute inset-x-5 bottom-5 flex items-end justify-between gap-3 text-white">
                                <div>
                                    <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-gold-300">{{ $image['project'] }}</p>
                                    <p class="mt-1 text-xs font-bold">{{ $image['caption'] }}</p>
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