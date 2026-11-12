@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.messages.index') }}" class="admin-btn {{ $filter === 'unread' ? 'admin-btn-light' : 'admin-btn-primary' }}">All</a>
            <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="admin-btn {{ $filter === 'unread' ? 'admin-btn-primary' : 'admin-btn-light' }}">
                Unread
                @if ($unreadCount > 0)
                    <span class="grid min-w-5 place-items-center rounded-full {{ $filter === 'unread' ? 'bg-white/20 text-white' : 'bg-accent-600 text-white' }} px-1.5 py-0.5 text-[9px] font-extrabold">{{ $unreadCount }}</span>
                @endif
            </a>
        </div>
        <p class="text-xs text-ink-400">{{ $messages->total() }} {{ Str::plural('enquiry', $messages->total()) }}</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
        <div class="divide-y divide-ink-900/5">
            @forelse ($messages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="flex flex-col gap-3 px-5 py-4 transition hover:bg-ink-50/60 sm:flex-row sm:items-center sm:gap-4">
                    <span class="grid size-10 shrink-0 place-items-center rounded-full {{ $message->is_read ? 'bg-ink-100 text-ink-500' : 'bg-brand-700 text-white shadow-lg shadow-brand-900/15' }}">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </span>

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm font-extrabold {{ $message->is_read ? 'text-ink-700' : 'text-ink-900' }}">{{ $message->name }}</p>
                            @if (! $message->is_read)
                                <span class="rounded-full bg-accent-500/10 px-2 py-0.5 text-[8px] font-extrabold uppercase tracking-[0.16em] text-accent-600">New</span>
                            @endif
                            @if ($message->project)
                                <span class="rounded-full bg-brand-50 px-2 py-0.5 text-[9px] font-bold text-brand-700">{{ $message->project->name }}</span>
                            @endif
                        </div>
                        <p class="mt-0.5 truncate text-xs text-ink-500">{{ $message->subject ?: Str::limit($message->message, 90) }}</p>
                    </div>

                    <div class="flex shrink-0 items-center gap-4 text-[10px] text-ink-400">
                        <span class="hidden sm:inline">{{ $message->phone }}</span>
                        <span>{{ $message->created_at->diffForHumans() }}</span>
                        <x-icon name="chevron-right" class="size-4" />
                    </div>
                </a>
            @empty
                <div class="px-5 py-16 text-center">
                    <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="mail" class="size-5" /></span>
                    <p class="mt-3 text-sm font-semibold text-ink-600">{{ $filter === 'unread' ? 'No unread enquiries' : 'No enquiries yet' }}</p>
                    <p class="mt-1 text-xs text-ink-400">New website enquiries will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-5">{{ $messages->links() }}</div>
@endsection