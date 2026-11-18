<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | PRB Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400..700&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-ink-50 font-sans text-ink-800 antialiased">
    <div x-data="{ sidebar: false }" class="min-h-screen lg:flex">
        <div x-show="sidebar" x-cloak x-transition.opacity
            class="fixed inset-0 z-40 bg-ink-950/60 backdrop-blur-sm lg:hidden" @click="sidebar = false"></div>

        <aside x-cloak :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
            class="admin-scroll admin-sidebar fixed inset-y-0 left-0 z-50 flex w-72 flex-col overflow-y-auto bg-ink-950 text-white transition-transform duration-300 lg:static lg:translate-x-0">
            <div class="flex items-center justify-between border-b border-white/10 px-5 py-5">
                <x-logo :light="true" class="scale-90 origin-left" />
                <button type="button" @click="sidebar = false"
                    class="grid size-9 place-items-center rounded-full bg-white/10 text-white lg:hidden"
                    aria-label="Close menu">
                    <x-icon name="close" class="size-4" />
                </button>
            </div>

            <nav class="flex-1 space-y-1 px-3 py-5" aria-label="Admin navigation">
                <p class="px-3 pb-2 text-[9px] font-extrabold uppercase tracking-[0.28em] text-white/30">Overview</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="dashboard" class="size-4" /> Dashboard
                </a>

                <p class="px-3 pb-2 pt-5 text-[9px] font-extrabold uppercase tracking-[0.28em] text-white/30">Content
                </p>
                <a href="{{ route('admin.projects.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.projects.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="building" class="size-4" /> Projects
                </a>
                <a href="{{ route('admin.hero-slides.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.hero-slides.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="image" class="size-4" /> Hero Slides
                </a>
                <a href="{{ route('admin.gallery.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.gallery.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="image" class="size-4" /> Gallery
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="quote" class="size-4" /> Testimonials
                </a>
                <a href="{{ route('admin.amenities.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.amenities.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="sparkles" class="size-4" /> Amenities
                </a>
                <a href="{{ route('admin.team.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.team.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="users" class="size-4" /> Our Team
                </a>

                <p class="px-3 pb-2 pt-5 text-[9px] font-extrabold uppercase tracking-[0.28em] text-white/30">
                    Communication</p>
                <a href="{{ route('admin.messages.index') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.messages.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="mail" class="size-4" /> Enquiries
                    @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if ($unread > 0)
                        <span
                            class="ml-auto grid min-w-5 place-items-center rounded-full bg-accent-600 px-1.5 py-0.5 text-[10px] font-extrabold text-white">{{ $unread }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.settings.edit') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.settings.*') ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="settings" class="size-4" /> Site Settings
                </a>
            </nav>

            <div class="border-t border-white/10 p-3">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-white/50 transition hover:bg-white/5 hover:text-white">
                    <x-icon name="arrow-up-right" class="size-4" /> View Website
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-white/50 transition hover:bg-accent-600/20 hover:text-accent-300">
                        <x-icon name="logout" class="size-4" /> Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 border-b border-ink-900/5 bg-white/90 backdrop-blur">
                <div class="flex flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="sidebar = true"
                            class="grid size-10 place-items-center rounded-xl border border-ink-900/10 bg-white text-ink-700 lg:hidden"
                            aria-label="Open menu">
                            <x-icon name="menu" class="size-5" />
                        </button>
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.28em] text-ink-400">PRB Holdings
                            </p>
                            <h1 class="mt-1 font-display text-2xl font-medium text-ink-900">@yield('title', 'Dashboard')</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" target="_blank"
                            class="hidden items-center gap-2 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-xs font-bold text-ink-600 transition hover:text-brand-800 sm:flex">
                            <x-icon name="arrow-up-right" class="size-3.5" /> Live Site
                        </a>
                        <div class="flex items-center gap-2.5 rounded-full bg-ink-50 py-1.5 pl-1.5 pr-4">
                            <span
                                class="grid size-8 place-items-center rounded-full bg-brand-700 text-xs font-extrabold text-white">{{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}</span>
                            <div class="leading-tight">
                                <p class="text-[10px] font-extrabold text-ink-900">{{ auth('admin')->user()->name }}
                                </p>
                                <p class="text-[9px] text-ink-400">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                @if (session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show" x-cloak x-transition
                        class="mb-5 flex items-start gap-3 rounded-2xl border border-brand-600/20 bg-brand-50 px-4 py-3.5 text-sm font-semibold text-brand-900">
                        <x-icon name="check" class="mt-0.5 size-4 shrink-0 text-brand-700" />
                        <span class="flex-1">{{ session('success') }}</span>
                        <button type="button" @click="show = false"
                            class="text-brand-700/50 transition hover:text-brand-800"><x-icon name="close"
                                class="size-4" /></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="mb-5 rounded-2xl border border-accent-500/20 bg-accent-50 px-4 py-3.5 text-sm text-accent-800">
                        <p class="flex items-center gap-2 font-extrabold"><x-icon name="close" class="size-4" />
                            Please fix the following:</p>
                        <ul class="mt-2 list-inside list-disc space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="border-t border-ink-900/5 px-4 py-4 text-center text-[11px] text-ink-400 sm:px-6 lg:px-8">
                PRB Holdings admin · {{ date('Y') }}
            </footer>
        </div>
    </div>

    <div data-admin-loading hidden class="fixed inset-0 z-70 bg-ink-50 lg:left-72" aria-hidden="true">
        <div class="flex h-full">
            <div class="flex min-w-0 flex-1 flex-col">
                <div class="border-b border-ink-900/5 bg-white px-4 py-4 sm:px-6 lg:px-8">
                    <div class="skeleton h-3 w-24 rounded"></div>
                    <div class="skeleton mt-3 h-6 w-44 rounded-lg"></div>
                </div>

                <div class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                                <div class="skeleton size-10 rounded-xl"></div>
                                <div class="skeleton mt-5 h-8 w-16 rounded-lg"></div>
                                <div class="skeleton mt-2 h-3 w-24 rounded"></div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-6 grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
                        <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                            <div class="skeleton h-4 w-36 rounded"></div>
                            <div class="mt-5 space-y-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="flex items-center gap-3">
                                        <div class="skeleton size-9 shrink-0 rounded-full"></div>
                                        <div class="flex-1 space-y-2">
                                            <div class="skeleton h-3 w-1/3 rounded"></div>
                                            <div class="skeleton h-3 w-2/3 rounded"></div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                                <div class="skeleton h-4 w-28 rounded"></div>
                                <div class="mt-4 grid grid-cols-2 gap-2">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="skeleton h-20 rounded-xl"></div>
                                    @endfor
                                </div>
                            </div>
                            <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                                <div class="skeleton h-4 w-32 rounded"></div>
                                <div class="mt-4 space-y-3">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="skeleton h-12 rounded-xl"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
