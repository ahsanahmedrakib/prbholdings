@extends('layouts.app')

@section('title', 'Contact Us | '.setting('site_name'))
@section('meta_description', 'Contact PRB Holdings for apartment enquiries, landowner partnerships or to book a site visit in Uttara, Dhaka.')

@section('content')
    <x-page-hero
        :image="setting('banner_image_contact')"
        eyebrow="Contact Us"
        title="Let's start a conversation."
        subtitle="Whether you are buying your first home or planning a development on your land, our team is here to help."
    />

    <section id="contact" class="bg-cream py-16 lg:py-24">
        <div class="container-x grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:gap-16">
            <div data-reveal="left">
                <span class="eyebrow">Get in Touch</span>
                <h2 class="display-title mt-4">We would love<br class="hidden sm:block"> to hear from you.</h2>
                <p class="mt-4 max-w-md text-sm leading-relaxed text-ink-500">
                    Reach out by phone, email or the form. Our team typically responds within one working day.
                </p>

                <div class="mt-8 space-y-3">
                    <a href="tel:{{ setting('phone_link') }}" class="group flex items-start gap-4 rounded-3xl border border-ink-900/5 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                        <span class="grid size-11 shrink-0 place-items-center rounded-full bg-brand-700 text-white transition group-hover:bg-accent-600"><x-icon name="phone" class="size-5" /></span>
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.22em] text-ink-400">Call us</p>
                            <p class="mt-1 text-sm font-extrabold text-ink-900">{{ setting('phone') }}</p>
                            <p class="mt-1 text-[11px] text-ink-400">{{ setting('office_hours') }}</p>
                        </div>
                    </a>

                    <a href="mailto:{{ setting('email') }}" class="group flex items-start gap-4 rounded-3xl border border-ink-900/5 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                        <span class="grid size-11 shrink-0 place-items-center rounded-full bg-accent-600 text-white transition group-hover:bg-brand-700"><x-icon name="mail" class="size-5" /></span>
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.22em] text-ink-400">Email us</p>
                            <p class="mt-1 text-sm font-extrabold text-ink-900">{{ setting('email') }}</p>
                            <p class="mt-1 text-[11px] text-ink-400">For enquiries and project information.</p>
                        </div>
                    </a>

                    <div class="flex items-start gap-4 rounded-3xl border border-ink-900/5 bg-white p-5 shadow-sm">
                        <span class="grid size-11 shrink-0 place-items-center rounded-full bg-ink-950 text-gold-300"><x-icon name="pin" class="size-5" /></span>
                        <div>
                            <p class="text-[9px] font-extrabold uppercase tracking-[0.22em] text-ink-400">Corporate office</p>
                            <p class="mt-1 text-sm font-extrabold leading-relaxed text-ink-900">{{ setting('address') }}</p>
                            <a href="https://www.google.com/maps?q={{ urlencode(setting('address')) }}" target="_blank" rel="noopener" class="mt-2 inline-flex items-center gap-1.5 text-[11px] font-bold text-brand-700 hover:text-accent-600">
                                Get directions <x-icon name="arrow-up-right" class="size-3.5" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-2.5">
                    @foreach (['facebook', 'instagram', 'linkedin', 'youtube'] as $social)
                        <a href="{{ setting($social, '#') }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($social) }}" class="grid size-10 place-items-center rounded-full border border-ink-900/10 bg-white text-ink-600 transition hover:-translate-y-0.5 hover:border-brand-700/30 hover:bg-brand-700 hover:text-white">
                            <x-icon :name="$social" class="size-4" />
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="rounded-4xl border border-ink-900/5 bg-white p-6 shadow-xl shadow-ink-950/5 sm:p-8" data-reveal="right">
                <div class="mb-6">
                    <p class="text-[10px] font-extrabold uppercase tracking-[0.28em] text-accent-600">Enquiry Form</p>
                    <h2 class="mt-2 font-display text-3xl text-ink-900">How can we help?</h2>
                    <p class="mt-2 text-xs leading-relaxed text-ink-500">Fill in the form and our team will get back to you with the information you need.</p>
                </div>
                <x-contact-form :projects="$projects" />
            </div>
        </div>
    </section>

    <section class="bg-white pb-16 lg:pb-24">
        <div class="container-x">
            <div class="overflow-hidden rounded-4xl border border-ink-900/10 bg-cream shadow-sm" data-reveal="zoom">
                <div class="aspect-4/3 w-full sm:aspect-21/9">
                    <iframe
                        src="{{ setting('map_embed') }}"
                        title="PRB Holdings office location"
                        class="h-full w-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-ink-950 py-16 text-white">
        <div class="pattern-grid pointer-events-none absolute inset-0 opacity-30"></div>
        <div class="container-x relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-gold-300">Landowner?</p>
                <h2 class="mt-3 font-display text-3xl font-medium sm:text-4xl">Let's develop your land together.</h2>
                <p class="mt-3 max-w-xl text-sm text-white/55">Share your plot details and we will arrange a no-obligation discussion about the possibilities.</p>
            </div>
            <a href="tel:{{ setting('phone_link') }}" class="btn-accent btn-shine shrink-0">Call {{ setting('phone') }}</a>
        </div>
    </section>
@endsection