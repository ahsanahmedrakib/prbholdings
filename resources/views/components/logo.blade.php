@props(['light' => false, 'full' => false])

@if ($full)
    <a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'group inline-flex']) }} aria-label="PRB Holdings home">
        <span class="inline-flex rounded-2xl bg-white p-2 shadow-lg shadow-ink-950/20 ring-1 ring-white/40 transition duration-500 group-hover:-translate-y-0.5 group-hover:shadow-xl">
            <img src="{{ asset('logo-288.png') }}" alt="PRB Holdings Ltd." width="288" height="288" class="h-16 w-auto">
        </span>
    </a>
@else
    <a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'group inline-flex items-center gap-3']) }} aria-label="PRB Holdings home">
        <span class="relative shrink-0">
            <span class="absolute inset-x-1 bottom-0 h-2 rounded-full bg-brand-500/25 blur-md transition duration-500 group-hover:bg-accent-500/30"></span>
            <img src="{{ asset('logo-288.png') }}" alt="PRB Holdings Ltd." width="288" height="288" class="relative h-11 w-auto transition duration-500 group-hover:-translate-y-0.5">
        </span>
        <span class="leading-none">
            <span class="block font-display text-[1.55rem] font-semibold tracking-tight {{ $light ? 'text-white' : 'text-ink-900' }}">
                PRB <span class="text-accent-500">Holdings</span>
            </span>
            <span class="mt-1.5 block text-[9px] font-extrabold uppercase tracking-[0.42em] {{ $light ? 'text-white/50' : 'text-ink-500' }}">Limited</span>
        </span>
    </a>
@endif