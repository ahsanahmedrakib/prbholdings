@extends('layouts.admin')

@section('title', $member->exists ? 'Edit Team Member' : 'New Team Member')

@section('content')
    <div class="mb-5">
        <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to team
        </a>
    </div>

    <form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($member->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
            <div class="space-y-6">
                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Member Details</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Name, role and team shown on the public team page.</p>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="name">Full name *</label>
                            <input class="admin-input" type="text" id="name" name="name" value="{{ old('name', $member->name) }}" placeholder="e.g. Aminur Rashid" required>
                        </div>

                        <div>
                            <label class="admin-label" for="designation">Designation</label>
                            <input class="admin-input" type="text" id="designation" name="designation" value="{{ old('designation', $member->designation) }}" placeholder="e.g. Chairman & CEO">
                        </div>

                        <div>
                            <label class="admin-label" for="category">Team *</label>
                            <select class="admin-input" id="category" name="category" required>
                                @foreach ($categories as $value => $label)
                                    <option value="{{ $value }}" @selected(old('category', $member->category) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="admin-label" for="email">Email</label>
                            <input class="admin-input" type="email" id="email" name="email" value="{{ old('email', $member->email) }}" placeholder="name@prbholdingsbd.com">
                        </div>

                        <div>
                            <label class="admin-label" for="phone">Phone</label>
                            <input class="admin-input" type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" placeholder="+880...">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="admin-label" for="linkedin">LinkedIn URL</label>
                            <input class="admin-input" type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $member->linkedin) }}" placeholder="https://www.linkedin.com/in/...">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="admin-label" for="bio">Biography</label>
                            <textarea class="admin-input min-h-40 resize-y" id="bio" name="bio" placeholder="A short professional biography...">{{ old('bio', $member->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Photo</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Portrait photos work best (recommended 800×960px or larger).</p>

                    <div class="mt-4 flex flex-wrap items-center gap-4">
                        @if ($member->image_url)
                            <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="size-24 rounded-2xl object-cover ring-2 ring-brand-100">
                        @else
                            <span class="grid size-24 place-items-center rounded-2xl bg-brand-700 text-lg font-extrabold text-white">{{ $member->initials ?: 'PRB' }}</span>
                        @endif

                        <div class="min-w-56 flex-1">
                            <label class="admin-label" for="image_file">Upload photo</label>
                            <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="image_file" name="image_file" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="admin-card xl:sticky xl:top-24">
                    <h2 class="text-sm font-extrabold text-ink-900">Publish</h2>

                    <div class="mt-4 space-y-3">
                        <label class="flex items-start gap-3 rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                            <input type="checkbox" name="is_active" value="1" class="mt-0.5 size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $member->exists ? $member->is_active : true))>
                            <span>
                                <span class="block text-xs font-extrabold text-ink-800">Active / Visible</span>
                                <span class="mt-0.5 block text-[10px] leading-relaxed text-ink-400">Show this member on the website.</span>
                            </span>
                        </label>

                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}">
                        </div>
                    </div>

                    <div class="mt-5 space-y-2">
                        <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                            <x-icon name="check" class="size-4" /> {{ $member->exists ? 'Save Changes' : 'Create Member' }}
                        </button>
                        <a href="{{ route('admin.team.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($member->exists)
        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Delete this team member? This cannot be undone.');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger">
                <x-icon name="trash" class="size-4" /> Delete Member
            </button>
        </form>
    @endif
@endsection
