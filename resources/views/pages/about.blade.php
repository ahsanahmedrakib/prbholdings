@extends('layouts.app')

@section('title', 'About Us | '.setting('site_name'))
@section('meta_description', setting('about_short'))

@php
    $storyParagraphs = collect(preg_split('/\n\s*\n/', setting('about_story', '')))
        ->map(fn ($paragraph) => trim($paragraph))
        ->filter();

    $values = [
        ['title' => 'Integrity', 'text' => 'We do what we say — in our pricing, our timelines and our paperwork.', 'icon' => 'shield'],
        ['title' => 'Respectful, Long-Term Partnership', 'text' => 'We build relationships with buyers and landowners that outlast a single project.', 'icon' => 'users'],
        ['title' => 'Customer Satisfaction', 'text' => 'Every decision is measured against the experience of the families who live with us.', 'icon' => 'sparkles'],
        ['title' => 'Open & Transparent Culture', 'text' => 'Clear communication, honest updates and no surprises at any stage.', 'icon' => 'eye'],
        ['title' => 'Engaging & Growing Team', 'text' => 'We invest in our people so they can bring their best to every PRB address.', 'icon' => 'leaf'],
    ];
@endphp

@section('content')
    <x-page-hero
        :image="setting('banner_image_about')"
        eyebrow="About PRB Holdings"
        title="About Us"
        subtitle="A modern real estate developer creating sustainable, thoughtfully planned residential communities across Uttara, Dhaka."
    />

    {{-- Who We Are --}}
    <section class="relative overflow-hidden bg-cream py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -right-10 top-20 size-80 opacity-50"></div>

        <div class="container-x relative grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" data-reveal="left" x-data="{ showVideo: false }">
                <div class="absolute -left-4 -top-4 size-24 rounded-[1.75rem] border border-brand-700/20"></div>
                <div class="relative aspect-4/5 overflow-hidden rounded-[2.5rem] shadow-2xl shadow-ink-950/20">
                    <img src="{{ media_url(setting('about_image_main'), 'uploads/projects/shirin-garden/living.jpg') }}"
                        alt="PRB Holdings residence" loading="lazy" class="h-full w-full object-cover">

                    @if (setting('about_video_url'))
                        <button type="button" @click="showVideo = true"
                            class="group absolute inset-0 grid place-items-center bg-ink-950/25 transition hover:bg-ink-950/40"
                            aria-label="Play company video">
                            <span class="grid size-20 place-items-center rounded-full bg-white/95 text-brand-800 shadow-xl transition duration-300 group-hover:scale-105">
                                <x-icon name="play" class="size-7 translate-x-0.5" />
                            </span>
                        </button>
                    @endif
                </div>

                <div class="absolute -bottom-6 left-4 rounded-2xl bg-accent-600 px-5 py-4 text-white shadow-xl">
                    <p class="font-display text-2xl leading-none">24/7</p>
                    <p class="mt-1 text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/70">Care &amp; security</p>
                </div>

                @if (setting('about_video_url'))
                    <div x-show="showVideo" x-cloak @keydown.escape.window="showVideo = false"
                        class="fixed inset-0 z-80 grid place-items-center bg-ink-950/85 p-4 backdrop-blur-sm">
                        <button type="button" @click="showVideo = false"
                            class="absolute right-5 top-5 grid size-11 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white/20"
                            aria-label="Close video">
                            <x-icon name="close" class="size-5" />
                        </button>
                        <div class="relative aspect-video w-full max-w-4xl overflow-hidden rounded-2xl bg-black shadow-2xl">
                            <template x-if="showVideo">
                                <iframe src="{{ setting('about_video_url') }}" class="h-full w-full"
                                    allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen
                                    title="PRB Holdings video"></iframe>
                            </template>
                        </div>
                    </div>
                @endif
            </div>

            <div data-reveal="right" x-data="{ expanded: false }">
                <span class="eyebrow">Who We Are</span>
                <h2 class="display-title mt-4 text-balance">{{ setting('about_heading') }}</h2>

                <p class="mt-6 text-sm leading-relaxed text-ink-500 sm:text-base">{{ setting('about_short') }}</p>

                @if ($storyParagraphs->isNotEmpty())
                    <div class="mt-4 space-y-4 text-sm leading-relaxed text-ink-500 sm:text-base" :class="expanded ? '' : 'line-clamp-4'">
                        @foreach ($storyParagraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <button type="button" @click="expanded = !expanded"
                        class="mt-5 inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800 transition hover:text-accent-600">
                        <span x-text="expanded ? 'Read Less' : 'Read More'">Read More</span>
                        <span class="inline-flex transition duration-300" :class="expanded ? 'rotate-180' : ''">
                            <x-icon name="chevron-down" class="size-4" />
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- Purpose & Vision --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x grid gap-10 lg:grid-cols-2 lg:gap-16">
            <div data-reveal="left">
                <div class="flex items-center gap-3">
                    <span class="grid size-11 place-items-center rounded-2xl bg-brand-50 text-brand-700"><x-icon name="compass" class="size-5" /></span>
                    <h2 class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">Purpose</h2>
                </div>
                <p class="mt-5 font-display text-xl italic leading-relaxed text-ink-700 sm:text-2xl">{{ setting('mission') }}</p>
                <div class="mt-6 h-px w-full bg-ink-900/10"></div>
                <p class="mt-6 max-w-lg text-sm leading-relaxed text-ink-500">Every PRB address starts with a simple question: will this genuinely improve the everyday life of the family who lives here?</p>
            </div>

            <div data-reveal="right">
                <div class="flex items-center gap-3">
                    <span class="grid size-11 place-items-center rounded-2xl bg-accent-50 text-accent-700"><x-icon name="sparkles" class="size-5" /></span>
                    <h2 class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">Vision</h2>
                </div>
                <p class="mt-5 font-display text-xl italic leading-relaxed text-ink-700 sm:text-2xl">{{ setting('vision') }}</p>
                <div class="mt-6 h-px w-full bg-ink-900/10"></div>
                <p class="mt-6 max-w-lg text-sm leading-relaxed text-ink-500">We are building towards a reputation where a PRB address is synonymous with trust, craftsmanship and lasting value.</p>
            </div>
        </div>
    </section>

    {{-- Our Values --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-white lg:py-28">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-35"></div>
        <div class="section-blob -left-24 top-10 size-80 bg-brand-500/10"></div>

        <div class="container-x relative">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="eyebrow eyebrow-light">Our Values</span>
                <h2 class="mt-4 font-display text-4xl font-medium leading-tight sm:text-5xl">The principles behind every decision.</h2>
            </div>

            <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($values as $value)
                    <div class="group rounded-[1.75rem] border border-white/10 bg-white/5 p-6 transition duration-500 hover:-translate-y-1.5 hover:border-gold-300/25 hover:bg-white/10 {{ $loop->last && $loop->count % 3 === 2 ? 'lg:col-span-1' : '' }}" data-reveal>
                        <span class="grid size-12 place-items-center rounded-2xl bg-brand-600/20 text-gold-300 transition group-hover:bg-gold-400 group-hover:text-ink-950">
                            <x-icon :name="$value['icon']" class="size-6" />
                        </span>
                        <h3 class="mt-6 text-base font-extrabold leading-snug">{{ $value['title'] }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-white/45">{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Chairman --}}
    @if ($chairman)
        <section class="bg-cream py-20 lg:py-28">
            <div class="container-x grid items-center gap-14 lg:grid-cols-[0.85fr_1.15fr] lg:gap-20">
                <div class="relative mx-auto w-full max-w-sm" data-reveal="left">
                    <div class="absolute -right-4 -top-4 size-24 rounded-[1.75rem] border border-brand-700/20"></div>
                    <div class="relative aspect-4/5 overflow-hidden rounded-[2.5rem] shadow-2xl shadow-ink-950/20">
                        @if ($chairman->image_url)
                            <img src="{{ $chairman->image_url }}" alt="{{ $chairman->name }}" loading="lazy" class="h-full w-full object-cover">
                        @else
                            <div class="grid h-full w-full place-items-center bg-linear-to-br from-brand-800 to-ink-950">
                                <span class="font-display text-6xl font-medium text-white/90">{{ $chairman->initials }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div data-reveal="right">
                    <span class="eyebrow">Chairman's Message</span>
                    <h2 class="display-title mt-4">{{ $chairman->name }}</h2>
                    <p class="mt-2 text-sm font-bold text-accent-600">{{ $chairman->designation }}</p>

                    <x-icon name="quote" class="mt-7 size-9 text-gold-400" />

                    <div class="mt-4 space-y-4 text-sm leading-relaxed text-ink-600 sm:text-base">
                        @foreach (collect(preg_split('/\n\s*\n/', (string) $chairman->bio))->map(fn ($p) => trim($p))->filter() as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <a href="{{ route('about.team') }}" class="btn-primary mt-8">
                        Learn More
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Management Team --}}
    @if ($management->isNotEmpty())
        <section class="bg-white py-20 lg:py-28">
            <div class="container-x">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <span class="eyebrow">Our People</span>
                        <h2 class="display-title mt-4">Management Team</h2>
                    </div>
                    <p class="max-w-sm text-sm leading-relaxed text-ink-500">Experienced professionals leading PRB Holdings across engineering, design, operations and customer care.</p>
                </div>

                <div class="mt-12" data-team-swiper data-reveal>
                    <div class="swiper">
                        <div class="swiper-wrapper pb-2">
                            @foreach ($management as $member)
                                <div class="swiper-slide h-auto! flex">
                                    <article class="flex h-full w-full flex-col overflow-hidden rounded-[1.75rem] border border-brand-700 bg-cream shadow-sm">
                                        <div class="aspect-4/5 overflow-hidden">
                                            @if ($member->image_url)
                                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" loading="lazy" class="h-full w-full object-cover">
                                            @else
                                                <div class="grid h-full w-full place-items-center bg-linear-to-br from-brand-700 to-ink-950">
                                                    <span class="font-display text-5xl font-medium text-white/90">{{ $member->initials }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-6">
                                            <h3 class="font-display text-xl font-medium text-ink-900">{{ $member->name }}</h3>
                                            <p class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-accent-600">{{ $member->designation }}</p>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-between gap-4">
                        <a href="{{ route('about.team') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800 transition hover:text-accent-600">
                            More about our team <x-icon name="arrow-right" class="size-4" />
                        </a>
                        <div class="flex items-center gap-2">
                            <button type="button" data-team-prev
                                class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800 disabled:opacity-40"
                                aria-label="Previous team member">
                                <x-icon name="arrow-left" class="size-4" />
                            </button>
                            <button type="button" data-team-next
                                class="grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 transition hover:border-brand-700/30 hover:text-brand-800 disabled:opacity-40"
                                aria-label="Next team member">
                                <x-icon name="arrow-right" class="size-4" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="relative overflow-hidden bg-brand-800 py-16 text-white lg:py-20">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Let's Build Together</p>
                <h2 class="mt-3 font-display text-3xl font-medium sm:text-4xl">Ready to take the next step?</h2>
                <p class="mt-3 max-w-xl text-sm text-white/55">Speak with our team about buying an apartment or developing your land with PRB Holdings.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="btn-accent btn-shine">Book a Visit <x-icon name="arrow-up-right" class="size-4" /></a>
                <a href="tel:{{ setting('phone_link') }}" class="btn-ghost-light">{{ setting('phone') }}</a>
            </div>
        </div>
    </section>
@endsection
