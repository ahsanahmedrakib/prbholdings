<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('meta_title', 'PRB Holdings'))</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description'))">
    <meta name="theme-color" content="#007048">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', setting('meta_title', 'PRB Holdings'))">
    <meta property="og:description" content="@yield('meta_description', setting('meta_description'))">
    <meta property="og:image" content="{{ media_url(setting('og_image'), 'uploads/projects/shirin-garden/hero.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..700;1,9..144,300..700&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="min-h-screen overflow-x-hidden bg-cream font-sans text-ink-800 antialiased">
    <div data-scroll-progress class="fixed inset-x-0 top-0 z-[70] h-0.5 origin-left bg-accent-600" style="width: 0">
    </div>

    @include('partials.header')

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show" x-transition.opacity.duration.500ms x-cloak
            class="fixed right-4 top-24 z-[80] w-[calc(100%-2rem)] max-w-sm" role="status">
            <div
                class="flex items-start gap-3 rounded-2xl border border-brand-600/20 bg-white p-4 shadow-2xl shadow-brand-900/15">
                <span class="grid size-9 shrink-0 place-items-center rounded-full bg-brand-700 text-white">
                    <x-icon name="check" class="size-4" />
                </span>
                <div class="flex-1 text-sm font-semibold text-ink-800">{{ session('success') }}</div>
                <button type="button" @click="show = false" class="text-ink-400 transition hover:text-ink-900"
                    aria-label="Dismiss">
                    <x-icon name="close" class="size-4" />
                </button>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.floating-actions')

    <div class="lightbox" data-lightbox-modal aria-hidden="true">
        <button type="button" data-lightbox-close
            class="absolute right-5 top-5 grid size-11 place-items-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur transition hover:bg-white/20"
            aria-label="Close image">
            <x-icon name="close" class="size-5" />
        </button>
        <img data-lightbox-image src="" alt="">
    </div>

    @stack('scripts')
</body>

</html>
