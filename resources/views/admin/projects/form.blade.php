@extends('layouts.admin')

@section('title', $project->exists ? 'Edit Project' : 'New Project')

@section('content')
    @php
        $galleryImages = $project->exists ? $project->images->where('type', 'gallery') : collect();
        $floorPlans = $project->exists ? $project->images->where('type', 'floor_plan') : collect();
        $typeRows = old('apartment_types', $project->apartment_types ?: [['type' => 'Type A', 'size' => '']]);
    @endphp

    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-ink-500 transition hover:text-brand-800">
            <x-icon name="arrow-left" class="size-4" /> Back to projects
        </a>
        @if ($project->exists)
            <a href="{{ route('projects.show', $project) }}" target="_blank" class="admin-btn admin-btn-light">
                <x-icon name="eye" class="size-4" /> Preview
            </a>
        @endif
    </div>

    <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($project->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_20rem]">
            <div class="space-y-6">
                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Basic Information</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Core details shown across the website.</p>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="name">Project name *</label>
                            <input class="admin-input" type="text" id="name" name="name" value="{{ old('name', $project->name) }}" placeholder="e.g. PRB Shirin Garden" required>
                        </div>

                        <div>
                            <label class="admin-label" for="slug">Slug</label>
                            <input class="admin-input" type="text" id="slug" name="slug" value="{{ old('slug', $project->slug) }}" placeholder="auto-generated">
                            <p class="mt-1 text-[10px] text-ink-400">Leave empty to generate from the name.</p>
                        </div>

                        <div>
                            <label class="admin-label" for="status">Status *</label>
                            <select class="admin-input" id="status" name="status" required>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', $project->status) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="admin-label" for="tagline">Tagline</label>
                            <input class="admin-input" type="text" id="tagline" name="tagline" value="{{ old('tagline', $project->tagline) }}" placeholder="A short, memorable line about the project">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="admin-label" for="location">Location *</label>
                            <input class="admin-input" type="text" id="location" name="location" value="{{ old('location', $project->location) }}" placeholder="Diabari, Uttara, Dhaka-1230" required>
                        </div>

                        <div>
                            <label class="admin-label" for="nature">Nature</label>
                            <input class="admin-input" type="text" id="nature" name="nature" value="{{ old('nature', $project->nature ?: 'Residential') }}">
                        </div>

                        <div>
                            <label class="admin-label" for="floors">Storied</label>
                            <input class="admin-input" type="text" id="floors" name="floors" value="{{ old('floors', $project->floors) }}" placeholder="10 Storied (G+9)">
                        </div>

                        <div>
                            <label class="admin-label" for="land_area">Land area</label>
                            <input class="admin-input" type="text" id="land_area" name="land_area" value="{{ old('land_area', $project->land_area) }}" placeholder="12.50 Katha">
                        </div>

                        <div>
                            <label class="admin-label" for="facing">Facing</label>
                            <input class="admin-input" type="text" id="facing" name="facing" value="{{ old('facing', $project->facing) }}" placeholder="West">
                        </div>

                        <div>
                            <label class="admin-label" for="total_apartments">Total apartments</label>
                            <input class="admin-input" type="number" min="0" id="total_apartments" name="total_apartments" value="{{ old('total_apartments', $project->total_apartments) }}">
                        </div>

                        <div>
                            <label class="admin-label" for="total_lifts">Total lifts</label>
                            <input class="admin-input" type="number" min="0" id="total_lifts" name="total_lifts" value="{{ old('total_lifts', $project->total_lifts) }}">
                        </div>

                        <div>
                            <label class="admin-label" for="handover_year">Handover</label>
                            <input class="admin-input" type="text" id="handover_year" name="handover_year" value="{{ old('handover_year', $project->handover_year) }}" placeholder="e.g. 2026">
                        </div>

                        <div>
                            <label class="admin-label" for="sort_order">Sort order</label>
                            <input class="admin-input" type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}">
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Description</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Use a blank line to separate paragraphs.</p>
                    <textarea class="admin-input mt-4 min-h-40 resize-y" name="description" placeholder="Tell the story of this project...">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Layout & Apartment Details</h2>

                    <div class="mt-4">
                        <div class="flex items-center justify-between">
                            <label class="admin-label mb-0">Apartment types</label>
                            <button type="button" @click="addRow()" class="admin-btn admin-btn-light px-3 py-1.5">
                                <x-icon name="plus" class="size-3.5" /> Add type
                            </button>
                        </div>

                        <div
                            class="mt-3 space-y-2"
                            x-data="{
                                rows: {{ Js::from($typeRows) }},
                                addRow() { this.rows.push({ type: '', size: '' }); },
                                removeRow(index) { this.rows.splice(index, 1); }
                            }"
                        >
                            <template x-for="(row, index) in rows" :key="index">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="'apartment_types[' + index + '][type]'" x-model="row.type" class="admin-input flex-1" placeholder="Type A">
                                    <input type="text" :name="'apartment_types[' + index + '][size]'" x-model="row.size" class="admin-input flex-1" placeholder="1475 Sft.">
                                    <button type="button" @click="removeRow(index)" class="grid size-9 shrink-0 place-items-center rounded-lg border border-accent-500/15 text-accent-500 transition hover:bg-accent-50" aria-label="Remove type">
                                        <x-icon name="trash" class="size-3.5" />
                                    </button>
                                </div>
                            </template>
                            <p x-show="rows.length === 0" x-cloak class="rounded-xl border border-dashed border-ink-900/10 px-4 py-4 text-center text-xs text-ink-400">No apartment types added.</p>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="admin-label" for="features">Apartment features <span class="font-medium normal-case tracking-normal text-ink-400">(one per line)</span></label>
                        <textarea class="admin-input min-h-28 resize-y" id="features" name="features" placeholder="3 Bedrooms&#10;3 Bathrooms&#10;Formal Living">{{ old('features', implode("\n", $project->features ?? [])) }}</textarea>
                    </div>

                    <div class="mt-5">
                        <label class="admin-label" for="ground_floor">Ground floor facilities <span class="font-medium normal-case tracking-normal text-ink-400">(comma separated)</span></label>
                        <textarea class="admin-input min-h-24 resize-y" id="ground_floor" name="ground_floor" placeholder="24/7 monitored car parking, reception, guard post...">{{ old('ground_floor', $project->ground_floor) }}</textarea>
                    </div>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Media</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Portrait images work best for project cards (recommended 1000×1250px or larger).</p>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            ['name' => 'hero_image_file', 'label' => 'Hero image', 'current' => $project->hero_image, 'hint' => 'Main image on the project page.'],
                            ['name' => 'cover_image_file', 'label' => 'Cover image', 'current' => $project->cover_image, 'hint' => 'Used on project cards. Defaults to hero.'],
                            ['name' => 'location_image_file', 'label' => 'Location map image', 'current' => $project->location_image, 'hint' => 'Optional map or master plan.'],
                        ] as $media)
                            <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                                <label class="admin-label" for="{{ $media['name'] }}">{{ $media['label'] }}</label>
                                @if ($media['current'])
                                    <img src="{{ asset($media['current']) }}" alt="{{ $media['label'] }}" class="mb-2 h-24 w-full rounded-lg object-cover">
                                @endif
                                <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="{{ $media['name'] }}" name="{{ $media['name'] }}" accept="image/*">
                                <p class="mt-1.5 text-[10px] text-ink-400">{{ $media['hint'] }}</p>
                            </div>
                        @endforeach

                        <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                            <label class="admin-label" for="brochure_file">Brochure PDF</label>
                            @if ($project->brochure_file)
                                <a href="{{ asset($project->brochure_file) }}" target="_blank" class="mb-2 flex items-center gap-2 text-[11px] font-bold text-brand-700 hover:text-accent-600">
                                    <x-icon name="document" class="size-4" /> Current brochure
                                </a>
                            @endif
                            <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="brochure_file" name="brochure_file" accept="application/pdf">
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Gallery Photos</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Upload multiple images for the project gallery.</p>

                    @if ($galleryImages->isNotEmpty())
                        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                            @foreach ($galleryImages as $image)
                                <label class="group relative block overflow-hidden rounded-xl border border-ink-900/10">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" class="aspect-square w-full object-cover">
                                    <span class="absolute inset-x-2 bottom-2 flex items-center gap-2 rounded-lg bg-ink-950/80 px-2 py-1.5 text-[10px] font-bold text-white backdrop-blur">
                                        <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" class="size-3.5 rounded border-white/30 bg-white/20 text-accent-600">
                                        Remove
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <input class="admin-input mt-4 py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" name="gallery_images[]" accept="image/*" multiple>
                </div>

                <div class="admin-card">
                    <h2 class="text-sm font-extrabold text-ink-900">Floor Plans</h2>
                    <p class="mt-1 text-[11px] text-ink-400">Upload floor plans or master plans. These are shown in a dedicated section.</p>

                    @if ($floorPlans->isNotEmpty())
                        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                            @foreach ($floorPlans as $image)
                                <label class="group relative block overflow-hidden rounded-xl border border-ink-900/10">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" class="aspect-[4/3] w-full object-cover">
                                    <span class="absolute inset-x-2 bottom-2 flex items-center gap-2 rounded-lg bg-ink-950/80 px-2 py-1.5 text-[10px] font-bold text-white backdrop-blur">
                                        <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" class="size-3.5 rounded border-white/30 bg-white/20 text-accent-600">
                                        Remove
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <input class="admin-input mt-4 py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" name="floor_plan_images[]" accept="image/*" multiple>
                </div>
            </div>

            <div class="space-y-6">
                <div class="admin-card xl:sticky xl:top-24">
                    <h2 class="text-sm font-extrabold text-ink-900">Publish</h2>

                    <div class="mt-4 space-y-3">
                        <label class="flex items-start gap-3 rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                            <input type="checkbox" name="is_active" value="1" class="mt-0.5 size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_active', $project->exists ? $project->is_active : true))>
                            <span>
                                <span class="block text-xs font-extrabold text-ink-800">Active / Visible</span>
                                <span class="mt-0.5 block text-[10px] leading-relaxed text-ink-400">Show this project on the website.</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3 rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                            <input type="checkbox" name="is_featured" value="1" class="mt-0.5 size-4 rounded border-ink-300 text-brand-700 focus:ring-brand-500" @checked(old('is_featured', $project->is_featured))>
                            <span>
                                <span class="block text-xs font-extrabold text-ink-800">Featured project</span>
                                <span class="mt-0.5 block text-[10px] leading-relaxed text-ink-400">Show in the homepage carousel.</span>
                            </span>
                        </label>
                    </div>

                    <div class="mt-5 space-y-2">
                        <button type="submit" class="admin-btn admin-btn-primary w-full py-3">
                            <x-icon name="check" class="size-4" /> {{ $project->exists ? 'Save Changes' : 'Create Project' }}
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-light w-full py-3">Cancel</a>
                    </div>

                    @if ($project->exists)
                        <p class="mt-4 border-t border-ink-900/5 pt-4 text-[10px] text-ink-400">
                            Created {{ $project->created_at->format('d M Y') }}<br>
                            Last updated {{ $project->updated_at->diffForHumans() }}
                        </p>
                    @endif
                </div>

                <div class="rounded-2xl border border-gold-500/20 bg-gold-50 p-4">
                    <p class="flex items-center gap-2 text-xs font-extrabold text-gold-800"><x-icon name="sparkles" class="size-4" /> Tips</p>
                    <ul class="mt-2 space-y-1.5 text-[10px] leading-relaxed text-gold-800/80">
                        <li>• Use portrait images for hero and cover.</li>
                        <li>• Keep the tagline under 100 characters.</li>
                        <li>• Add apartment types to show size table.</li>
                        <li>• New images are added to the end of the gallery.</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>

    @if ($project->exists)
        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project and all of its images? This cannot be undone.');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger">
                <x-icon name="trash" class="size-4" /> Delete Project
            </button>
        </form>
    @endif
@endsection