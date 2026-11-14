<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@prbholdingsbd.com')],
            [
                'name' => 'PRB Administrator',
                'username' => env('ADMIN_USERNAME', 'prbholdings'),
                'password' => env('ADMIN_PASSWORD', 'Admin@123'),
            ]
        );
    }
}
