<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@prbholdingsbd.com')],
            [
                'name' => 'PRB Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'prb@2026')),
            ]
        );
    }
}
