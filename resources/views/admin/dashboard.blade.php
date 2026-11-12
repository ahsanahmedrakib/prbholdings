@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="relative overflow-hidden rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                <div class="absolute -right-6 -top-6 size-20 rounded-full bg-brand-50"></div>
                <span class="relative grid size-10 place-items-center rounded-xl bg-brand-700 text-white">
                    <x-icon :name="$stat['icon']" class="size-5" />
                </span>
                <p class="relative mt-5 font-display text-3xl font-medium text-ink-900">{{ $stat['value'] }}</p>
                <p class="relative mt-1 text-[10px] font-extrabold uppercase tracking-[0.2em] text-ink-400">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
        <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-ink-900/5 px-5 py-4">
                <div>
                    <h2 class="text-sm font-extrabold text-ink-900">Recent Enquiries</h2>
                    <p class="mt-0.5 text-[11px] text-ink-400">Latest messages from the website</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-[11px] font-extrabold text-brand-700 transition hover:text-accent-600">
                    View all <x-icon name="arrow-right" class="size-3.5" />
                </a>
            </div>

            @if ($recentMessages->isEmpty())
                <div class="px-5 py-12 text-center">
                    <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="mail" class="size-5" /></span>
                    <p class="mt-4 text-sm font-semibold text-ink-600">No enquiries yet</p>
                    <p class="mt-1 text-xs text-ink-400">New messages from the contact forms will appear here.</p>
                </div>
            @else
                <div class="divide-y divide-ink-900/5">
                    @foreach ($recentMessages as $message)
                        <a href="{{ route('admin.messages.show', $message) }}" class="flex items-start gap-3 px-5 py-4 transition hover:bg-ink-50/70">
                            <span class="mt-0.5 grid size-9 shrink-0 place-items-center rounded-full {{ $message->is_read ? 'bg-ink-100 text-ink-500' : 'bg-accent-100 text-accent-700' }}">
                                <x-icon name="mail" class="size-4" />
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="truncate text-sm font-extrabold text-ink-900">{{ $message->name }}</p>
                                    @if (! $message->is_read)
                                        <span class="rounded-full bg-accent-100 px-2 py-0.5 text-[9px] font-extrabold uppercase tracking-wide text-accent-700">New</span>
                                    @endif
                                </div>
                                <p class="mt-0.5 truncate text-xs text-ink-500">{{ $message->subject ?: 'General enquiry' }}@if ($message->project) · {{ $message->project->name }}@endif</p>
                                <p class="mt-1 line-clamp-1 text-[11px] text-ink-400">{{ $message->message }}</p>
                            </div>
                            <span class="shrink-0 text-[10px] text-ink-400">{{ $message->created_at->diffForHumans() }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-extrabold text-ink-900">Quick Actions</h2>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <a href="{{ route('admin.projects.create') }}" class="flex flex-col gap-2 rounded-xl border border-ink-900/5 bg-ink-50 p-4 transition hover:border-brand-700/20 hover:bg-brand-50">
                        <span class="grid size-8 place-items-center rounded-lg bg-white text-brand-700 shadow-sm"><x-icon name="plus" class="size-4" /></span>
                        <span class="text-xs font-bold text-ink-700">Add Project</span>
                    </a>
                    <a href="{{ route('admin.hero-slides.create') }}" class="flex flex-col gap-2 rounded-xl border border-ink-900/5 bg-ink-50 p-4 transition hover:border-brand-700/20 hover:bg-brand-50">
                        <span class="grid size-8 place-items-center rounded-lg bg-white text-brand-700 shadow-sm"><x-icon name="image" class="size-4" /></span>
                        <span class="text-xs font-bold text-ink-700">Add Slide</span>
                    </a>
                    <a href="{{ route('admin.testimonials.create') }}" class="flex flex-col gap-2 rounded-xl border border-ink-900/5 bg-ink-50 p-4 transition hover:border-brand-700/20 hover:bg-brand-50">
                        <span class="grid size-8 place-items-center rounded-lg bg-white text-brand-700 shadow-sm"><x-icon name="quote" class="size-4" /></span>
                        <span class="text-xs font-bold text-ink-700">Add Review</span>
                    </a>
                    <a href="{{ route('admin.settings.edit') }}" class="flex flex-col gap-2 rounded-xl border border-ink-900/5 bg-ink-50 p-4 transition hover:border-brand-700/20 hover:bg-brand-50">
                        <span class="grid size-8 place-items-center rounded-lg bg-white text-brand-700 shadow-sm"><x-icon name="settings" class="size-4" /></span>
                        <span class="text-xs font-bold text-ink-700">Edit Settings</span>
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-extrabold text-ink-900">Recently Updated</h2>
                <div class="mt-4 space-y-3">
                    @forelse ($recentProjects as $project)
                        <a href="{{ route('admin.projects.edit', $project) }}" class="flex items-center gap-3 rounded-xl border border-ink-900/5 p-2.5 transition hover:bg-ink-50">
                            <img src="{{ $project->cover_image_url }}" alt="{{ $project->name }}" class="size-10 rounded-lg object-cover">
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-xs font-extrabold text-ink-900">{{ $project->name }}</p>
                                <p class="text-[10px] text-ink-400">{{ $project->status_label }} · {{ $project->updated_at->diffForHumans() }}</p>
                            </div>
                            <x-icon name="chevron-right" class="size-4 text-ink-300" />
                        </a>
                    @empty
                        <p class="text-xs text-ink-400">No projects yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-ink-950 p-4 text-white">
                    <p class="font-display text-2xl text-gold-300">{{ $counts['testimonials'] }}</p>
                    <p class="mt-1 text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/40">Testimonials</p>
                </div>
                <div class="rounded-2xl bg-brand-700 p-4 text-white">
                    <p class="font-display text-2xl text-gold-200">{{ $counts['amenities'] }}</p>
                    <p class="mt-1 text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/50">Amenities</p>
                </div>
            </div>
        </div>
    </div>
@endsection