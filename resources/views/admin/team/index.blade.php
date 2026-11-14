@extends('layouts.admin')

@section('title', 'Our Team')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-xs text-ink-500">Team members displayed on the public Our Team page.</p>
        <a href="{{ route('admin.team.create') }}" class="admin-btn admin-btn-primary">
            <x-icon name="plus" class="size-4" /> Add Member
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($members as $member)
            <div class="admin-card flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        @if ($member->image_url)
                            <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="size-12 rounded-xl object-cover ring-2 ring-brand-100">
                        @else
                            <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-brand-700 text-xs font-extrabold text-white">{{ $member->initials }}</span>
                        @endif
                        <div>
                            <p class="text-sm font-extrabold text-ink-900">{{ $member->name }}</p>
                            <p class="text-[10px] text-ink-400">{{ $member->designation ?: 'Team member' }}</p>
                        </div>
                    </div>
                    @if (! $member->is_active)
                        <span class="rounded-full bg-ink-100 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-ink-500">Hidden</span>
                    @endif
                </div>

                <div class="mt-3 flex flex-wrap items-center gap-1.5">
                    <span class="inline-flex rounded-full bg-brand-50 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-brand-800">{{ $member->category_label }}</span>
                    <span class="text-[10px] text-ink-400">Sort {{ $member->sort_order }}</span>
                </div>

                <p class="mt-3 flex-1 text-xs leading-relaxed text-ink-600 line-clamp-3">{{ $member->bio ?: 'No biography added yet.' }}</p>

                <div class="mt-4 flex items-center justify-between border-t border-ink-900/5 pt-3">
                    <span class="truncate text-[10px] font-semibold text-ink-400">{{ $member->email ?: $member->phone ?: 'No contact info' }}</span>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('about.team') }}" target="_blank" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="View page">
                            <x-icon name="eye" class="size-3.5" />
                        </a>
                        <a href="{{ route('admin.team.edit', $member) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                            <x-icon name="edit" class="size-3.5" />
                        </a>
                        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Delete this team member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="grid size-8 place-items-center rounded-lg border border-accent-500/15 text-accent-500 transition hover:bg-accent-50" title="Delete">
                                <x-icon name="trash" class="size-3.5" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-ink-900/15 bg-white px-6 py-16 text-center">
                <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="users" class="size-5" /></span>
                <p class="mt-3 text-sm font-semibold text-ink-600">No team members yet</p>
                <a href="{{ route('admin.team.create') }}" class="admin-btn admin-btn-primary mt-4">Add the first member</a>
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $members->links() }}</div>
@endsection
