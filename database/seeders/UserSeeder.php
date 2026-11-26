<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Local development accounts only; rotate credentials before production deployment.
        User::updateOrCreate(
            ['email' => 'admin@ppsdmap.local'],
            [
                'name' => 'Administrator Portal PPSDMAP (Dummy Dev)',
                'role' => 'admin',
                'unit_name' => 'Bagian Tata Usaha',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'humas@ppsdmap.local'],
            [
                'name' => 'Editor Humas dan Kediklatan (Dummy Dev)',
                'role' => 'editor',
                'unit_name' => 'Subbagian Humas dan Informasi',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
    }
}
