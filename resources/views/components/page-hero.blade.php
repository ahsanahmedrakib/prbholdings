@props([
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
])

<section class="relative overflow-hidden bg-ink-950 pb-16 pt-14 text-white lg:pb-20 lg:pt-16">
    <div class="pattern-grid pointer-events-none absolute inset-0 opacity-40"></div>
    <div class="section-blob -left-24 top-0 size-80 bg-brand-600/25"></div>
    <div class="section-blob right-0 top-16 size-72 bg-accent-600/15"></div>
    <div class="section-blob bottom-0 left-1/3 size-64 bg-gold-500/10"></div>

    <div class="container-x relative">
        <nav class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/45" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="transition hover:text-gold-300">Home</a>
            <x-icon name="chevron-right" class="size-3" />
            <span class="text-white/80">{{ $eyebrow ?? $title }}</span>
        </nav>

        <div class="mt-8 max-w-3xl" data-reveal>
            @if ($eyebrow)
                <span class="eyebrow eyebrow-light">{{ $eyebrow }}</span>
            @endif
            <h1 class="mt-4 font-display text-4xl font-medium leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-5 max-w-2xl text-sm leading-relaxed text-white/60 sm:text-base">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</section>