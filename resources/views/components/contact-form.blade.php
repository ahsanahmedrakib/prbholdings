@props(['projects' => collect(), 'project' => null, 'subject' => null])

<form method="POST" action="{{ route('contact.store') }}" class="grid gap-4 sm:grid-cols-2">
    @csrf
    @if ($project)
        <input type="hidden" name="project_id" value="{{ $project->id }}">
    @endif
    <div class="hidden" aria-hidden="true">
        <label for="website-{{ $project?->id ?? 'general' }}">Website</label>
        <input type="text" id="website-{{ $project?->id ?? 'general' }}" name="website" tabindex="-1" autocomplete="off">
    </div>

    <div>
        <label class="field-label" for="name-{{ $project?->id ?? 'general' }}">Full Name</label>
        <input class="field" type="text" id="name-{{ $project?->id ?? 'general' }}" name="name" value="{{ old('name') }}" placeholder="Your name" required>
        @error('name') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="phone-{{ $project?->id ?? 'general' }}">Phone</label>
        <input class="field" type="text" id="phone-{{ $project?->id ?? 'general' }}" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
        @error('phone') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="email-{{ $project?->id ?? 'general' }}">Email <span class="font-medium normal-case tracking-normal text-ink-400">(optional)</span></label>
        <input class="field" type="email" id="email-{{ $project?->id ?? 'general' }}" name="email" value="{{ old('email') }}" placeholder="you@example.com">
        @error('email') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="subject-{{ $project?->id ?? 'general' }}">I am interested in</label>
        <select class="field" id="subject-{{ $project?->id ?? 'general' }}" name="subject">
            @foreach (['Buying an apartment', 'Landowner partnership', 'Project information', 'Site visit', 'General enquiry'] as $option)
                <option value="{{ $option }}" @selected(old('subject', $subject) === $option)>{{ $option }}</option>
            @endforeach
        </select>
        @error('subject') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
    </div>

    @if (! $project && $projects->isNotEmpty())
        <div class="sm:col-span-2">
            <label class="field-label" for="project-{{ $project?->id ?? 'general' }}">Project <span class="font-medium normal-case tracking-normal text-ink-400">(optional)</span></label>
            <select class="field" id="project-{{ $project?->id ?? 'general' }}" name="project_id">
                <option value="">Any project / not sure yet</option>
                @foreach ($projects as $projectOption)
                    <option value="{{ $projectOption->id }}" @selected((string) old('project_id') === (string) $projectOption->id)>{{ $projectOption->name }}</option>
                @endforeach
            </select>
            @error('project_id') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
        </div>
    @endif

    <div class="sm:col-span-2">
        <label class="field-label" for="message-{{ $project?->id ?? 'general' }}">Message</label>
        <textarea class="field min-h-32 resize-y" id="message-{{ $project?->id ?? 'general' }}" name="message" placeholder="Tell us a little about what you are looking for..." required>{{ old('message') }}</textarea>
        @error('message') <p class="mt-1.5 text-xs font-semibold text-accent-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="max-w-xs text-[11px] leading-relaxed text-ink-400">By submitting, you agree to be contacted by our team regarding your enquiry.</p>
        <button type="submit" class="btn-primary btn-shine shrink-0">
            Send Enquiry
            <x-icon name="arrow-right" class="size-4" />
        </button>
    </div>
</form>