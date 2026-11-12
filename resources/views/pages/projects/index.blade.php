@extends('layouts.app')

@section('title', 'Our Projects | '.setting('site_name'))
@section('meta_description', 'Explore ongoing, upcoming and handed-over residential projects by PRB Holdings in Uttara, Dhaka.')

@section('content')
    <x-page-hero
        eyebrow="Our Projects"
        title="Addresses designed around the way you live."
        subtitle="Browse our portfolio of residential apartments across Uttara, Dakshinkhan, Kawlar and beyond — each planned with care, built with precision."
    />

    <section class="bg-cream py-16 lg:py-20">
        <div class="container-x">
            <div class="flex flex-col gap-6 rounded-[2rem] border border-ink-900/5 bg-white p-5 shadow-sm sm:p-6 lg:flex-row lg:items-center lg:justify-between" data-reveal>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('projects.index', array_filter(['q' => $search ?: null])) }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-xs font-bold transition {{ ! $status ? 'bg-brand-700 text-white shadow-md shadow-brand-900/20' : 'bg-cream text-ink-600 hover:text-brand-800' }}">
                        All <span class="text-[10px] opacity-60">{{ $statusCounts['all'] }}</span>
                    </a>
                    @foreach (['ongoing' => 'Ongoing', 'upcoming' => 'Upcoming', 'completed' => 'Handed Over'] as $value => $label)
                        <a href="{{ route('projects.index', array_filter(['status' => $value, 'q' => $search ?: null])) }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-xs font-bold transition {{ $status === $value ? 'bg-brand-700 text-white shadow-md shadow-brand-900/20' : 'bg-cream text-ink-600 hover:text-brand-800' }}">
                            {{ $label }} <span class="text-[10px] opacity-60">{{ $statusCounts[$value] }}</span>
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('projects.index') }}" method="GET" class="flex w-full items-center gap-2 lg:w-auto">
                    @if ($status)
                        <input type="hidden" name="status" value="{{ $status }}">
                    @endif
                    <div class="relative flex-1 lg:w-72">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-ink-400">
                            <x-icon name="search" class="size-4" />
                        </span>
                        <input type="search" name="q" value="{{ $search }}" placeholder="Search project or location" class="field pl-11">
                    </div>
                    <button type="submit" class="btn-primary shrink-0 px-5 py-3 text-xs">Search</button>
                    @if ($search)
                        <a href="{{ route('projects.index', array_filter(['status' => $status])) }}" class="grid size-11 shrink-0 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-500 transition hover:text-accent-600" aria-label="Clear search">
                            <x-icon name="close" class="size-4" />
                        </a>
                    @endif
                </form>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <p class="text-xs font-semibold text-ink-500">
                    Showing <span class="font-extrabold text-ink-900">{{ $projects->firstItem() ?? 0 }}–{{ $projects->lastItem() ?? 0 }}</span> of <span class="font-extrabold text-ink-900">{{ $projects->total() }}</span> projects
                </p>
                @if ($search)
                    <p class="text-xs text-ink-400">Results for “{{ $search }}”</p>
                @endif
            </div>

            @if ($projects->isEmpty())
                <div class="mt-10 rounded-[2rem] border border-dashed border-ink-900/15 bg-white px-6 py-20 text-center">
                    <span class="mx-auto grid size-16 place-items-center rounded-full bg-cream text-brand-700">
                        <x-icon name="search" class="size-7" />
                    </span>
                    <h2 class="mt-5 font-display text-2xl text-ink-900">No projects found</h2>
                    <p class="mt-2 text-sm text-ink-500">Try a different search term or browse all our addresses.</p>
                    <a href="{{ route('projects.index') }}" class="btn-primary mt-6">View all projects</a>
                </div>
            @else
                <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <div data-reveal style="transition-delay: {{ ($loop->index % 3) * 70 }}ms">
                            <x-project-card :project="$project" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>

    <section class="relative overflow-hidden bg-ink-950 py-16 text-white">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Can't decide?</p>
                <h2 class="mt-3 font-display text-3xl font-medium sm:text-4xl">Let us help you find the right home.</h2>
                <p class="mt-3 max-w-xl text-sm text-white/55">Tell us your budget, preferred area and family needs — we will shortlist the best options for you.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-accent btn-shine shrink-0">Talk to Our Team <x-icon name="arrow-up-right" class="size-4" /></a>
        </div>
    </section>
@endsection