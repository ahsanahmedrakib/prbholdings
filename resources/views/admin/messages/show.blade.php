@extends('layouts.admin')

@section('title', 'Enquiry Details')

@section('content')
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to enquiries
        </a>
        <div class="flex items-center gap-2">
            @if ($message->email)
                <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: '.($message->subject ?: 'Your enquiry to PRB Holdings')) }}" class="admin-btn admin-btn-primary">
                    <x-icon name="mail" class="size-4" /> Reply by Email
                </a>
            @endif
            <a href="{{ whatsapp_url($message->phone, 'Hello '.$message->name.', thank you for contacting PRB Holdings.') }}" target="_blank" class="admin-btn admin-btn-light">
                <x-icon name="whatsapp" class="size-4" /> WhatsApp
            </a>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
        <div class="admin-card">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-ink-900/5 pb-4">
                <div>
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.22em] text-ink-400">Enquiry from</p>
                    <h2 class="mt-1 font-display text-2xl text-ink-900">{{ $message->name }}</h2>
                </div>
                <span class="rounded-full bg-brand-50 px-3 py-1.5 text-[10px] font-extrabold text-brand-700">{{ $message->created_at->format('d M Y, h:i A') }}</span>
            </div>

            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-4">
                    <p class="admin-label">Phone</p>
                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $message->phone) }}" class="text-sm font-extrabold text-ink-900 transition hover:text-brand-700">{{ $message->phone }}</a>
                </div>
                <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-4">
                    <p class="admin-label">Email</p>
                    @if ($message->email)
                        <a href="mailto:{{ $message->email }}" class="break-all text-sm font-extrabold text-ink-900 transition hover:text-brand-700">{{ $message->email }}</a>
                    @else
                        <p class="text-sm text-ink-400">Not provided</p>
                    @endif
                </div>
                <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-4">
                    <p class="admin-label">Subject</p>
                    <p class="text-sm font-semibold text-ink-800">{{ $message->subject ?: 'General enquiry' }}</p>
                </div>
                <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-4">
                    <p class="admin-label">Interested project</p>
                    @if ($message->project)
                        <a href="{{ route('admin.projects.edit', $message->project) }}" class="text-sm font-semibold text-brand-700 transition hover:text-accent-600">{{ $message->project->name }}</a>
                    @else
                        <p class="text-sm text-ink-400">Not specified</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <p class="admin-label">Message</p>
                <div class="rounded-2xl border border-ink-900/5 bg-ink-50/50 p-5 text-sm leading-relaxed text-ink-700">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="admin-card">
                <h2 class="text-sm font-extrabold text-ink-900">Quick Actions</h2>
                <div class="mt-4 space-y-2">
                    @if ($message->email)
                        <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: '.($message->subject ?: 'Your enquiry to PRB Holdings')) }}" class="admin-btn admin-btn-primary w-full py-3">
                            <x-icon name="mail" class="size-4" /> Reply by Email
                        </a>
                    @endif
                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $message->phone) }}" class="admin-btn admin-btn-light w-full py-3">
                        <x-icon name="phone" class="size-4" /> Call {{ $message->phone }}
                    </a>
                    <a href="{{ whatsapp_url($message->phone, 'Hello '.$message->name.', thank you for contacting PRB Holdings.') }}" target="_blank" class="admin-btn admin-btn-light w-full py-3">
                        <x-icon name="whatsapp" class="size-4" /> Message on WhatsApp
                    </a>
                </div>

                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this enquiry permanently?');" class="mt-4 border-t border-ink-900/5 pt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn admin-btn-danger w-full py-3"><x-icon name="trash" class="size-4" /> Delete Enquiry</button>
                </form>
            </div>

            <div class="rounded-2xl border border-brand-600/15 bg-brand-50 p-4">
                <p class="flex items-center gap-2 text-xs font-extrabold text-brand-900"><x-icon name="check" class="size-4" /> Marked as read</p>
                <p class="mt-1.5 text-[10px] leading-relaxed text-brand-800/70">This enquiry is now marked as read. The unread counter has been updated.</p>
            </div>
        </div>
    </div>
@endsection