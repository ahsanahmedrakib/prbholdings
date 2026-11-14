@extends('layouts.app')

@section('title', 'Privacy Policy | '.setting('site_name'))
@section('meta_description', 'Read how PRB Holdings collects, uses, maintains and discloses information from visitors to our website.')

@php
    $sections = [
        [
            'title' => 'Personal identification information',
            'body' => 'We may collect personal information from users in a variety of ways when they visit our site, subscribe to our newsletter, fill out a form, or take part in other activities, services, features or resources that we offer. This information may include a user\'s name, email address, mailing address or phone number. However, users always have the option to visit our site anonymously and refuse to supply personal information. Keep in mind that this may prevent them from being able to participate in certain activities available on our site.',
        ],
        [
            'title' => 'Non-personal identification information',
            'body' => 'We collect non-personal identification information about users whenever they interact with our site. This information may include the browser name, the type of device and technical information about the user\'s connection to the site, such as the operating system and internet service provider used.',
        ],
        [
            'title' => 'Web browser cookies',
            'body' => 'Our site uses cookies to improve your experience. Cookies are small files that are placed on your device by websites you visit. They are generally used for record-keeping purposes and sometimes to track information about you. You can set your browser to refuse cookies or to alert you when cookies are being sent. However, if you do this, some parts of the site may not work properly.',
        ],
        [
            'title' => 'How we use collected information',
            'body' => 'We may collect and use your personal information to improve customer service, personalise your experience, improve our site, run promotions, contests, surveys or other site features, and to send you information you agreed to receive about topics of interest to you.',
        ],
        [
            'title' => 'How we protect user information',
            'body' => 'We take appropriate measures to protect users\' information from unauthorised access, alteration, disclosure or destruction. However, we cannot guarantee complete security and we will not be liable in the event of an attack that is difficult to defend against. If data is lost, we will do our best to retrieve it.',
        ],
        [
            'title' => 'Sharing personal information of users',
            'body' => 'We will not share your personal information with anyone unless it is for one of the reasons mentioned in this policy. We may share general information that is not linked to any personal information with our subsidiaries, business partners, trusted affiliates and advertisers.',
        ],
        [
            'title' => 'Changes to this privacy policy',
            'body' => 'We may update this privacy policy at any time. Users should check this page regularly to find out about any changes to the policy and how we protect users\' personal information. By using this site, you agree that it is your responsibility to review the privacy policy periodically and be aware of any changes.',
        ],
        [
            'title' => 'Your acceptance of these terms',
            'body' => 'By accessing this site, you agree to our privacy policy, which may be modified from time to time. If you do not agree to our privacy policy, you should not access this site. This privacy policy applies to the information and data collected by our call centres.',
        ],
    ];
@endphp

@section('content')
    <x-page-hero
        :image="setting('banner_image_privacy')"
        eyebrow="Privacy Policy"
        title="Your privacy matters to us."
        subtitle="This policy explains how PRB Holdings collects, uses, maintains and discloses information from users of our website."
    />

    <section class="relative overflow-hidden bg-cream py-20 lg:py-28">
        <div class="pattern-dots pointer-events-none absolute -left-8 top-16 size-72 opacity-40"></div>

        <div class="container-x relative">
            <div class="grid gap-12 lg:grid-cols-[0.72fr_1.28fr] lg:gap-16">
                <aside class="lg:sticky lg:top-28 lg:self-start" data-reveal="left">
                    <span class="eyebrow">On this page</span>
                    <h2 class="display-title mt-4 text-3xl sm:text-4xl">Privacy at a glance.</h2>
                    <p class="mt-4 text-sm leading-relaxed text-ink-500">
                        We keep the information we collect to what is necessary to serve you well, and we treat it with the same care we bring to every PRB address.
                    </p>

                    <nav class="mt-6 space-y-1">
                        @foreach ($sections as $section)
                            <a href="#section-{{ $loop->iteration }}" class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-[11px] font-semibold text-ink-500 transition hover:bg-white hover:text-brand-800">
                                <span class="size-1.5 rounded-full bg-gold-500"></span> {{ $section['title'] }}
                            </a>
                        @endforeach
                        <a href="#disclaimer" class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-[11px] font-semibold text-ink-500 transition hover:bg-white hover:text-brand-800">
                            <span class="size-1.5 rounded-full bg-gold-500"></span> Disclaimer
                        </a>
                    </nav>

                    <div class="mt-8 rounded-2xl border border-ink-900/5 bg-white p-5 shadow-sm">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-ink-400">Questions?</p>
                        <p class="mt-2 text-sm font-semibold text-ink-800">Talk to our team</p>
                        <a href="mailto:{{ setting('email') }}" class="mt-1 block text-xs font-bold text-brand-800 hover:text-accent-600">{{ setting('email') }}</a>
                        <a href="tel:{{ setting('phone_link') }}" class="mt-0.5 block text-xs font-bold text-brand-800 hover:text-accent-600">{{ setting('phone') }}</a>
                    </div>
                </aside>

                <div class="rounded-4xl border border-ink-900/5 bg-white p-6 shadow-sm sm:p-8 lg:p-10" data-reveal="right">
                    <p class="text-sm leading-relaxed text-ink-500">
                        The privacy policy explains how {{ setting('site_name') }} collects, uses, maintains and discloses information from users of the website. By using this website, you consent to the practices described below.
                    </p>

                    <div class="mt-8 space-y-8">
                        @foreach ($sections as $section)
                            <div id="section-{{ $loop->iteration }}" class="scroll-mt-32">
                                <div class="flex items-start gap-3">
                                    <span class="grid size-8 shrink-0 place-items-center rounded-full bg-brand-50 text-[11px] font-extrabold text-brand-800">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        <h2 class="font-display text-xl font-medium text-ink-900 sm:text-2xl">{{ $section['title'] }}</h2>
                                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $section['body'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div id="disclaimer" class="scroll-mt-32 rounded-2xl border border-gold-500/20 bg-gold-50/70 p-5 sm:p-6">
                            <h2 class="font-display text-xl font-medium text-ink-900 sm:text-2xl">Disclaimer</h2>
                            <div class="mt-3 space-y-3 text-sm leading-relaxed text-ink-600">
                                <p>This website contains artistic representations of the company\'s work, such as 3D views, elevations, walkthroughs, e-brochures and other similar materials. These materials are for representational purposes only and do not form part of any agreement or become legally binding on the company. Soft furnishing, furniture and gadgets are not part of the offering.</p>
                                <p>Specifications are indicative and subject to change as decided by the company or the competent authority. Marginal variation may be necessary during construction. The extent, number, variety and brand of equipment and appliances are tentative and liable to change at the sole discretion of the company.</p>
                                <p>The individual is responsible for evaluating the accuracy, completeness and usefulness of any opinions, advice, services or other information provided. All information contained on any page is distributed with the understanding that the authors, publishers and distributors are not rendering legal or other professional advice or opinions on specific facts or matters, and accordingly assume no liability whatsoever in connection with its use.</p>
                                <p>In no event shall the company be liable for any direct, indirect, special, incidental or consequential damages arising out of the use of the information herein.</p>
                            </div>
                        </div>
                    </div>

                    <p class="mt-8 border-t border-ink-900/5 pt-6 text-[11px] text-ink-400">
                        Last updated {{ now()->format('F Y') }}. If you have any questions about this policy, please contact us at
                        <a href="mailto:{{ setting('email') }}" class="font-bold text-brand-800 hover:text-accent-600">{{ setting('email') }}</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
