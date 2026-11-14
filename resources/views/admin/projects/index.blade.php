@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form action="{{ route('admin.projects.index') }}" method="GET" class="relative w-full sm:max-w-xs">
            <span class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400"><x-icon name="search" class="size-4" /></span>
            <input type="search" name="q" value="{{ $search }}" placeholder="Search projects..." class="admin-input pl-10">
        </form>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-light">Reset</a>
            <a href="{{ route('admin.projects.create') }}" class="admin-btn admin-btn-primary">
                <x-icon name="plus" class="size-4" /> Add Project
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-ink-900/5 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-190 text-left text-sm">
                <thead class="border-b border-ink-900/5 bg-ink-50/70">
                    <tr class="text-[9px] font-extrabold uppercase tracking-[0.18em] text-ink-400">
                        <th class="px-5 py-3.5">Project</th>
                        <th class="px-4 py-3.5">Location</th>
                        <th class="px-4 py-3.5">Status</th>
                        <th class="px-4 py-3.5">Featured</th>
                        <th class="px-4 py-3.5">Updated</th>
                        <th class="px-5 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-900/5">
                    @forelse ($projects as $project)
                        <tr class="transition hover:bg-ink-50/50">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $project->cover_image_url }}" alt="{{ $project->name }}" class="size-11 rounded-xl object-cover">
                                    <div class="min-w-0">
                                        <p class="truncate text-xs font-extrabold text-ink-900">{{ $project->name }}</p>
                                        <p class="mt-0.5 text-[10px] text-ink-400">{{ $project->total_apartments ? $project->total_apartments.' apartments' : 'Details pending' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3.5 text-xs text-ink-600">{{ $project->location }}</td>
                            <td class="px-4 py-3.5">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide ring-1 {{ $project->status_class }}">{{ $project->status_label }}</span>
                                @if (! $project->is_active)
                                    <span class="ml-1 inline-flex rounded-full bg-ink-100 px-2.5 py-1 text-[9px] font-extrabold uppercase tracking-wide text-ink-500">Hidden</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5">
                                @if ($project->is_featured)
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-gold-700"><x-icon name="star" class="size-3.5 text-gold-500" /> Featured</span>
                                @else
                                    <span class="text-[10px] text-ink-400">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-[11px] text-ink-400">{{ $project->updated_at->format('d M Y') }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('projects.show', $project) }}" target="_blank" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="View">
                                        <x-icon name="eye" class="size-3.5" />
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="grid size-8 place-items-center rounded-lg border border-ink-900/10 text-ink-500 transition hover:text-brand-700" title="Edit">
                                        <x-icon name="edit" class="size-3.5" />
                                    </a>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project? This cannot be undone.');">
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
                            <td colspan="6" class="px-5 py-16 text-center">
                                <span class="mx-auto grid size-12 place-items-center rounded-full bg-ink-50 text-ink-400"><x-icon name="building" class="size-5" /></span>
                                <p class="mt-3 text-sm font-semibold text-ink-600">No projects found</p>
                                <a href="{{ route('admin.projects.create') }}" class="admin-btn admin-btn-primary mt-4">Create your first project</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $projects->links() }}</div>
@endsection