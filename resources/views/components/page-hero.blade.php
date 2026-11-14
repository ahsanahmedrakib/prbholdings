@props([
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'image' => null,
])

@php
    $bannerImage = $image ?: setting('banner_image', 'uploads/projects/shirin-garden/hero.jpg');
@endphp

<section class="relative isolate overflow-hidden bg-ink-950 text-white">
    <img src="{{ media_url($bannerImage, 'uploads/projects/shirin-garden/hero.jpg') }}" alt=""
        class="absolute inset-0 h-full w-full object-cover object-center" fetchpriority="high">
    <div class="absolute inset-0 bg-ink-950/60"></div>
    <div class="absolute inset-0 bg-linear-to-r from-ink-950/95 via-ink-950/65 to-ink-950/25"></div>
    <div class="absolute inset-0 bg-linear-to-t from-ink-950/70 via-transparent to-ink-950/30"></div>
    <div class="pattern-grid pointer-events-none absolute inset-0 opacity-20"></div>

    <div class="container-x relative flex min-h-75 flex-col justify-end pb-14 pt-24 sm:min-h-85 lg:min-h-105 lg:pb-20 lg:pt-32">
        <nav class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/50" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="transition hover:text-gold-300">Home</a>
            <x-icon name="chevron-right" class="size-3" />
            <span class="text-white/85">{{ $eyebrow ?? $title }}</span>
        </nav>

        <div class="mt-8 max-w-3xl" data-reveal>
            @if ($eyebrow)
                <span class="eyebrow eyebrow-light">{{ $eyebrow }}</span>
            @endif
            <h1 class="mt-4 font-display text-4xl font-medium leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-5 max-w-2xl text-sm leading-relaxed text-white/65 sm:text-base">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</section>
