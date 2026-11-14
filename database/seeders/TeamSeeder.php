<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::query()->delete();

        foreach ($this->members() as $index => $member) {
            TeamMember::create(
                $member + ['is_active' => true, 'sort_order' => $index + 1]
            );
        }
    }

    private function members(): array
    {
        return [
            [
                'name' => 'Md. Abdur Razzak (Razu)',
                'designation' => 'Chairman',
                'category' => 'management',
                'email' => 'chairman@prbholdingsbd.com',
                'image' => 'uploads/teams/md-abdur-razzak-razu.png',
                'bio' => 'Welcome to PRB Holdings. Our journey has always been guided by a single belief — that a home is more than bricks and concrete; it is where trust, comfort and family life come together. Every project we deliver is a promise kept to the people who choose to build their lives with us. I invite you to explore our work and become part of the PRB family.',
            ],
            [
                'name' => 'Md. Sharif Uddin',
                'designation' => 'Managing Director',
                'category' => 'management',
                'email' => 'managingdirector@prbholdingsbd.com',
                'image' => 'uploads/teams/md-sharif-uddin.png',
                'bio' => 'As Managing Director, I oversee the delivery of every PRB project — from planning and approvals to construction and handover. My focus is simple: keep our promises, maintain the highest standards of quality, and make sure every family feels confident in the home they receive.',
            ],
            [
                'name' => 'Md. Mizanur Rahman',
                'designation' => 'Deputy Managing Director',
                'category' => 'management',
                'email' => 'deputymd@prbholdingsbd.com',
                'image' => 'uploads/teams/md-mizanur-rahman.png',
                'bio' => 'I work closely with our engineering and operations teams to ensure that quality, timelines and transparency remain at the heart of every PRB development, so that each address is delivered exactly as promised.',
            ],
            [
                'name' => 'Afroza Parvin',
                'designation' => 'Director',
                'category' => 'management',
                'email' => 'director@prbholdingsbd.com',
                'image' => 'uploads/teams/afroza-parvin.png',
                'bio' => 'As a Director at PRB Holdings, I am committed to strengthening the trust our buyers and partners place in us through responsible growth, careful planning and customer-first decisions.',
            ],
            [
                'name' => 'Afsana Jahan',
                'designation' => 'Director',
                'category' => 'management',
                'email' => 'director2@prbholdingsbd.com',
                'image' => 'uploads/teams/afsana-jahan.png',
                'bio' => 'As a Director at PRB Holdings, I focus on delivering a smooth and transparent experience for every family — from the first conversation to handover and beyond.',
            ],
        ];
    }
}
