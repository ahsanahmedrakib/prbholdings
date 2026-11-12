@php
    $phone = setting('phone', '01550 - 028550');
    $phoneLink = setting('phone_link', '+8801550028550');
    $email = setting('email', 'info@prbholdingsbd.com');
@endphp

<div class="bg-ink-950 text-white">
    <div class="container-x flex h-10 items-center justify-between gap-4 text-[11px] font-medium text-white/70">
        <div class="flex items-center gap-5">
            <a href="tel:{{ $phoneLink }}" class="flex items-center gap-2 transition hover:text-gold-300">
                <x-icon name="phone" class="size-3.5 text-gold-400" />
                <span>{{ $phone }}</span>
            </a>
            <a href="mailto:{{ $email }}" class="hidden items-center gap-2 transition hover:text-gold-300 sm:flex">
                <x-icon name="mail" class="size-3.5 text-gold-400" />
                <span>{{ $email }}</span>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <span class="hidden items-center gap-2 lg:flex">
                <x-icon name="pin" class="size-3.5 text-gold-400" />
                {{ setting('address') }}
            </span>
            <span class="hidden h-3 w-px bg-white/20 lg:block"></span>
            <div class="flex items-center gap-2.5">
                <a href="{{ setting('facebook', '#') }}" target="_blank" rel="noopener" class="transition hover:text-gold-300" aria-label="Facebook"><x-icon name="facebook" class="size-3.5" /></a>
                <a href="{{ setting('instagram', '#') }}" target="_blank" rel="noopener" class="transition hover:text-gold-300" aria-label="Instagram"><x-icon name="instagram" class="size-3.5" /></a>
                <a href="{{ setting('linkedin', '#') }}" target="_blank" rel="noopener" class="transition hover:text-gold-300" aria-label="LinkedIn"><x-icon name="linkedin" class="size-3.5" /></a>
                <a href="{{ setting('youtube', '#') }}" target="_blank" rel="noopener" class="transition hover:text-gold-300" aria-label="YouTube"><x-icon name="youtube" class="size-3.5" /></a>
            </div>
        </div>
    </div>
</div>

<header data-site-header class="site-header sticky top-0 z-50 border-b border-ink-900/5 bg-cream/95">
    <div class="container-x header-inner flex items-center justify-between gap-6 py-4">
        <x-logo class="relative z-10" />

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Main navigation">
            <a href="{{ route('home') }}" class="link-underline text-sm font-bold {{ request()->routeIs('home') ? 'is-active text-brand-800' : 'text-ink-700 hover:text-brand-800' }}">Home</a>
            <a href="{{ route('about') }}" class="link-underline text-sm font-bold {{ request()->routeIs('about') ? 'is-active text-brand-800' : 'text-ink-700 hover:text-brand-800' }}">About</a>

            <div class="group relative">
                <a href="{{ route('projects.index') }}" class="link-underline inline-flex items-center gap-1.5 text-sm font-bold {{ request()->routeIs('projects.*') ? 'is-active text-brand-800' : 'text-ink-700 hover:text-brand-800' }}">
                    Projects
                    <x-icon name="chevron-down" class="size-3.5 transition duration-300 group-hover:rotate-180" />
                </a>
                <div class="invisible absolute left-1/2 top-full z-20 w-64 -translate-x-1/2 translate-y-3 pt-5 opacity-0 transition duration-300 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                    <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white p-2 shadow-2xl shadow-ink-950/10">
                        <a href="{{ route('projects.index') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-ink-700 transition hover:bg-brand-50 hover:text-brand-800">
                            All Projects <span class="text-xs text-ink-400">{{ \App\Models\Project::active()->count() }}</span>
                        </a>
                        <a href="{{ route('projects.index', ['status' => 'ongoing']) }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-ink-700 transition hover:bg-brand-50 hover:text-brand-800">
                            Ongoing <span class="text-xs text-ink-400">{{ \App\Models\Project::active()->where('status', 'ongoing')->count() }}</span>
                        </a>
                        <a href="{{ route('projects.index', ['status' => 'upcoming']) }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-ink-700 transition hover:bg-brand-50 hover:text-brand-800">
                            Upcoming <span class="text-xs text-ink-400">{{ \App\Models\Project::active()->where('status', 'upcoming')->count() }}</span>
                        </a>
                        <a href="{{ route('projects.index', ['status' => 'completed']) }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-ink-700 transition hover:bg-brand-50 hover:text-brand-800">
                            Handed Over <span class="text-xs text-ink-400">{{ \App\Models\Project::active()->where('status', 'completed')->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('gallery') }}" class="link-underline text-sm font-bold {{ request()->routeIs('gallery') ? 'is-active text-brand-800' : 'text-ink-700 hover:text-brand-800' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="link-underline text-sm font-bold {{ request()->routeIs('contact') ? 'is-active text-brand-800' : 'text-ink-700 hover:text-brand-800' }}">Contact</a>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="tel:{{ $phoneLink }}" class="group flex items-center gap-3 rounded-full border border-ink-900/10 bg-white px-4 py-2.5 transition hover:border-brand-700/30 hover:shadow-md">
                <span class="grid size-8 place-items-center rounded-full bg-brand-50 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                    <x-icon name="phone" class="size-3.5" />
                </span>
                <span class="leading-tight">
                    <span class="block text-[9px] font-extrabold uppercase tracking-[0.2em] text-ink-400">Hotline</span>
                    <span class="block text-xs font-extrabold text-ink-900">{{ $phone }}</span>
                </span>
            </a>
            <a href="{{ route('contact') }}" class="btn-accent btn-shine px-5 py-3 text-xs">
                Book a Visit
                <x-icon name="arrow-up-right" class="size-4" />
            </a>
        </div>

        <div class="flex items-center gap-2 lg:hidden" x-data="{ open: false }">
            <a href="tel:{{ $phoneLink }}" class="grid size-10 place-items-center rounded-full bg-brand-700 text-white" aria-label="Call PRB Holdings">
                <x-icon name="phone" class="size-4" />
            </a>
            <button type="button" @click="open = !open" class="grid size-10 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-900" :aria-expanded="open" aria-label="Toggle menu">
                <x-icon name="menu" class="size-5" x-show="!open" />
                <x-icon name="close" class="size-5" x-show="open" x-cloak />
            </button>

            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-3"
                @click.outside="open = false"
                class="absolute inset-x-3 top-full z-50 mt-2 rounded-3xl border border-ink-900/10 bg-white p-4 shadow-2xl shadow-ink-950/15"
            >
                <nav class="flex flex-col" aria-label="Mobile navigation">
                    <a href="{{ route('home') }}" class="rounded-xl px-4 py-3 text-sm font-bold text-ink-800 transition hover:bg-brand-50 hover:text-brand-800">Home</a>
                    <a href="{{ route('about') }}" class="rounded-xl px-4 py-3 text-sm font-bold text-ink-800 transition hover:bg-brand-50 hover:text-brand-800">About</a>
                    <a href="{{ route('projects.index') }}" class="rounded-xl px-4 py-3 text-sm font-bold text-ink-800 transition hover:bg-brand-50 hover:text-brand-800">Projects</a>
                    <div class="ml-3 flex flex-col border-l border-ink-900/10 pl-3">
                        <a href="{{ route('projects.index', ['status' => 'ongoing']) }}" class="rounded-lg px-3 py-2 text-xs font-semibold text-ink-500 transition hover:text-brand-800">Ongoing</a>
                        <a href="{{ route('projects.index', ['status' => 'upcoming']) }}" class="rounded-lg px-3 py-2 text-xs font-semibold text-ink-500 transition hover:text-brand-800">Upcoming</a>
                        <a href="{{ route('projects.index', ['status' => 'completed']) }}" class="rounded-lg px-3 py-2 text-xs font-semibold text-ink-500 transition hover:text-brand-800">Handed Over</a>
                    </div>
                    <a href="{{ route('gallery') }}" class="rounded-xl px-4 py-3 text-sm font-bold text-ink-800 transition hover:bg-brand-50 hover:text-brand-800">Gallery</a>
                    <a href="{{ route('contact') }}" class="rounded-xl px-4 py-3 text-sm font-bold text-ink-800 transition hover:bg-brand-50 hover:text-brand-800">Contact</a>
                </nav>
                <div class="mt-3 grid grid-cols-2 gap-2">
                    <a href="tel:{{ $phoneLink }}" class="btn-outline px-4 py-3 text-xs">Call Now</a>
                    <a href="{{ route('contact') }}" class="btn-accent px-4 py-3 text-xs">Book a Visit</a>
                </div>
            </div>
        </div>
    </div>
</header>