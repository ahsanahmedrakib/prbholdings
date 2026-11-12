@props(['project'])

<article {{ $attributes->merge(['class' => 'project-card group relative flex h-full flex-col overflow-hidden rounded-[2rem] border border-ink-900/5 bg-white transition duration-500 hover:-translate-y-1.5']) }}>
    <a href="{{ route('projects.show', $project) }}" class="relative block aspect-[4/5] overflow-hidden bg-ink-900">
        <img
            src="{{ $project->cover_image_url }}"
            alt="{{ $project->name }}"
            loading="lazy"
            class="h-full w-full object-cover transition duration-[1100ms] ease-out group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-linear-to-t from-ink-950/90 via-ink-950/15 to-transparent"></div>

        <span class="absolute left-4 top-4 inline-flex items-center rounded-full px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-[0.16em] ring-1 backdrop-blur {{ $project->status_class }}">
            {{ $project->status_label }}
        </span>

        <span class="absolute right-4 top-4 grid size-10 place-items-center rounded-full border border-white/30 bg-white/15 text-white backdrop-blur transition duration-500 group-hover:rotate-45 group-hover:bg-white group-hover:text-brand-800">
            <x-icon name="arrow-up-right" class="size-4" />
        </span>

        <div class="absolute inset-x-5 bottom-5">
            <p class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-[0.18em] text-white/70">
                <x-icon name="pin" class="size-3.5 text-gold-300" />
                {{ $project->location }}
            </p>
            <h3 class="mt-2 font-display text-[1.65rem] font-medium leading-tight text-white">{{ $project->name }}</h3>
        </div>
    </a>

    <div class="flex flex-1 flex-col gap-4 p-5 sm:p-6">
        @if ($project->tagline)
            <p class="text-sm leading-relaxed text-ink-500">{{ $project->tagline }}</p>
        @endif

        <div class="mt-auto flex flex-wrap gap-2">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-brand-50 px-3 py-1.5 text-[10px] font-bold text-brand-800">
                <x-icon name="area" class="size-3.5" />
                {{ $project->spec_summary }}
            </span>
            @if ($project->floors)
                <span class="inline-flex items-center gap-1.5 rounded-full bg-ink-50 px-3 py-1.5 text-[10px] font-bold text-ink-600">
                    <x-icon name="floors" class="size-3.5" />
                    {{ $project->floors }}
                </span>
            @endif
            @if ($project->total_apartments)
                <span class="inline-flex items-center gap-1.5 rounded-full bg-gold-50 px-3 py-1.5 text-[10px] font-bold text-gold-700">
                    <x-icon name="building" class="size-3.5" />
                    {{ $project->total_apartments }} Apartments
                </span>
            @endif
        </div>
    </div>
</article>