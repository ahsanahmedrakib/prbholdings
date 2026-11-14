@extends('layouts.admin')

@section('title', 'Amenities')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-xs text-ink-500">Signature amenities shown on the homepage and project pages.</p>
        <a href="{{ route('admin.amenities.create') }}" class="admin-btn admin-btn-primary">
            <x-icon name="plus" class="size-4" /> Add Amenity
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-160 text-left text-sm">
                <thead class="border-b border-ink-900/5 bg-ink-50/70">
                    <tr class="text-[9px] font-extrabold uppercase tracking-[0.18em] text-ink-400">
                        <th class="px-5 py-3.5">Amenity</th>
                        <th class="px-4 py-3.5">Description</th>
                        <th class="px-4 py-3.5">Order</th>
                        <th class="px-4 py-3.5">Status</th>
                        <th class="px-5 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-900/5">
                    @forelse ($amenities as $amenity)
                        <tr class="transition hover:bg-ink-50/50">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon :name="$amenity->icon" class="size-5" /></span>
                                    <span class="text-xs font-extrabold text-ink-900">{{ $amenity->title }}</span>
                                </div>
                            </td>
                            <td class="max-w-xs px-4 py-3.5 text-xs text-ink-500">{{ Str::limit($amenity->description, 80) ?: '—' }}</td>
                            <td class="px-4 py-3.5 text-xs text-ink-500">{{ $amenity->sort_order }}</td>
                            <td class="px-4 py-3.5">
                                @if ($amenity->is_active)
                                    <span class="inline-flex rounded-full bg-brand-50 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-brand-700 ring-1 ring-brand-500/20">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-ink-100 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-ink-500">Hidden</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.amenities.edit', $amenity) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                                        <x-icon name="edit" class="size-3.5" />
                                    </a>
                                    <form method="POST" action="{{ route('admin.amenities.destroy', $amenity) }}" onsubmit="return confirm('Delete this amenity?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="grid size-8 place-items-center rounded-lg border border-accent-500/15 text-accent-500 transition hover:bg-accent-50" title="Delete">
                                            <x-icon name="trash" class="size-3.5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="sparkles" class="size-5" /></span>
                                <p class="mt-3 text-sm font-semibold text-ink-600">No amenities yet</p>
                                <a href="{{ route('admin.amenities.create') }}" class="admin-btn admin-btn-primary mt-4">Add an amenity</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $amenities->links() }}</div>
@endsection