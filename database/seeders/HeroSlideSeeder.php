<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'eyebrow' => 'Now Open · PRB Shirin Garden',
                'title' => 'Your satisfaction is our dream.',
                'subtitle' => 'Spacious three-bedroom residences in Diabari, Uttara — crafted for the way you live today.',
                'image' => 'uploads/projects/shirin-garden/hero.jpg',
                'cta_label' => 'Explore Shirin Garden',
                'cta_url' => '/projects/shirin-garden',
                'sort_order' => 1,
            ],
            [
                'eyebrow' => 'PRB Brothers Garden',
                'title' => 'A home that grows with you.',
                'subtitle' => 'Twenty-one exclusive apartments in Kosaibari, Uttara with efficient layouts and 24/7 care.',
                'image' => 'uploads/projects/brothers-garden/hero.jpg',
                'cta_label' => 'Discover Brothers Garden',
                'cta_url' => '/projects/brothers-garden',
                'sort_order' => 2,
            ],
            [
                'eyebrow' => 'PRB Shiri Serenity',
                'title' => 'Serenity, by design.',
                'subtitle' => 'South-facing apartments in Kamarpara, Uttara where every morning begins with natural light.',
                'image' => 'uploads/projects/shiri-serenity/hero.jpg',
                'cta_label' => 'View Shiri Serenity',
                'cta_url' => '/projects/shiri-serenity',
                'sort_order' => 3,
            ],
            [
                'eyebrow' => 'PRB Naima Palace',
                'title' => 'Palace living, every day.',
                'subtitle' => 'Expansive family homes on Gawair Madrasha Road, Dakshinkhan — designed around togetherness.',
                'image' => 'uploads/projects/naima-palace/hero.jpg',
                'cta_label' => 'Explore Naima Palace',
                'cta_url' => '/projects/naima-palace',
                'sort_order' => 4,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(
                ['title' => $slide['title']],
                $slide + ['is_active' => true]
            );
        }
    }
}
