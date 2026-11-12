@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
    @php
        $groups = $settings->map(fn ($items) => $items->pluck('value', 'key'));
        $get = fn (string $group, string $key, string $default = '') => old("settings.$key", $groups->get($group, collect())->get($key, $default));
    @endphp

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid gap-6 xl:grid-cols-[1fr_19rem]">
            <div class="space-y-6">
                <div class="admin-card" id="general">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-extrabold text-ink-900">General Information</h2>
                            <p class="mt-1 text-[11px] text-ink-400">Primary contact details and social links used site-wide.</p>
                        </div>
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="building" class="size-4" /></span>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="site_name">Site name</label>
                            <input class="admin-input" type="text" id="site_name" name="settings[site_name]" value="{{ $get('general', 'site_name') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="site_tagline">Tagline</label>
                            <input class="admin-input" type="text" id="site_tagline" name="settings[site_tagline]" value="{{ $get('general', 'site_tagline') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="phone">Phone</label>
                            <input class="admin-input" type="text" id="phone" name="settings[phone]" value="{{ $get('general', 'phone') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="phone_link">Phone link <span class="font-medium normal-case tracking-normal text-ink-400">(with country code)</span></label>
                            <input class="admin-input" type="text" id="phone_link" name="settings[phone_link]" value="{{ $get('general', 'phone_link') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="email">Email</label>
                            <input class="admin-input" type="email" id="email" name="settings[email]" value="{{ $get('general', 'email') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="whatsapp">WhatsApp number</label>
                            <input class="admin-input" type="text" id="whatsapp" name="settings[whatsapp]" value="{{ $get('general', 'whatsapp') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="address">Address</label>
                            <input class="admin-input" type="text" id="address" name="settings[address]" value="{{ $get('general', 'address') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="office_hours">Office hours</label>
                            <input class="admin-input" type="text" id="office_hours" name="settings[office_hours]" value="{{ $get('general', 'office_hours') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="map_embed">Google Maps embed URL</label>
                            <textarea class="admin-input min-h-20 resize-y font-mono text-[11px]" id="map_embed" name="settings[map_embed]">{{ $get('general', 'map_embed') }}</textarea>
                            <p class="mt-1 text-[10px] text-ink-400">Use the src URL from a Google Maps embed code (should end with <code>output=embed</code>).</p>
                        </div>
                    </div>

                    <div class="mt-5 border-t border-ink-900/5 pt-5">
                        <p class="admin-label">Social links</p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach (['facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube'] as $key => $label)
                                <div>
                                    <label class="admin-label" for="{{ $key }}">{{ $label }}</label>
                                    <input class="admin-input" type="url" id="{{ $key }}" name="settings[{{ $key }}]" value="{{ $get('general', $key) }}" placeholder="https://...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="admin-card" id="about">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-extrabold text-ink-900">About Page</h2>
                            <p class="mt-1 text-[11px] text-ink-400">Company story, vision, mission and imagery.</p>
                        </div>
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="home" class="size-4" /></span>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="admin-label" for="about_eyebrow">Eyebrow</label>
                            <input class="admin-input" type="text" id="about_eyebrow" name="settings[about_eyebrow]" value="{{ $get('about', 'about_eyebrow') }}">
                        </div>
                        <div>
                            <label class="admin-label" for="about_heading">Heading</label>
                            <input class="admin-input" type="text" id="about_heading" name="settings[about_heading]" value="{{ $get('about', 'about_heading') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="about_short">Short introduction</label>
                            <textarea class="admin-input min-h-28 resize-y" id="about_short" name="settings[about_short]">{{ $get('about', 'about_short') }}</textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="about_story">Full story</label>
                            <textarea class="admin-input min-h-56 resize-y" id="about_story" name="settings[about_story]">{{ $get('about', 'about_story') }}</textarea>
                            <p class="mt-1 text-[10px] text-ink-400">Separate paragraphs with a blank line.</p>
                        </div>
                        <div>
                            <label class="admin-label" for="vision">Vision</label>
                            <textarea class="admin-input min-h-24 resize-y" id="vision" name="settings[vision]">{{ $get('about', 'vision') }}</textarea>
                        </div>
                        <div>
                            <label class="admin-label" for="mission">Mission</label>
                            <textarea class="admin-input min-h-24 resize-y" id="mission" name="settings[mission]">{{ $get('about', 'mission') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-5 grid gap-4 border-t border-ink-900/5 pt-5 sm:grid-cols-2">
                        @foreach (['about_image_main_file' => ['Main image', $get('about', 'about_image_main')], 'about_image_secondary_file' => ['Secondary image', $get('about', 'about_image_secondary')]] as $field => [$label, $current])
                            <div class="rounded-xl border border-ink-900/5 bg-ink-50/60 p-3">
                                <label class="admin-label" for="{{ $field }}">{{ $label }}</label>
                                @if ($current)
                                    <img src="{{ asset($current) }}" alt="{{ $label }}" class="mb-2 h-28 w-full rounded-lg object-cover">
                                @endif
                                <input class="admin-input py-2 text-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-brand-800" type="file" id="{{ $field }}" name="{{ $field }}" accept="image/*">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="admin-card" id="home">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-extrabold text-ink-900">Homepage Content</h2>
                            <p class="mt-1 text-[11px] text-ink-400">Section headings and copy on the landing page.</p>
                        </div>
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="sparkles" class="size-4" /></span>
                    </div>

                    <div class="mt-5 space-y-5">
                        <div>
                            <label class="admin-label" for="hero_badge">Hero badge</label>
                            <input class="admin-input" type="text" id="hero_badge" name="settings[hero_badge]" value="{{ $get('home', 'hero_badge') }}">
                        </div>

                        <div class="rounded-xl border border-ink-900/5 bg-ink-50/50 p-4">
                            <p class="admin-label">Projects section</p>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div><label class="admin-label" for="projects_eyebrow">Eyebrow</label><input class="admin-input" type="text" id="projects_eyebrow" name="settings[projects_eyebrow]" value="{{ $get('home', 'projects_eyebrow') }}"></div>
                                <div><label class="admin-label" for="projects_heading">Heading</label><input class="admin-input" type="text" id="projects_heading" name="settings[projects_heading]" value="{{ $get('home', 'projects_heading') }}"></div>
                                <div class="sm:col-span-2"><label class="admin-label" for="projects_text">Text</label><textarea class="admin-input min-h-20 resize-y" id="projects_text" name="settings[projects_text]">{{ $get('home', 'projects_text') }}</textarea></div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-ink-900/5 bg-ink-50/50 p-4">
                            <p class="admin-label">Amenities section</p>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div><label class="admin-label" for="amenities_eyebrow">Eyebrow</label><input class="admin-input" type="text" id="amenities_eyebrow" name="settings[amenities_eyebrow]" value="{{ $get('home', 'amenities_eyebrow') }}"></div>
                                <div><label class="admin-label" for="amenities_heading">Heading</label><input class="admin-input" type="text" id="amenities_heading" name="settings[amenities_heading]" value="{{ $get('home', 'amenities_heading') }}"></div>
                                <div class="sm:col-span-2"><label class="admin-label" for="amenities_text">Text</label><textarea class="admin-input min-h-20 resize-y" id="amenities_text" name="settings[amenities_text]">{{ $get('home', 'amenities_text') }}</textarea></div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-ink-900/5 bg-ink-50/50 p-4">
                            <p class="admin-label">Testimonials section</p>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div><label class="admin-label" for="testimonials_eyebrow">Eyebrow</label><input class="admin-input" type="text" id="testimonials_eyebrow" name="settings[testimonials_eyebrow]" value="{{ $get('home', 'testimonials_eyebrow') }}"></div>
                                <div><label class="admin-label" for="testimonials_heading">Heading</label><input class="admin-input" type="text" id="testimonials_heading" name="settings[testimonials_heading]" value="{{ $get('home', 'testimonials_heading') }}"></div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-ink-900/5 bg-ink-50/50 p-4">
                            <p class="admin-label">Call to action</p>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div><label class="admin-label" for="cta_eyebrow">Eyebrow</label><input class="admin-input" type="text" id="cta_eyebrow" name="settings[cta_eyebrow]" value="{{ $get('home', 'cta_eyebrow') }}"></div>
                                <div><label class="admin-label" for="cta_heading">Heading</label><input class="admin-input" type="text" id="cta_heading" name="settings[cta_heading]" value="{{ $get('home', 'cta_heading') }}"></div>
                                <div class="sm:col-span-2"><label class="admin-label" for="cta_text">Text</label><textarea class="admin-input min-h-24 resize-y" id="cta_text" name="settings[cta_text]">{{ $get('home', 'cta_text') }}</textarea></div>
                                <div><label class="admin-label" for="landowner_title">Landowner card title</label><input class="admin-input" type="text" id="landowner_title" name="settings[landowner_title]" value="{{ $get('home', 'landowner_title') }}"></div>
                                <div><label class="admin-label" for="buyer_title">Buyer card title</label><input class="admin-input" type="text" id="buyer_title" name="settings[buyer_title]" value="{{ $get('home', 'buyer_title') }}"></div>
                                <div class="sm:col-span-2"><label class="admin-label" for="landowner_text">Landowner card text</label><textarea class="admin-input min-h-20 resize-y" id="landowner_text" name="settings[landowner_text]">{{ $get('home', 'landowner_text') }}</textarea></div>
                                <div class="sm:col-span-2"><label class="admin-label" for="buyer_text">Buyer card text</label><textarea class="admin-input min-h-20 resize-y" id="buyer_text" name="settings[buyer_text]">{{ $get('home', 'buyer_text') }}</textarea></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-card" id="seo">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-extrabold text-ink-900">SEO & Footer</h2>
                            <p class="mt-1 text-[11px] text-ink-400">Search appearance and footer copy.</p>
                        </div>
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="search" class="size-4" /></span>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="meta_title">Meta title</label>
                            <input class="admin-input" type="text" id="meta_title" name="settings[meta_title]" value="{{ $get('seo', 'meta_title') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="meta_description">Meta description</label>
                            <textarea class="admin-input min-h-24 resize-y" id="meta_description" name="settings[meta_description]">{{ $get('seo', 'meta_description') }}</textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="og_image">OG image path</label>
                            <input class="admin-input" type="text" id="og_image" name="settings[og_image]" value="{{ $get('seo', 'og_image') }}" placeholder="uploads/hero/shirin-garden.jpg">
                            <p class="mt-1 text-[10px] text-ink-400">Relative path inside the public folder.</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="footer_about">Footer about text</label>
                            <textarea class="admin-input min-h-20 resize-y" id="footer_about" name="settings[footer_about]">{{ $get('footer', 'footer_about') }}</textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="admin-label" for="copyright">Copyright line</label>
                            <input class="admin-input" type="text" id="copyright" name="settings[copyright]" value="{{ $get('footer', 'copyright') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="admin-card xl:sticky xl:top-24">
                    <h2 class="text-sm font-extrabold text-ink-900">Save Settings</h2>
                    <p class="mt-1 text-[10px] leading-relaxed text-ink-400">Changes are applied across the website immediately.</p>
                    <button type="submit" class="admin-btn admin-btn-primary mt-4 w-full py-3">
                        <x-icon name="check" class="size-4" /> Save All Settings
                    </button>

                    <div class="mt-5 border-t border-ink-900/5 pt-4">
                        <p class="admin-label">Jump to section</p>
                        <nav class="space-y-1">
                            @foreach (['general' => 'General Information', 'about' => 'About Page', 'home' => 'Homepage Content', 'seo' => 'SEO & Footer'] as $anchor => $label)
                                <a href="#{{ $anchor }}" class="flex items-center gap-2 rounded-lg px-2.5 py-2 text-[11px] font-semibold text-ink-500 transition hover:bg-brand-50 hover:text-brand-800">
                                    <span class="size-1.5 rounded-full bg-gold-500"></span> {{ $label }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <div class="rounded-2xl border border-gold-500/20 bg-gold-50 p-4">
                    <p class="flex items-center gap-2 text-xs font-extrabold text-gold-800"><x-icon name="sparkles" class="size-4" /> Note</p>
                    <p class="mt-1.5 text-[10px] leading-relaxed text-gold-800/80">Images upload directly to <code>public/uploads</code>. Keep files under 6 MB for the fastest loading experience.</p>
                </div>
            </div>
        </div>
    </form>
@endsection