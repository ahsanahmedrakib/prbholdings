<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'general' => [
                'site_name' => 'PRB Holdings',
                'site_tagline' => 'Your Satisfaction Is Our Dream...',
                'phone' => '01550 - 028550',
                'phone_link' => '+8801550028550',
                'email' => 'info@prbholdingsbd.com',
                'address' => 'House - 07, Road - 17, Sector - 04, Uttara, Dhaka-1230.',
                'office_hours' => 'Saturday – Thursday, 9:00 AM – 7:00 PM',
                'map_embed' => 'https://www.google.com/maps?q=House+07+Road+17+Sector+04+Uttara+Dhaka&output=embed',
                'facebook' => 'https://www.facebook.com/',
                'instagram' => 'https://www.instagram.com/',
                'linkedin' => 'https://www.linkedin.com/',
                'youtube' => 'https://www.youtube.com/',
                'whatsapp' => '+8801550028550',
            ],
            'about' => [
                'about_eyebrow' => 'About PRB Holdings',
                'about_heading' => 'Redefining your standard of living',
                'about_short' => 'PRB Holdings is one of the fastest growing Construction / Real Estate companies in Bangladesh. Under the guidance of our top management, our team of expert engineers and architects are committed to revolutionise the modern real estate industry of Bangladesh through achieving total satisfaction of our coveted customers.',
                'about_story' => 'PRB Holdings is one of the fastest growing Construction / Real Estate companies in Bangladesh. Under the guidance of our top management, our team of expert engineers and architects are committed to revolutionise the modern real estate industry of Bangladesh through achieving total satisfaction of our coveted customers.

We have successfully completed a substantial number of projects. Since the very beginning, our aim was to build a relationship based on mutual trust and respect with our clients. Within this short period, the response that we have received from our well-wishers has motivated us to go an extra mile to attain perfection. Through ensuring unwavering quality, we always try our level best to repay the faith that our buyers have put in us.

PRB Holdings started residential building construction in this heavily competitive market and with the goodwill of everyone related, we have been able to establish a good reputation in the industry. Now, we are eyeing to expand our horizons so that we can serve our clients in every possible way.

We want to establish ourselves not only as mere service providers, but also as total caregivers for our trusted stakeholders. With our heartiest endeavour, we want to march forward with a mission to become one of the leading construction companies in the world.',
                'vision' => 'To be the most preferred innovative developer of the country.',
                'mission' => 'To satisfy our landowners and buyers through our heartiest endeavour and nation building through sustainable, planned housing facilities.',
                'about_image_main' => 'uploads/projects/shirin-garden/living.jpg',
                'about_image_secondary' => 'uploads/projects/shirin-garden/bedroom.jpg',
                'about_video_url' => '',
            ],
            'home' => [
                'hero_badge' => 'Building trust since day one',
                'projects_eyebrow' => 'Our Portfolio',
                'projects_heading' => 'Bespoke enclaves with finesse in architecture and design',
                'projects_text' => 'Explore a collection of contemporary residential addresses across Uttara — each planned around light, privacy and everyday comfort.',
                'amenities_eyebrow' => 'Signature Amenities',
                'amenities_heading' => 'Everyday luxuries, thoughtfully curated',
                'amenities_text' => 'From round-the-clock security to generous parking and community spaces, every PRB address is designed to make daily life feel effortless.',
                'testimonials_eyebrow' => 'Our Residents',
                'testimonials_heading' => 'Stories from the families who call PRB home',
                'cta_eyebrow' => 'Let\'s Build Together',
                'cta_heading' => 'Have land? Let\'s turn it into a landmark.',
                'cta_text' => 'Partner with a developer who values your investment as much as you do. We handle planning, approvals, construction and handover — with complete transparency at every stage.',
                'landowner_title' => 'For Landowners',
                'landowner_text' => 'Build your sanctuary with a team that protects your land, your timeline and your peace of mind.',
                'buyer_title' => 'For Buyers',
                'buyer_text' => 'Invest in a better tomorrow with thoughtfully designed apartments in Uttara\'s most connected neighbourhoods.',
            ],
            'banner' => [
                'banner_image' => 'uploads/projects/shirin-garden/hero.jpg',
                'banner_image_about' => 'uploads/projects/shiri-serenity/hero.jpg',
                'banner_image_team' => 'uploads/projects/naima-palace/hero.jpg',
                'banner_image_projects' => 'uploads/projects/asiancity-kawlar/hero.jpg',
                'banner_image_gallery' => 'uploads/projects/brothers-garden/hero.jpg',
                'banner_image_contact' => 'uploads/projects/ruhina-palace/hero.jpg',
                'banner_image_privacy' => 'uploads/projects/mollartek-uttara/hero.jpg',
            ],
            'footer' => [
                'footer_about' => 'A modern real estate developer creating sustainable, thoughtfully planned residential communities across Uttara, Dhaka.',
                'copyright' => '© '.date('Y').' PRB Holdings. All rights reserved.',
            ],
            'seo' => [
                'meta_title' => 'PRB Holdings | Modern Residential Apartments in Uttara, Dhaka',
                'meta_description' => 'PRB Holdings is a fast-growing construction and real estate company in Bangladesh, building thoughtfully designed residential apartments in Uttara, Dhaka. Your satisfaction is our dream.',
                'og_image' => 'uploads/hero/shirin-garden.jpg',
            ],
        ];

        foreach ($settings as $group => $values) {
            foreach ($values as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
            }
        }

        Setting::flush();
    }
}
