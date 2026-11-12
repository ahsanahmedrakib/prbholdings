@php
    $phoneLink = setting('phone_link', '+8801550028550');
@endphp

<div data-floating-actions class="floating-actions fixed bottom-5 right-4 z-[60] flex flex-col items-center gap-3 sm:bottom-6 sm:right-6">
    <button type="button" data-to-top class="group grid size-11 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-700 shadow-xl shadow-ink-950/10 transition duration-300 hover:-translate-y-1 hover:bg-brand-700 hover:text-white" aria-label="Back to top">
        <x-icon name="arrow-up" class="size-4 transition group-hover:-translate-y-0.5" />
    </button>

    <a href="{{ whatsapp_url(null, 'Hello PRB Holdings, I would like to know more about your projects.') }}" target="_blank" rel="noopener" class="group relative grid size-14 place-items-center rounded-full bg-brand-600 text-white shadow-xl shadow-brand-900/30 transition duration-300 hover:-translate-y-1 hover:bg-brand-700" aria-label="Chat on WhatsApp">
        <span class="video-pulse absolute inset-0 rounded-full"></span>
        <x-icon name="whatsapp" class="relative size-7" />
    </a>

    <a href="tel:{{ $phoneLink }}" class="grid size-11 place-items-center rounded-full bg-accent-600 text-white shadow-xl shadow-accent-900/30 transition duration-300 hover:-translate-y-1 hover:bg-accent-700" aria-label="Call now">
        <x-icon name="phone" class="size-4" />
    </a>
</div>