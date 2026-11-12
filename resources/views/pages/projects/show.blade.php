@extends('layouts.app')

@section('title', $project->name.' | '.setting('site_name'))
@section('meta_description', $project->tagline ?: $project->description)

@section('content')
    @php
        $facts = collect([
            ['label' => 'Nature', 'value' => $project->nature, 'icon' => 'home'],
            ['label' => 'Storied', 'value' => $project->floors, 'icon' => 'floors'],
            ['label' => 'Land Area', 'value' => $project->land_area, 'icon' => 'area'],
            ['label' => 'Facing', 'value' => $project->facing, 'icon' => 'compass'],
            ['label' => 'Apartments', 'value' => $project->total_apartments ? $project->total_apartments.' Nos.' : null, 'icon' => 'building'],
            ['label' => 'Lifts', 'value' => $project->total_lifts ? $project->total_lifts.' Nos.' : null, 'icon' => 'lift'],
        ])->filter(fn ($fact) => filled($fact['value']));

        $gallery = $project->gallery;
    @endphp

    <section class="relative overflow-hidden bg-ink-950 pb-20 pt-10 text-white lg:pb-24">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-40"></div>
        <div class="section-blob -left-24 top-0 size-96 bg-brand-600/25"></div>
        <div class="section-blob -right-20 bottom-0 size-80 bg-accent-600/15"></div>

        <div class="container-x relative">
            <nav class="flex flex-wrap items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/45" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-gold-300">Home</a>
                <x-icon name="chevron-right" class="size-3" />
                <a href="{{ route('projects.index') }}" class="transition hover:text-gold-300">Projects</a>
                <x-icon name="chevron-right" class="size-3" />
                <span class="text-white/80">{{ $project->name }}</span>
            </nav>

            <div class="mt-8 grid items-center gap-12 lg:grid-cols-[1.04fr_0.96fr] lg:gap-16">
                <div data-reveal="left">
                    <span class="inline-flex items-center rounded-full px-3.5 py-1.5 text-[10px] font-extrabold uppercase tracking-[0.18em] ring-1 backdrop-blur {{ $project->status_class }}">
                        {{ $project->status_label }}
                    </span>

                    <h1 class="mt-5 font-display text-4xl font-medium leading-[1.03] tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $project->name }}</h1>

                    @if ($project->tagline)
                        <p class="mt-4 max-w-xl font-display text-xl italic text-gold-300">{{ $project->tagline }}</p>
                    @endif

                    <p class="mt-5 flex items-center gap-2 text-sm font-semibold text-white/60">
                        <x-icon name="pin" class="size-4 text-gold-300" />
                        {{ $project->location }}
                    </p>

                    @if ($project->description)
                        <p class="mt-6 max-w-xl text-sm leading-relaxed text-white/55">{{ \Illuminate\Support\Str::limit($project->description, 260) }}</p>
                    @endif

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#enquire" class="btn-accent btn-shine">Enquire About This Project <x-icon name="arrow-up-right" class="size-4" /></a>
                        @if ($project->brochure_file)
                            <a href="{{ asset($project->brochure_file) }}" target="_blank" rel="noopener" class="btn-ghost-light">
                                View Brochure <x-icon name="download" class="size-4" />
                            </a>
                        @else
                            <a href="{{ route('contact') }}" class="btn-ghost-light">Book a Site Visit <x-icon name="calendar" class="size-4" /></a>
                        @endif
                    </div>

                    <div class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-[11px] font-semibold text-white/40">
                        <span class="flex items-center gap-2"><x-icon name="check" class="size-3.5 text-gold-300" /> Expert engineering</span>
                        <span class="flex items-center gap-2"><x-icon name="check" class="size-3.5 text-gold-300" /> Secure premises</span>
                        <span class="flex items-center gap-2"><x-icon name="check" class="size-3.5 text-gold-300" /> Planned layouts</span>
                    </div>
                </div>

                <div class="relative mx-auto w-full max-w-md lg:max-w-none" data-reveal="right">
                    <div class="absolute -right-4 -top-4 size-24 rounded-[1.75rem] border border-gold-300/30"></div>
                    <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] border border-white/15 shadow-2xl shadow-black/40">
                        <img src="{{ $project->hero_image_url }}" alt="{{ $project->name }}" class="h-full w-full object-cover" fetchpriority="high">
                        <div class="absolute inset-0 bg-linear-to-t from-ink-950/60 via-transparent to-transparent"></div>
                    </div>

                    <div class="absolute -bottom-5 left-5 flex items-center gap-3 rounded-2xl border border-white/15 bg-ink-950/70 px-4 py-3 backdrop-blur-md">
                        <span class="grid size-9 place-items-center rounded-full bg-gold-400/20 text-gold-300"><x-icon name="building" class="size-4" /></span>
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/45">Project Type</p>
                            <p class="text-xs font-bold text-white">{{ $project->nature ?: 'Residential' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Facts --}}
    @if ($facts->isNotEmpty())
        <div class="relative z-10 bg-cream">
            <div class="container-x">
                <div class="mt-[-2.5rem] grid gap-px overflow-hidden rounded-[2rem] border border-ink-900/5 bg-ink-900/10 shadow-2xl shadow-ink-950/15 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6" data-reveal="zoom">
                    @foreach ($facts as $fact)
                        <div class="group bg-white px-5 py-6 transition hover:bg-brand-50/60">
                            <span class="grid size-9 place-items-center rounded-xl bg-cream text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                                <x-icon :name="$fact['icon']" class="size-4" />
                            </span>
                            <p class="mt-4 text-[9px] font-extrabold uppercase tracking-[0.2em] text-ink-400">{{ $fact['label'] }}</p>
                            <p class="mt-1 text-sm font-extrabold text-ink-900">{{ $fact['value'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Overview --}}
    <section class="bg-cream py-16 lg:py-24">
        <div class="container-x grid items-start gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:gap-16">
            <div data-reveal>
                <span class="eyebrow">The Residence</span>
                <h2 class="display-title mt-4">A closer look at {{ $project->name }}.</h2>

                @if ($project->description)
                    <div class="mt-6 space-y-4 text-sm leading-relaxed text-ink-500 sm:text-base">
                        @foreach (preg_split('/\n\s*\n/', $project->description) as $paragraph)
                            @if (trim($paragraph) !== '')
                                <p>{{ trim($paragraph) }}</p>
                            @endif
                        @endforeach
                    </div>
                @endif

                @if (filled($project->features))
                    <div class="mt-8">
                        <h3 class="text-[10px] font-extrabold uppercase tracking-[0.25em] text-ink-400">Each apartment includes</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($project->features as $feature)
                                <span class="inline-flex items-center gap-2 rounded-full border border-brand-700/10 bg-white px-3.5 py-2 text-xs font-bold text-brand-800">
                                    <x-icon name="check" class="size-3.5 text-brand-500" />
                                    {{ $feature }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (filled($project->ground_floor))
                    <div class="mt-8 rounded-[1.75rem] border border-ink-900/5 bg-white p-6 shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="grid size-10 place-items-center rounded-xl bg-ink-950 text-gold-300"><x-icon name="building" class="size-5" /></span>
                            <h3 class="text-sm font-extrabold text-ink-900">Ground Floor Facilities</h3>
                        </div>
                        <div class="mt-4 grid gap-2 sm:grid-cols-2">
                            @foreach (explode(',', $project->ground_floor) as $facility)
                                @if (trim($facility) !== '')
                                    <p class="flex items-start gap-2 text-xs leading-relaxed text-ink-500">
                                        <x-icon name="check" class="mt-0.5 size-3.5 shrink-0 text-brand-600" />
                                        {{ trim($facility) }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-5 lg:sticky lg:top-28" data-reveal="right">
                <div class="overflow-hidden rounded-[1.75rem] border border-ink-900/5 bg-white shadow-sm">
                    <div class="border-b border-ink-900/5 bg-ink-950 px-6 py-5 text-white">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.24em] text-gold-300">Apartment Sizes</p>
                        <h3 class="mt-1 font-display text-xl">Available layouts</h3>
                    </div>

                    @if (filled($project->apartment_types))
                        <div class="divide-y divide-ink-900/5">
                            @foreach ($project->apartment_types as $type)
                                <div class="flex items-center justify-between gap-4 px-6 py-4">
                                    <span class="flex items-center gap-3 text-sm font-semibold text-ink-700">
                                        <span class="grid size-8 place-items-center rounded-lg bg-brand-50 text-brand-700"><x-icon name="home" class="size-3.5" /></span>
                                        {{ $type['type'] ?? 'Apartment' }}
                                    </span>
                                    <span class="font-display text-lg text-ink-900">{{ $type['size'] ?? 'On request' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="px-6 py-8 text-sm leading-relaxed text-ink-500">
                            Apartment sizes and availability are available on request. Contact our team for the latest information.
                        </div>
                    @endif
                </div>

                <div class="relative overflow-hidden rounded-[1.75rem] bg-brand-800 p-6 text-white">
                    <div class="pattern-grid absolute inset-0 opacity-25"></div>
                    <div class="relative">
                        <span class="grid size-10 place-items-center rounded-xl bg-white/10 text-gold-300"><x-icon name="phone" class="size-5" /></span>
                        <h3 class="mt-4 font-display text-xl">Prefer to talk?</h3>
                        <p class="mt-2 text-xs leading-relaxed text-white/55">Our team can answer questions about availability, pricing and site visits.</p>
                        <a href="tel:{{ setting('phone_link') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-extrabold text-gold-300">
                            {{ setting('phone') }}
                            <x-icon name="arrow-up-right" class="size-4" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    @if ($gallery->isNotEmpty())
        <section class="bg-white py-16 lg:py-24">
            <div class="container-x">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <span class="eyebrow">Project Gallery</span>
                        <h2 class="display-title mt-4">Step inside.</h2>
                    </div>
                    <a href="{{ route('gallery', ['project' => $project->slug]) }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800">
                        Full gallery <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($gallery as $image)
                        <button
                            type="button"
                            data-lightbox="{{ $image->image_url }}"
                            data-lightbox-alt="{{ $image->caption ?: $project->name }}"
                            class="group relative overflow-hidden rounded-[1.5rem] bg-ink-900 text-left {{ $loop->first ? 'sm:col-span-2 sm:row-span-2' : '' }}"
                            data-reveal="zoom"
                        >
                            <div class="{{ $loop->first ? 'aspect-[4/3] sm:aspect-square' : 'aspect-[4/3]' }} overflow-hidden">
                                <img src="{{ $image->image_url }}" alt="{{ $image->caption ?: $project->name }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                            </div>
                            <div class="absolute inset-0 bg-linear-to-t from-ink-950/75 via-transparent to-transparent"></div>
                            <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
                                <p class="text-xs font-bold text-white">{{ $image->caption }}</p>
                                <span class="grid size-8 shrink-0 place-items-center rounded-full bg-white/15 text-white backdrop-blur"><x-icon name="image" class="size-3.5" /></span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Floor plans --}}
    @if ($project->floorPlans->isNotEmpty())
        <section class="bg-cream py-16 lg:py-24">
            <div class="container-x">
                <div class="max-w-2xl" data-reveal>
                    <span class="eyebrow">Floor Plans</span>
                    <h2 class="display-title mt-4">Every square foot, considered.</h2>
                    <p class="mt-4 text-sm leading-relaxed text-ink-500">Click any plan to view it in detail. Final layouts may vary slightly during construction.</p>
                </div>

                <div class="mt-10 grid gap-4 md:grid-cols-2">
                    @foreach ($project->floorPlans as $plan)
                        <button
                            type="button"
                            data-lightbox="{{ $plan->image_url }}"
                            data-lightbox-alt="{{ $plan->caption ?: $project->name }} floor plan"
                            class="group overflow-hidden rounded-[1.75rem] border border-ink-900/5 bg-white p-3 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                            data-reveal
                        >
                            <div class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-2xl bg-cream">
                                <img src="{{ $plan->image_url }}" alt="{{ $plan->caption ?: $project->name }}" loading="lazy" class="h-full w-full object-contain transition duration-500 group-hover:scale-105">
                            </div>
                            <div class="flex items-center justify-between gap-3 px-2 pb-1 pt-4">
                                <span class="text-xs font-bold text-ink-700">{{ $plan->caption }}</span>
                                <span class="grid size-8 shrink-0 place-items-center rounded-full bg-brand-50 text-brand-700"><x-icon name="search" class="size-3.5" /></span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Amenities --}}
    @if ($amenities->isNotEmpty())
        <section class="relative overflow-hidden bg-ink-950 py-16 text-white lg:py-24">
            <div class="pattern-grid pointer-events-none absolute inset-0 opacity-35"></div>
            <div class="container-x relative">
                <div class="max-w-2xl" data-reveal>
                    <span class="eyebrow eyebrow-light">Amenities</span>
                    <h2 class="mt-4 font-display text-4xl font-medium leading-tight sm:text-5xl">Comfort, built into every detail.</h2>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($amenities as $amenity)
                        <div class="group rounded-[1.5rem] border border-white/10 bg-white/5 p-5 transition duration-500 hover:-translate-y-1 hover:border-gold-300/25 hover:bg-white/10" data-reveal>
                            <span class="grid size-11 place-items-center rounded-xl bg-brand-600/20 text-gold-300 transition group-hover:bg-gold-400 group-hover:text-ink-950">
                                <x-icon :name="$amenity->icon" class="size-5" />
                            </span>
                            <h3 class="mt-5 text-sm font-extrabold">{{ $amenity->title }}</h3>
                            <p class="mt-2 text-xs leading-relaxed text-white/45">{{ $amenity->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Location & enquiry --}}
    <section id="enquire" class="bg-white py-16 lg:py-24">
        <div class="container-x grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16">
            <div data-reveal="left">
                <span class="eyebrow">Location</span>
                <h2 class="display-title mt-4">Perfectly placed.</h2>
                <p class="mt-4 flex items-center gap-2 text-sm font-semibold text-ink-600">
                    <x-icon name="pin" class="size-4 text-accent-600" />
                    {{ $project->location }}
                </p>

                <div class="mt-7 overflow-hidden rounded-[2rem] border border-ink-900/10 bg-cream shadow-sm">
                    <div class="aspect-[4/3] w-full sm:aspect-[16/10]">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($project->location) }}&output=embed"
                            title="{{ $project->name }} location map"
                            class="h-full w-full border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>

                <div class="mt-6 grid gap-3 sm:grid-cols-3">
                    @foreach ([
                        ['icon' => 'map', 'title' => 'Connected', 'text' => 'Close to main roads and transport.'],
                        ['icon' => 'users', 'title' => 'Community', 'text' => 'Schools, mosques and daily needs nearby.'],
                        ['icon' => 'shield', 'title' => 'Secure', 'text' => 'Monitored entry and professional care.'],
                    ] as $highlight)
                        <div class="rounded-2xl border border-ink-900/5 bg-cream p-4">
                            <span class="grid size-9 place-items-center rounded-lg bg-white text-brand-700 shadow-sm"><x-icon :name="$highlight['icon']" class="size-4" /></span>
                            <p class="mt-3 text-xs font-extrabold text-ink-900">{{ $highlight['title'] }}</p>
                            <p class="mt-1 text-[11px] leading-relaxed text-ink-500">{{ $highlight['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:sticky lg:top-28" data-reveal="right">
                <div class="rounded-[2rem] border border-ink-900/5 bg-cream p-6 shadow-xl shadow-ink-950/5 sm:p-8">
                    <div class="mb-6">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.28em] text-accent-600">Register Your Interest</p>
                        <h3 class="mt-2 font-display text-2xl text-ink-900">Enquire about {{ $project->name }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-ink-500">Leave your details and our team will get back to you with availability, pricing and site visit options.</p>
                    </div>
                    <x-contact-form :projects="collect()" :project="$project" subject="Project information" />
                </div>
            </div>
        </div>
    </section>

    {{-- Related --}}
    @if ($related->isNotEmpty())
        <section class="bg-cream py-16 lg:py-24">
            <div class="container-x">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <span class="eyebrow">You May Also Like</span>
                        <h2 class="display-title mt-4">More addresses to explore.</h2>
                    </div>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800">
                        All projects <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>

                <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $relatedProject)
                        <x-project-card :project="$relatedProject" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection