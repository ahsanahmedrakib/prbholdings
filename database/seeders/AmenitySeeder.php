<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            ['title' => '24/7 Monitored Security', 'icon' => 'shield', 'description' => 'CCTV coverage, guard posts and controlled access at every entry.'],
            ['title' => 'Dedicated Car Parking', 'icon' => 'car', 'description' => 'Generous parking with organised driveways and 24/7 monitoring.'],
            ['title' => 'Standby Generator', 'icon' => 'bolt', 'description' => 'Uninterrupted power for lifts, lights and everyday essentials.'],
            ['title' => 'Community Spaces', 'icon' => 'users', 'description' => 'Reception, caretaker and community rooms that bring neighbours together.'],
            ['title' => 'Green Living', 'icon' => 'leaf', 'description' => 'Landscaped edges, planted balconies and naturally ventilated homes.'],
            ['title' => 'Prime Connectivity', 'icon' => 'map', 'description' => 'Minutes from schools, hospitals, metro stations and Uttara\'s main roads.'],
            ['title' => 'Professional Care', 'icon' => 'tools', 'description' => 'On-site caretaking and proactive building maintenance all year round.'],
            ['title' => 'Designed for Light', 'icon' => 'sun', 'description' => 'Thoughtful orientations and open layouts that maximise daylight.'],
        ];

        foreach ($amenities as $index => $amenity) {
            Amenity::updateOrCreate(
                ['title' => $amenity['title']],
                $amenity + ['sort_order' => $index + 1, 'is_active' => true]
            );
        }
    }
}
