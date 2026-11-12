<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | PRB Holdings</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400..700&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-ink-950 font-sans text-white antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-40"></div>
        <div class="section-blob -left-32 top-0 size-96 bg-brand-600/30"></div>
        <div class="section-blob -right-24 bottom-0 size-96 bg-accent-600/20"></div>

        <div
            class="relative grid w-full max-w-4xl overflow-hidden rounded-4xl border border-white/10 bg-white/4 shadow-2xl shadow-black/40 backdrop-blur-md lg:grid-cols-2">
            <div class="relative hidden overflow-hidden bg-brand-800 p-10 lg:block">
                <div class="pattern-grid absolute inset-0 opacity-35"></div>
                <div class="relative flex h-full flex-col justify-between">
                    <x-logo :light="true" />
                    <div>
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Admin Panel</p>
                        <h1 class="mt-4 font-display text-4xl font-medium leading-tight">Manage your projects, content
                            and enquiries.</h1>
                        <p class="mt-4 text-sm leading-relaxed text-white/55">Everything you need to keep the PRB
                            Holdings website up to date — in one place.</p>
                    </div>
                    <p class="text-[11px] text-white/35">© {{ date('Y') }} PRB Holdings. All rights reserved.</p>
                </div>
            </div>

            <div class="p-7 sm:p-10">
                <div class="mb-8 lg:hidden">
                    <x-logo :light="true" />
                </div>
                <h2 class="font-display text-3xl font-medium">Welcome back.</h2>
                <p class="mt-2 text-sm text-white/50">Sign in to your admin account to continue.</p>

                @if ($errors->any())
                    <div
                        class="mt-6 rounded-2xl border border-accent-500/30 bg-accent-600/15 px-4 py-3 text-xs font-semibold text-accent-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="mt-7 space-y-4">
                    @csrf
                    <div>
                        <label class="field-label text-white/50" for="email">Email address</label>
                        <input class="field-dark" type="email" id="email" name="email"
                            value="{{ old('email') }}" placeholder="admin@prbholdingsbd.com" required autofocus
                            autocomplete="email">
                    </div>
                    <div>
                        <label class="field-label text-white/50" for="password">Password</label>
                        <input class="field-dark" type="password" id="password" name="password" placeholder="••••••••"
                            required autocomplete="current-password">
                    </div>
                    <label class="flex items-center gap-2 text-xs text-white/50">
                        <input type="checkbox" name="remember"
                            class="size-4 rounded border-white/20 bg-white/10 text-brand-600 focus:ring-gold-300">
                        Remember me
                    </label>
                    <button type="submit" class="btn-accent btn-shine w-full">
                        Sign In
                        <x-icon name="arrow-right" class="size-4" />
                    </button>
                </form>

                <a href="{{ route('home') }}"
                    class="mt-6 inline-flex items-center gap-2 text-xs font-semibold text-white/40 transition hover:text-white">
                    <x-icon name="arrow-left" class="size-3.5" /> Back to website
                </a>
            </div>
        </div>
    </div>
</body>

</html>
