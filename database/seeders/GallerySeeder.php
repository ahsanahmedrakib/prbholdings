<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\Project;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        if (GalleryImage::query()->exists()) {
            return;
        }

        $sort = 1;

        foreach (Project::query()->active()->orderBy('sort_order')->get() as $project) {
            if ($project->hero_image) {
                GalleryImage::create([
                    'image' => $project->hero_image,
                    'caption' => $project->name,
                    'sort_order' => $sort++,
                    'is_active' => true,
                ]);
            }

            foreach ($project->gallery as $image) {
                GalleryImage::create([
                    'image' => $image->image,
                    'caption' => $image->caption ?: $project->name,
                    'sort_order' => $sort++,
                    'is_active' => true,
                ]);
            }
        }
    }
}
