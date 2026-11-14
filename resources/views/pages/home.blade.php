@extends('layouts.app')

@section('title', setting('meta_title'))
@section('meta_description', setting('meta_description'))

@section('content')
    {{-- Hero --}}
    <section class="relative isolate overflow-hidden bg-ink-950 text-white">
        <div data-hero class="relative">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    @foreach ($slides as $slide)
                        @php
                            $titleWords = explode(' ', $slide->title);
                            $lastWord = array_pop($titleWords);
                        @endphp
                        <div class="swiper-slide">
                            <div
                                class="relative flex min-h-[calc(100svh-7rem)] flex-col justify-end overflow-hidden pb-40 pt-24 lg:pb-32 lg:pt-28">
                                <div class="hero-visual absolute inset-0">
                                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                                        class="h-full w-full object-cover object-center"
                                        @if ($loop->first) fetchpriority="high" @endif
                                        loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                    <div class="absolute inset-0 bg-linear-to-r from-ink-950 via-ink-950/70 to-ink-950/5">
                                    </div>
                                    <div class="absolute inset-0 bg-linear-to-t from-ink-950 via-ink-950/20 to-ink-950/35">
                                    </div>
                                    <div class="pattern-grid absolute inset-0 opacity-20"></div>
                                </div>

                                <div class="container-x relative">
                                    <div class="flex items-end justify-between gap-10">
                                        <div class="hero-copy min-w-0 w-full max-w-4xl">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <span class="glass-chip">
                                                    <span class="size-1.5 rounded-full bg-brand-300"></span>
                                                    {{ $slide->eyebrow }}
                                                </span>
                                                <span class="hidden h-px w-12 bg-white/25 sm:block"></span>
                                                <span
                                                    class="hidden text-[10px] font-bold uppercase tracking-[0.3em] text-white/45 sm:block">Dhaka
                                                    · Bangladesh</span>
                                            </div>

                                            <h1
                                                class="mt-6 font-display text-[2.65rem] font-medium leading-[0.95] tracking-tight text-white text-balance sm:text-6xl lg:text-[5.2rem] xl:text-[5.8rem]">
                                                {{ implode(' ', $titleWords) }}
                                                <span class="relative whitespace-nowrap italic text-accent-300">
                                                    {{ $lastWord }}
                                                    <span
                                                        class="absolute -bottom-2 left-0 h-px w-full bg-linear-to-r from-accent-400/80 to-transparent"></span>
                                                </span>
                                            </h1>

                                            <p class="mt-7 max-w-xl text-sm leading-relaxed text-white/65 sm:text-base">
                                                {{ $slide->subtitle }}
                                            </p>

                                            <div class="mt-8 flex flex-wrap items-center gap-3">
                                                <a href="{{ $slide->cta_url ? url($slide->cta_url) : route('projects.index') }}"
                                                    class="btn-accent btn-shine">
                                                    {{ $slide->cta_label ?: 'Explore Project' }}
                                                    <x-icon name="arrow-up-right" class="size-4" />
                                                </a>
                                                <a href="{{ route('projects.index') }}" class="btn-ghost-light">
                                                    View Portfolio
                                                    <x-icon name="arrow-right" class="size-4" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="hero-copy hidden shrink-0 text-right lg:block">
                                            <p class="font-display text-[9rem] leading-none text-white/6">
                                                {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                                            <div class="-mt-7 flex flex-col items-end gap-4">
                                                <span class="h-16 w-px bg-linear-to-b from-white/40 to-transparent"></span>
                                                <span
                                                    class="text-[9px] font-extrabold uppercase tracking-[0.35em] text-white/40 [writing-mode:vertical-rl]">Scroll
                                                    to explore</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="absolute inset-x-0 bottom-0 z-20">
                <div class="container-x pb-4 sm:pb-6">
                    <div
                        class="hero-menu flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-white/15 bg-ink-950/55 p-2.5 shadow-2xl shadow-ink-950/40 backdrop-blur-xl sm:p-3">
                        <a href="{{ route('projects.index') }}"
                            class="group flex shrink-0 items-center gap-3 rounded-xl bg-white px-3.5 py-2.5 text-ink-950 transition hover:bg-cream sm:px-4">
                            <span class="grid size-8 place-items-center rounded-lg bg-brand-700 text-white">
                                <x-icon name="building" class="size-4" />
                            </span>
                            <span class="leading-tight">
                                <span
                                    class="block text-[8px] font-extrabold uppercase tracking-[0.24em] text-ink-400">Discover</span>
                                <span class="block text-xs font-extrabold">Explore Projects</span>
                            </span>
                            <x-icon name="arrow-up-right"
                                class="ml-1 size-4 text-brand-700 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                        </a>

                        <div class="hidden items-center gap-1 md:flex">
                            <a href="{{ route('projects.index', ['status' => 'ongoing']) }}"
                                class="rounded-full px-3.5 py-2 text-[11px] font-bold text-white/60 transition hover:bg-white/10 hover:text-white">Ongoing</a>
                            <a href="{{ route('projects.index', ['status' => 'upcoming']) }}"
                                class="rounded-full px-3.5 py-2 text-[11px] font-bold text-white/60 transition hover:bg-white/10 hover:text-white">Upcoming</a>
                            <a href="{{ route('projects.index', ['status' => 'completed']) }}"
                                class="rounded-full px-3.5 py-2 text-[11px] font-bold text-white/60 transition hover:bg-white/10 hover:text-white">Handed
                                Over</a>
                            <a href="{{ route('projects.index', ['status' => 'ready']) }}"
                                class="rounded-full px-3.5 py-2 text-[11px] font-bold text-white/60 transition hover:bg-white/10 hover:text-white">Ready</a>
                        </div>

                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="hidden items-center gap-2.5 sm:flex">
                                <span data-hero-current class="font-display text-lg text-white">01</span>
                                <div class="relative h-px w-10 overflow-hidden bg-white/20">
                                    <span data-hero-progress
                                        class="hero-progress-bar absolute inset-0 bg-accent-400"></span>
                                </div>
                                <span data-hero-total
                                    class="text-[10px] font-bold tracking-[0.18em] text-white/40">04</span>
                            </div>

                            <div class="flex items-center gap-1.5">
                                <button type="button" data-hero-prev
                                    class="grid size-10 place-items-center rounded-full border border-white/20 bg-white/5 text-white transition hover:border-accent-300/60 hover:bg-white/10 hover:text-accent-300"
                                    aria-label="Previous slide">
                                    <x-icon name="arrow-left" class="size-4" />
                                </button>
                                <button type="button" data-hero-next
                                    class="grid size-10 place-items-center rounded-full border border-white/20 bg-white/5 text-white transition hover:border-accent-300/60 hover:bg-white/10 hover:text-accent-300"
                                    aria-label="Next slide">
                                    <x-icon name="arrow-right" class="size-4" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee --}}
    <div class="marquee-pause overflow-hidden border-y border-brand-950/20 bg-brand-700 py-4 text-cream">
        <div
            class="marquee-track items-center gap-8 whitespace-nowrap text-[11px] font-extrabold uppercase tracking-[0.28em]">
            @for ($i = 0; $i < 2; $i++)
                @foreach (['Your Satisfaction Is Our Dream', 'Thoughtfully Planned Residences', 'Building Trust Since Day One', 'Sustainable Housing For Tomorrow', 'Uttara · Dhaka · Bangladesh'] as $marqueeItem)
                    <span class="flex items-center gap-8">
                        <span>{{ $marqueeItem }}</span>
                        <span class="text-gold-300">✦</span>
                    </span>
                @endforeach
            @endfor
        </div>
    </div>

    {{-- About --}}
    <section id="about" class="relative overflow-hidden bg-cream py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -right-10 top-16 size-72 opacity-60"></div>
        <div class="section-blob -left-20 bottom-0 size-72 bg-brand-200/40"></div>

        <div class="container-x relative grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" data-reveal="left">
                <div class="absolute -left-5 -top-5 size-28 rounded-4xl border border-brand-700/20"></div>
                <div class="absolute -bottom-8 -right-8 size-40 rounded-full border border-gold-500/30"></div>

                <div class="relative aspect-4/5 overflow-hidden rounded-[2.5rem] shadow-2xl shadow-ink-950/20">
                    <img src="{{ media_url(setting('about_image_main'), 'uploads/projects/shirin-garden/living.jpg') }}"
                        alt="PRB Holdings interior" loading="lazy" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-linear-to-t from-ink-950/35 via-transparent to-transparent"></div>
                </div>

                <div
                    class="absolute -bottom-10 -right-3 w-40 overflow-hidden rounded-3xl border-8 border-cream shadow-xl sm:w-48">
                    <div class="aspect-3/4">
                        <img src="{{ media_url(setting('about_image_secondary'), 'uploads/projects/shirin-garden/bedroom.jpg') }}"
                            alt="PRB Holdings bedroom" loading="lazy" class="h-full w-full object-cover">
                    </div>
                </div>

                <div
                    class="absolute -left-4 bottom-10 max-w-44 rounded-2xl bg-brand-800 p-4 text-white shadow-xl lg:-left-8">
                    <p class="font-display text-3xl leading-none text-gold-300">
                        {{ str_pad((string) $projects->count(), 2, '0', STR_PAD_LEFT) }}+</p>
                    <p class="mt-2 text-[10px] font-bold uppercase leading-relaxed tracking-[0.15em] text-white/70">
                        Residential addresses across Dhaka</p>
                </div>
            </div>

            <div data-reveal="right">
                <span class="eyebrow">{{ setting('about_eyebrow') }}</span>
                <h2 class="display-title mt-4 text-balance">{{ setting('about_heading') }}</h2>

                <p class="mt-6 text-sm leading-relaxed text-ink-500 sm:text-base">
                    {{ setting('about_short') }}
                </p>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-brand-900/10 bg-white p-6 shadow-sm">
                        <span class="grid size-11 place-items-center rounded-2xl bg-brand-700 text-white">
                            <x-icon name="compass" class="size-5" />
                        </span>
                        <h3 class="mt-4 text-[11px] font-extrabold uppercase tracking-[0.2em] text-ink-500">Our Vision</h3>
                        <p class="mt-2 font-display text-lg leading-snug text-ink-900">{{ setting('vision') }}</p>
                    </div>
                    <div class="rounded-3xl border border-accent-900/10 bg-white p-6 shadow-sm">
                        <span class="grid size-11 place-items-center rounded-2xl bg-accent-600 text-white">
                            <x-icon name="sparkles" class="size-5" />
                        </span>
                        <h3 class="mt-4 text-[11px] font-extrabold uppercase tracking-[0.2em] text-ink-500">Our Mission
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-600">{{ setting('mission') }}</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('about') }}" class="btn-primary btn-shine">
                        Our Story
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                    <a href="tel:{{ setting('phone_link') }}"
                        class="group flex items-center gap-3 text-sm font-bold text-ink-800">
                        <span
                            class="grid size-11 place-items-center rounded-full border border-brand-700/20 bg-white text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                            <x-icon name="phone" class="size-4" />
                        </span>
                        {{ setting('phone') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <div class="relative z-10 bg-cream pb-4">
        <div class="container-x">
            <div class="grid gap-px overflow-hidden rounded-4xl bg-white/10 shadow-2xl shadow-ink-950/25 sm:grid-cols-2 lg:grid-cols-4"
                data-reveal="zoom">
                @foreach ($stats as $stat)
                    <div class="group relative overflow-hidden bg-ink-950 px-7 py-8 text-white">
                        <div
                            class="absolute -right-8 -top-8 size-24 rounded-full bg-brand-600/20 transition duration-500 group-hover:scale-150">
                        </div>
                        <p class="relative font-display text-4xl font-medium text-gold-300">
                            <span data-counter="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>
                        </p>
                        <p class="relative mt-2 text-[10px] font-extrabold uppercase tracking-[0.24em] text-white/50">
                            {{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Featured projects --}}
    <section id="projects" class="bg-white py-20 lg:py-28">
        <div class="container-x">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <span class="eyebrow">{{ setting('projects_eyebrow') }}</span>
                    <h2 class="display-title mt-4 text-balance">{{ setting('projects_heading') }}</h2>
                    <p class="mt-4 max-w-xl text-sm leading-relaxed text-ink-500">{{ setting('projects_text') }}</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('projects.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-ink-900/10 bg-cream px-4 py-2 text-xs font-bold text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800">All
                        <span class="text-ink-400">{{ $projects->count() }}</span></a>
                    <a href="{{ route('projects.index', ['status' => 'ongoing']) }}"
                        class="inline-flex items-center gap-2 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-xs font-bold text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800">Ongoing</a>
                    <a href="{{ route('projects.index', ['status' => 'upcoming']) }}"
                        class="inline-flex items-center gap-2 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-xs font-bold text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800">Upcoming</a>
                    <a href="{{ route('projects.index', ['status' => 'completed']) }}"
                        class="inline-flex items-center gap-2 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-xs font-bold text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800">Handed
                        Over</a>
                    <a href="{{ route('projects.index', ['status' => 'ready']) }}"
                        class="inline-flex items-center gap-2 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-xs font-bold text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800">Ready</a>
                </div>
            </div>

            <div class="mt-12" data-projects-swiper data-reveal>
                <div class="swiper">
                    <div class="swiper-wrapper pb-2">
                        @foreach ($featuredProjects as $project)
                            <div class="swiper-slide h-auto! flex">
                                <div class="w-full h-full">
                                    <x-project-card :project="$project" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <div data-projects-dots class="flex items-center gap-2"></div>
                    <div class="flex items-center gap-2">
                        <button type="button" data-projects-prev
                            class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:bg-brand-700 hover:text-white"
                            aria-label="Previous projects">
                            <x-icon name="arrow-left" class="size-4" />
                        </button>
                        <button type="button" data-projects-next
                            class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:bg-brand-700 hover:text-white"
                            aria-label="Next projects">
                            <x-icon name="arrow-right" class="size-4" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Amenities --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-white lg:py-28">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-40"></div>
        <div class="section-blob -left-24 top-20 size-80 bg-brand-600/25"></div>
        <div class="section-blob -right-20 bottom-10 size-72 bg-accent-600/15"></div>

        <div class="container-x relative">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="eyebrow eyebrow-light">{{ setting('amenities_eyebrow') }}</span>
                <h2 class="mt-4 font-display text-4xl font-medium leading-tight tracking-tight text-white sm:text-5xl">
                    {{ setting('amenities_heading') }}</h2>
                <p class="mt-4 text-sm leading-relaxed text-white/55">{{ setting('amenities_text') }}</p>
            </div>

            <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($amenities as $amenity)
                    <div class="amenity-card group relative overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/5 p-6 transition duration-500 hover:-translate-y-1.5 hover:border-gold-300/25 hover:bg-white/10"
                        data-reveal style="transition-delay: {{ ($loop->index % 4) * 80 }}ms">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between">
                                <span
                                    class="grid size-12 place-items-center rounded-2xl bg-brand-600/20 text-gold-300 transition duration-500 group-hover:bg-gold-400 group-hover:text-ink-950">
                                    <x-icon :name="$amenity->icon" class="size-6" />
                                </span>
                                <span
                                    class="font-display text-sm text-white/25">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h3 class="mt-6 text-base font-extrabold text-white">{{ $amenity->title }}</h3>
                            <p class="mt-2 text-xs leading-relaxed text-white/45">{{ $amenity->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Landowner / Buyer --}}
    <section class="bg-cream py-20 lg:py-28">
        <div class="container-x">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <span class="eyebrow">{{ setting('cta_eyebrow') }}</span>
                    <h2 class="display-title mt-4 text-balance">{{ setting('cta_heading') }}</h2>
                    <p class="mt-4 max-w-xl text-sm leading-relaxed text-ink-500">{{ setting('cta_text') }}</p>
                </div>
                <a href="{{ route('contact') }}" class="btn-outline shrink-0">
                    Start a Conversation
                    <x-icon name="arrow-up-right" class="size-4" />
                </a>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-2">
                <a href="{{ route('contact') }}"
                    class="group relative overflow-hidden rounded-4xl bg-brand-900 p-8 text-white sm:p-10"
                    data-reveal="left">
                    <img src="{{ media_url(setting('about_image_main'), 'uploads/projects/shirin-garden/living.jpg') }}"
                        alt="Landowner partnership" loading="lazy"
                        class="absolute inset-0 h-full w-full object-cover opacity-25 transition duration-700 group-hover:scale-105 group-hover:opacity-30">
                    <div class="absolute inset-0 bg-linear-to-r from-brand-950/95 via-brand-900/80 to-brand-900/20"></div>
                    <div class="pattern-grid absolute inset-0 opacity-30"></div>

                    <div class="relative flex h-full min-h-64 flex-col justify-between">
                        <span class="glass-chip w-fit">{{ setting('landowner_title') }}</span>
                        <div class="mt-16 max-w-sm">
                            <h3 class="font-display text-3xl font-medium leading-tight">Build your sanctuary with
                                credibility.</h3>
                            <p class="mt-3 text-sm leading-relaxed text-white/60">{{ setting('landowner_text') }}</p>
                            <span
                                class="mt-6 inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-gold-300">
                                Partner with us
                                <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('projects.index') }}"
                    class="group relative overflow-hidden rounded-4xl bg-accent-800 p-8 text-white sm:p-10"
                    data-reveal="right">
                    <img src="{{ media_url(setting('about_image_secondary'), 'uploads/projects/shirin-garden/bedroom.jpg') }}"
                        alt="Buyer investment" loading="lazy"
                        class="absolute inset-0 h-full w-full object-cover opacity-25 transition duration-700 group-hover:scale-105 group-hover:opacity-30">
                    <div class="absolute inset-0 bg-linear-to-r from-accent-950/95 via-accent-900/80 to-accent-900/20">
                    </div>
                    <div class="pattern-grid absolute inset-0 opacity-30"></div>

                    <div class="relative flex h-full min-h-64 flex-col justify-between">
                        <span class="glass-chip w-fit">{{ setting('buyer_title') }}</span>
                        <div class="mt-16 max-w-sm">
                            <h3 class="font-display text-3xl font-medium leading-tight">Invest for a better tomorrow.</h3>
                            <p class="mt-3 text-sm leading-relaxed text-white/60">{{ setting('buyer_text') }}</p>
                            <span
                                class="mt-6 inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-gold-200">
                                Find your home
                                <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Completed portfolio --}}
    @if ($completedProjects->isNotEmpty())
        <section class="bg-white py-20 lg:py-28">
            <div class="container-x">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <span class="eyebrow">Handed Over</span>
                        <h2 class="display-title mt-4">A legacy of addresses<br class="hidden sm:block"> already lived in.
                        </h2>
                    </div>
                    <a href="{{ route('projects.index', ['status' => 'completed']) }}"
                        class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800 transition hover:text-accent-600">
                        View all completed
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($completedProjects->take(8) as $project)
                        <a href="{{ route('projects.show', $project) }}"
                            class="group relative overflow-hidden rounded-[1.75rem] bg-ink-900" data-reveal="zoom">
                            <div class="aspect-4/5 overflow-hidden">
                                <img src="{{ $project->cover_image_url }}" alt="{{ $project->name }}" loading="lazy"
                                    class="h-full w-full object-cover transition duration-900 group-hover:scale-110">
                            </div>
                            <div class="absolute inset-0 bg-linear-to-t from-ink-950/90 via-ink-950/10 to-transparent">
                            </div>
                            <div class="absolute inset-x-5 bottom-5 text-white">
                                <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-gold-300">
                                    {{ $project->location }}</p>
                                <h3 class="mt-1.5 font-display text-xl">{{ $project->name }}</h3>
                            </div>
                            <span
                                class="absolute right-4 top-4 grid size-9 place-items-center rounded-full border border-white/25 bg-white/10 text-white backdrop-blur transition duration-500 group-hover:bg-white group-hover:text-brand-800">
                                <x-icon name="arrow-up-right" class="size-4" />
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Testimonials --}}
    <section class="relative overflow-hidden bg-sand/70 py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -left-8 top-10 size-72 opacity-50"></div>
        <div class="container-x relative">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <span class="eyebrow">{{ setting('testimonials_eyebrow') }}</span>
                    <h2 class="display-title mt-4 text-balance">{{ setting('testimonials_heading') }}</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" data-testimonials-prev
                        class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:bg-brand-700 hover:text-white"
                        aria-label="Previous testimonial">
                        <x-icon name="arrow-left" class="size-4" />
                    </button>
                    <button type="button" data-testimonials-next
                        class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:bg-brand-700 hover:text-white"
                        aria-label="Next testimonial">
                        <x-icon name="arrow-right" class="size-4" />
                    </button>
                </div>
            </div>

            <div class="mt-12" data-testimonials-swiper data-reveal>
                <div class="swiper">
                    <div class="swiper-wrapper pb-2">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide h-auto! flex">
                                <figure
                                    class="flex h-full w-full flex-col rounded-4xl border border-ink-900/5 bg-white p-7 shadow-sm sm:p-8">
                                    <div class="flex items-center justify-between">
                                        <x-icon name="quote" class="size-9 text-gold-400" />
                                        <div class="flex gap-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <x-icon name="star"
                                                    class="size-3.5 {{ $i <= $testimonial->rating ? 'text-gold-500' : 'text-ink-200' }}" />
                                            @endfor
                                        </div>
                                    </div>

                                    <blockquote class="mt-6 flex-1 font-display text-lg leading-relaxed text-ink-800">
                                        “{{ $testimonial->message }}”
                                    </blockquote>

                                    <figcaption class="mt-7 flex items-center gap-3 border-t border-ink-900/5 pt-5">
                                        {{-- avatar + name stays the same --}}
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div data-testimonials-dots class="mt-6 flex items-center justify-center gap-2"></div>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="relative overflow-hidden bg-brand-800 py-20 text-white lg:py-28">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-35"></div>
        <div class="section-blob -left-20 top-10 size-80 bg-gold-400/10"></div>
        <div class="section-blob -right-24 bottom-0 size-96 bg-accent-600/20"></div>

        <div class="container-x relative grid gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
            <div data-reveal="left">
                <span class="eyebrow eyebrow-light">Get in Touch</span>
                <h2 class="mt-4 font-display text-4xl font-medium leading-tight sm:text-5xl">Let's find the <span
                        class="italic text-gold-300">right address</span> for you.</h2>
                <p class="mt-5 max-w-md text-sm leading-relaxed text-white/60">
                    Whether you are looking for a family home, planning to invest, or want to develop your land with us, our
                    team is ready to help.
                </p>

                <div class="mt-9 space-y-3">
                    <a href="tel:{{ setting('phone_link') }}"
                        class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:border-gold-300/30 hover:bg-white/10">
                        <span class="grid size-11 place-items-center rounded-full bg-gold-400/15 text-gold-300"><x-icon
                                name="phone" class="size-5" /></span>
                        <span>
                            <span class="block text-[9px] font-extrabold uppercase tracking-[0.22em] text-white/45">Call
                                us</span>
                            <span class="mt-0.5 block text-sm font-bold">{{ setting('phone') }}</span>
                        </span>
                    </a>
                    <a href="mailto:{{ setting('email') }}"
                        class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:border-gold-300/30 hover:bg-white/10">
                        <span class="grid size-11 place-items-center rounded-full bg-gold-400/15 text-gold-300"><x-icon
                                name="mail" class="size-5" /></span>
                        <span>
                            <span class="block text-[9px] font-extrabold uppercase tracking-[0.22em] text-white/45">Email
                                us</span>
                            <span class="mt-0.5 block text-sm font-bold">{{ setting('email') }}</span>
                        </span>
                    </a>
                    <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4">
                        <span class="grid size-11 place-items-center rounded-full bg-gold-400/15 text-gold-300"><x-icon
                                name="pin" class="size-5" /></span>
                        <span>
                            <span
                                class="block text-[9px] font-extrabold uppercase tracking-[0.22em] text-white/45">Corporate
                                office</span>
                            <span class="mt-0.5 block text-sm font-bold">{{ setting('address') }}</span>
                        </span>
                    </div>
                </div>

                <p class="mt-6 flex items-center gap-2 text-xs text-white/45">
                    <x-icon name="clock" class="size-4 text-gold-300" />
                    {{ setting('office_hours') }}
                </p>
            </div>

            <div class="rounded-4xl bg-white p-6 text-ink-800 shadow-2xl shadow-ink-950/30 sm:p-8" data-reveal="right">
                <div class="mb-6">
                    <p class="text-[10px] font-extrabold uppercase tracking-[0.28em] text-accent-600">Enquiry Form</p>
                    <h3 class="mt-2 font-display text-2xl text-ink-900">Tell us what you need</h3>
                </div>
                <x-contact-form :projects="$projects" />
            </div>
        </div>
    </section>
@endsection
