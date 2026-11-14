@php
    $footerProjects = \App\Models\Project::query()->active()->orderBy('sort_order')->take(4)->get();
    $phone = setting('phone', '01550 - 028550');
    $phoneLink = setting('phone_link', '+8801550028550');
    $email = setting('email', 'info@prbholdingsbd.com');
@endphp

<footer class="relative overflow-hidden bg-ink-950 text-white">
    <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
    <div class="section-blob -left-32 top-0 size-64 bg-brand-700/20"></div>
    <div class="section-blob -right-24 bottom-0 size-60 bg-accent-700/15"></div>

    <div class="relative">
        <div
            class="container-x grid gap-8 py-8 md:grid-cols-2 lg:grid-cols-[1.35fr_0.7fr_0.9fr_1.05fr] lg:gap-10 lg:py-8">
            <div>
                <x-logo :full="true" />
                <p class="mt-5 max-w-sm text-[13px] leading-relaxed text-white/55">
                    {{ setting('footer_about') }}
                </p>
                <div class="mt-5 flex items-center gap-2">
                    @foreach (['facebook', 'instagram', 'linkedin', 'youtube'] as $social)
                        <a href="{{ setting($social, '#') }}" target="_blank" rel="noopener"
                            aria-label="{{ ucfirst($social) }}"
                            class="grid size-8 place-items-center rounded-full border border-white/10 bg-white/5 text-white/65 transition duration-300 hover:-translate-y-0.5 hover:border-accent-400/40 hover:bg-accent-500/10 hover:text-white">
                            <x-icon :name="$social" class="size-3.5" />
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-brand-300">Explore</h3>
                <ul class="mt-4 space-y-2 text-[13px]">
                    <li><a href="{{ route('home') }}" class="text-white/55 transition hover:text-white">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white/55 transition hover:text-white">About PRB</a>
                    </li>
                    <li><a href="{{ route('about.team') }}" class="text-white/55 transition hover:text-white">Our
                            Team</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-white/55 transition hover:text-white">All
                            Projects</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-white/55 transition hover:text-white">Gallery</a>
                    </li>
                    <li><a href="{{ route('about.privacy') }}" class="text-white/55 transition hover:text-white">Privacy
                            Policy</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/55 transition hover:text-white">Contact
                            Us</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-brand-300">Our Projects</h3>
                <ul class="mt-4 space-y-2 text-[13px]">
                    @foreach ($footerProjects as $footerProject)
                        <li>
                            <a href="{{ route('projects.show', $footerProject) }}"
                                class="text-white/55 transition hover:text-white">
                                {{ $footerProject->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-brand-300">Get in Touch</h3>
                <ul class="mt-4 space-y-3 text-[13px]">
                    <li class="flex items-start gap-2.5">
                        <x-icon name="pin" class="mt-0.5 size-4 shrink-0 text-accent-400" />
                        <span class="leading-relaxed text-white/55">{{ setting('address') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <x-icon name="phone" class="size-4 shrink-0 text-accent-400" />
                        <a href="tel:{{ $phoneLink }}"
                            class="text-white/55 transition hover:text-white">{{ $phone }}</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <x-icon name="mail" class="size-4 shrink-0 text-accent-400" />
                        <a href="mailto:{{ $email }}"
                            class="text-white/55 transition hover:text-white">{{ $email }}</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <x-icon name="clock" class="size-4 shrink-0 text-accent-400" />
                        <span class="text-white/55">{{ setting('office_hours') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10">
            <div
                class="container-x flex flex-col gap-2 py-4 text-md text-white/35 sm:flex-row sm:items-center sm:justify-between">
                <p>{{ setting('copyright') }}</p>
                <p class="sm:text-right">Design & Developed by <a href="https://bct.com.bd" target="_blank"
                        rel="noopener" class="text-white/55 hover:text-white underline">Bismillah Computer & Technology</a></p>
            </div>
        </div>
    </div>
</footer>
