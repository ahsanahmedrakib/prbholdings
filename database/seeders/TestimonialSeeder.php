<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $shirin = Project::where('slug', 'shirin-garden')->first();
        $brothers = Project::where('slug', 'brothers-garden')->first();
        $naima = Project::where('slug', 'naima-palace')->first();

        $testimonials = [
            [
                'name' => 'Md. Rafiqul Islam',
                'designation' => 'Apartment Owner',
                'message' => 'From the first site visit to handover, the PRB team was transparent and responsive. The apartment is bright, well planned and genuinely feels like home.',
                'rating' => 5,
                'project_id' => $shirin?->id,
                'sort_order' => 1,
            ],
            [
                'name' => 'Farzana Akter',
                'designation' => 'Apartment Owner',
                'message' => 'What impressed us most was the attention to detail — the ventilation, the storage and the quality of finishes. We felt looked after at every stage.',
                'rating' => 5,
                'project_id' => $brothers?->id,
                'sort_order' => 2,
            ],
            [
                'name' => 'A. S. M. Faizullah',
                'designation' => 'Landowner Partner',
                'message' => 'PRB respected our land, our timeline and our opinions. The communication was clear from day one, and the result speaks for itself.',
                'rating' => 5,
                'project_id' => $naima?->id,
                'sort_order' => 3,
            ],
            [
                'name' => 'Nusrat Jahan',
                'designation' => 'Apartment Owner',
                'message' => 'A secure, peaceful building in a great location. The team still checks in after handover, which says a lot about how much they care.',
                'rating' => 5,
                'project_id' => $shirin?->id,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name']],
                $testimonial + ['is_active' => true]
            );
        }
    }
}
