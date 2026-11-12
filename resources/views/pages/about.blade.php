@extends('layouts.app')

@section('title', 'About Us | '.setting('site_name'))
@section('meta_description', setting('about_short'))

@section('content')
    <x-page-hero
        eyebrow="About PRB Holdings"
        title="Built on trust. Designed for living."
        subtitle="A modern real estate developer creating sustainable, thoughtfully planned residential communities across Uttara, Dhaka."
    />

    {{-- Story --}}
    <section class="relative overflow-hidden bg-cream py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -right-10 top-20 size-80 opacity-50"></div>

        <div class="container-x relative grid items-start gap-14 lg:grid-cols-[0.92fr_1.08fr] lg:gap-20">
            <div class="relative mx-auto w-full max-w-md lg:sticky lg:top-28 lg:max-w-none" data-reveal="left">
                <div class="absolute -left-4 -top-4 size-24 rounded-[1.75rem] border border-brand-700/20"></div>
                <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] shadow-2xl shadow-ink-950/20">
                    <img src="{{ media_url(setting('about_image_main'), 'uploads/projects/shirin-garden/living.jpg') }}" alt="PRB Holdings living space" loading="lazy" class="h-full w-full object-cover">
                </div>
                <div class="absolute -bottom-8 -right-4 w-44 overflow-hidden rounded-[1.75rem] border-8 border-cream shadow-xl sm:w-52">
                    <div class="aspect-square">
                        <img src="{{ media_url(setting('about_image_secondary'), 'uploads/projects/shirin-garden/bedroom.jpg') }}" alt="PRB Holdings bedroom" loading="lazy" class="h-full w-full object-cover">
                    </div>
                </div>
                <div class="absolute -bottom-6 left-4 rounded-2xl bg-accent-600 px-5 py-4 text-white shadow-xl">
                    <p class="font-display text-2xl leading-none">24/7</p>
                    <p class="mt-1 text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/70">Care & security</p>
                </div>
            </div>

            <div data-reveal="right">
                <span class="eyebrow">{{ setting('about_eyebrow') }}</span>
                <h2 class="display-title mt-4 text-balance">{{ setting('about_heading') }}</h2>

                <div class="mt-7 space-y-5 text-sm leading-relaxed text-ink-500 sm:text-base">
                    @foreach (preg_split('/\n\s*\n/', setting('about_story', '')) as $paragraph)
                        @if (trim($paragraph) !== '')
                            <p>{{ trim($paragraph) }}</p>
                        @endif
                    @endforeach
                </div>

                <div class="mt-9 grid gap-4 sm:grid-cols-2">
                    <div class="flex items-start gap-3 rounded-2xl border border-ink-900/5 bg-white p-4 shadow-sm">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-brand-700 text-white"><x-icon name="check" class="size-4" /></span>
                        <div>
                            <p class="text-sm font-extrabold text-ink-900">Mutual trust</p>
                            <p class="mt-1 text-xs leading-relaxed text-ink-500">Relationships built on respect and transparency.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl border border-ink-900/5 bg-white p-4 shadow-sm">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-accent-600 text-white"><x-icon name="sparkles" class="size-4" /></span>
                        <div>
                            <p class="text-sm font-extrabold text-ink-900">Unwavering quality</p>
                            <p class="mt-1 text-xs leading-relaxed text-ink-500">Expert engineers and architects at every stage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Quote band --}}
    <section class="relative overflow-hidden bg-brand-800 py-14 text-white">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-center gap-4 text-center">
            <x-icon name="quote" class="size-10 text-gold-300" />
            <p class="max-w-3xl font-display text-2xl italic leading-snug sm:text-3xl">“{{ setting('site_tagline') }}”</p>
            <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-white/50">The PRB Promise</p>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-cream pb-4 pt-16">
        <div class="container-x">
            <div class="grid gap-px overflow-hidden rounded-[2rem] bg-ink-900/10 shadow-2xl shadow-ink-950/20 sm:grid-cols-2 lg:grid-cols-4" data-reveal="zoom">
                @foreach ($stats as $stat)
                    <div class="bg-white px-7 py-8">
                        <p class="font-display text-4xl font-medium text-brand-800">
                            <span data-counter="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>
                        </p>
                        <p class="mt-2 text-[10px] font-extrabold uppercase tracking-[0.22em] text-ink-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Vision / Mission --}}
    <section class="bg-cream py-20 lg:py-28">
        <div class="container-x grid gap-6 lg:grid-cols-2">
            <div class="relative overflow-hidden rounded-[2.5rem] bg-ink-950 p-8 text-white sm:p-10" data-reveal="left">
                <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
                <div class="section-blob -right-10 -top-10 size-56 bg-brand-500/20"></div>
                <div class="relative">
                    <span class="grid size-14 place-items-center rounded-2xl bg-brand-600/20 text-gold-300"><x-icon name="compass" class="size-7" /></span>
                    <p class="mt-8 text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Our Vision</p>
                    <h3 class="mt-3 font-display text-3xl font-medium leading-tight sm:text-4xl">{{ setting('vision') }}</h3>
                    <div class="mt-8 h-px w-full bg-white/10"></div>
                    <p class="mt-6 max-w-md text-sm leading-relaxed text-white/50">Every decision we make — from land selection to the final finish — is measured against this ambition.</p>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-[2.5rem] bg-accent-800 p-8 text-white sm:p-10" data-reveal="right">
                <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
                <div class="section-blob -right-10 -top-10 size-56 bg-gold-400/15"></div>
                <div class="relative">
                    <span class="grid size-14 place-items-center rounded-2xl bg-white/10 text-gold-200"><x-icon name="sparkles" class="size-7" /></span>
                    <p class="mt-8 text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-200">Our Mission</p>
                    <h3 class="mt-3 font-display text-3xl font-medium leading-tight sm:text-4xl">{{ setting('mission') }}</h3>
                    <div class="mt-8 h-px w-full bg-white/10"></div>
                    <p class="mt-6 max-w-md text-sm leading-relaxed text-white/60">We build for real families, real budgets and a better urban future — one carefully planned address at a time.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-white lg:py-28">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-35"></div>
        <div class="container-x relative">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="eyebrow eyebrow-light">What Sets Us Apart</span>
                <h2 class="mt-4 font-display text-4xl font-medium leading-tight sm:text-5xl">The details that make a PRB address different.</h2>
            </div>

            <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($amenities as $amenity)
                    <div class="group rounded-[1.75rem] border border-white/10 bg-white/5 p-6 transition duration-500 hover:-translate-y-1.5 hover:border-gold-300/25 hover:bg-white/10" data-reveal>
                        <span class="grid size-12 place-items-center rounded-2xl bg-brand-600/20 text-gold-300 transition group-hover:bg-gold-400 group-hover:text-ink-950">
                            <x-icon :name="$amenity->icon" class="size-6" />
                        </span>
                        <h3 class="mt-6 text-base font-extrabold">{{ $amenity->title }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-white/45">{{ $amenity->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x">
            <div class="max-w-2xl" data-reveal>
                <span class="eyebrow">How We Work</span>
                <h2 class="display-title mt-4">From first conversation<br class="hidden sm:block"> to final handover.</h2>
            </div>

            <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Listen & Plan', 'text' => 'We understand your land, budget and expectations before proposing a way forward.', 'icon' => 'users'],
                    ['title' => 'Design & Approve', 'text' => 'Architectural planning, structural design and approvals are handled with clarity.', 'icon' => 'document'],
                    ['title' => 'Build with Care', 'text' => 'Experienced engineers supervise materials, workmanship and timelines on site.', 'icon' => 'building'],
                    ['title' => 'Handover & Support', 'text' => 'A smooth handover, followed by responsive building care and maintenance.', 'icon' => 'shield'],
                ] as $step)
                    <div class="group relative overflow-hidden rounded-[1.75rem] border border-ink-900/5 bg-cream p-6" data-reveal>
                        <span class="font-display text-5xl text-brand-700/15 transition group-hover:text-accent-500/25">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="mt-4 grid size-11 place-items-center rounded-xl bg-white text-brand-700 shadow-sm">
                            <x-icon :name="$step['icon']" class="size-5" />
                        </span>
                        <h3 class="mt-5 text-sm font-extrabold text-ink-900">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-ink-500">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    @if ($testimonials->isNotEmpty())
        <section class="bg-sand/70 py-20">
            <div class="container-x">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <span class="eyebrow">In Their Words</span>
                        <h2 class="display-title mt-4">Trusted by the families<br class="hidden sm:block"> who live with us.</h2>
                    </div>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-800">
                        Explore projects <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>

                <div class="mt-10 grid gap-5 md:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <figure class="flex h-full flex-col rounded-[2rem] border border-ink-900/5 bg-white p-7 shadow-sm" data-reveal>
                            <div class="flex items-center justify-between">
                                <x-icon name="quote" class="size-8 text-gold-400" />
                                <div class="flex gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <x-icon name="star" class="size-3 {{ $i <= $testimonial->rating ? 'text-gold-500' : 'text-ink-200' }}" />
                                    @endfor
                                </div>
                            </div>
                            <blockquote class="mt-5 flex-1 text-sm leading-relaxed text-ink-600">“{{ $testimonial->message }}”</blockquote>
                            <figcaption class="mt-6 flex items-center gap-3 border-t border-ink-900/5 pt-5">
                                <span class="grid size-10 place-items-center rounded-full bg-brand-700 text-[11px] font-extrabold text-white">{{ $testimonial->initials }}</span>
                                <div>
                                    <p class="text-sm font-extrabold text-ink-900">{{ $testimonial->name }}</p>
                                    <p class="text-[11px] text-ink-400">{{ $testimonial->designation }}</p>
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
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