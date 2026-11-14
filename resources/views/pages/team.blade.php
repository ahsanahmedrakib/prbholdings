@extends('layouts.app')

@section('title', 'Our Team | '.setting('site_name'))
@section('meta_description', 'Meet the management and dream team behind PRB Holdings — the people building thoughtfully planned residential addresses across Uttara, Dhaka.')

@section('content')
    <x-page-hero
        :image="setting('banner_image_team')"
        eyebrow="Our Team"
        title="The people behind every PRB address."
        subtitle="A close-knit team of engineers, architects and customer-care professionals working together to build homes that families can trust."
    />

    <section class="relative overflow-hidden bg-cream py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -right-10 top-20 size-80 opacity-50"></div>

        <div class="container-x relative">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="eyebrow">Our People</span>
                <h2 class="display-title mt-4 text-balance">Guided by experience. Driven by care.</h2>
                <p class="mt-4 text-sm leading-relaxed text-ink-500">
                    From leadership to site supervision, every member of the PRB team shares one belief — your satisfaction is our dream.
                </p>
            </div>

            @forelse ($teamGroups as $category => $members)
                <div class="mt-16 first:mt-14">
                    <div class="flex items-center gap-4" data-reveal>
                        <h3 class="font-display text-2xl font-medium text-ink-900 sm:text-3xl">
                            {{ $members->first()->category_label }}
                        </h3>
                        <span class="h-px flex-1 bg-ink-900/10"></span>
                        <span class="text-[11px] font-extrabold uppercase tracking-[0.2em] text-ink-400">
                            {{ str_pad((string) $members->count(), 2, '0', STR_PAD_LEFT) }} Members
                        </span>
                    </div>

                    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($members as $member)
                            <article class="group flex h-full flex-col overflow-hidden rounded-4xl border border-brand-700 bg-white shadow-sm transition duration-500 hover:-translate-y-1.5 hover:shadow-xl"
                                data-reveal style="transition-delay: {{ ($loop->index % 3) * 70 }}ms">
                                <div class="relative aspect-4/5 overflow-hidden bg-white">
                                    @if ($member->image_url)
                                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}" loading="lazy"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                    @else
                                        <div class="pattern-grid absolute inset-0 opacity-40"></div>
                                        <div class="absolute inset-0 grid place-items-center">
                                            <span class="font-display text-7xl font-medium text-brand-800">{{ $member->initials }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-linear-to-t from-ink-950/80 via-transparent to-transparent"></div>
                                    <span class="absolute left-4 top-4 inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[9px] font-extrabold uppercase tracking-[0.16em] text-white backdrop-blur-md">
                                        {{ $member->category_label }}
                                    </span>
                                </div>

                                <div class="flex flex-1 flex-col p-6">
                                    <h4 class="font-display text-2xl font-medium text-ink-900">{{ $member->name }}</h4>
                                    @if ($member->designation)
                                        <p class="mt-1 text-[11px] font-extrabold uppercase tracking-[0.16em] text-accent-600">{{ $member->designation }}</p>
                                    @endif

                                    @if ($member->bio)
                                        <p class="mt-4 flex-1 text-sm leading-relaxed text-ink-500 line-clamp-5">{{ $member->bio }}</p>
                                    @endif

                                    @if ($member->email || $member->phone || $member->linkedin)
                                        <div class="mt-5 flex items-center gap-2 border-t border-ink-900/5 pt-4">
                                            @if ($member->email)
                                                <a href="mailto:{{ $member->email }}" class="grid size-9 place-items-center rounded-full border border-ink-900/10 text-ink-500 transition hover:border-brand-700/30 hover:text-brand-800" title="Email {{ $member->name }}">
                                                    <x-icon name="mail" class="size-4" />
                                                </a>
                                            @endif
                                            @if ($member->phone)
                                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $member->phone) }}" class="grid size-9 place-items-center rounded-full border border-ink-900/10 text-ink-500 transition hover:border-brand-700/30 hover:text-brand-800" title="Call {{ $member->name }}">
                                                    <x-icon name="phone" class="size-4" />
                                                </a>
                                            @endif
                                            @if ($member->linkedin)
                                                <a href="{{ $member->linkedin }}" target="_blank" rel="noopener" class="grid size-9 place-items-center rounded-full border border-ink-900/10 text-ink-500 transition hover:border-brand-700/30 hover:text-brand-800" title="{{ $member->name }} on LinkedIn">
                                                    <x-icon name="linkedin" class="size-4" />
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="mx-auto mt-12 max-w-xl rounded-4xl border border-dashed border-ink-900/15 bg-white px-6 py-20 text-center">
                    <span class="mx-auto grid size-16 place-items-center rounded-full bg-cream text-brand-700">
                        <x-icon name="users" class="size-7" />
                    </span>
                    <h2 class="mt-5 font-display text-2xl text-ink-900">Team profiles coming soon</h2>
                    <p class="mt-2 text-sm text-ink-500">Our team members will be added here shortly.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-6">Contact us</a>
                </div>
            @endforelse
        </div>
    </section>

    <section class="relative overflow-hidden bg-brand-800 py-16 text-white lg:py-20">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Join the journey</p>
                <h2 class="mt-3 font-display text-3xl font-medium sm:text-4xl">Want to build with us?</h2>
                <p class="mt-3 max-w-xl text-sm text-white/55">Whether you are a landowner, a buyer or a professional looking to join our team, we would love to hear from you.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-accent btn-shine shrink-0">Start a Conversation <x-icon name="arrow-up-right" class="size-4" /></a>
        </div>
    </section>
@endsection
