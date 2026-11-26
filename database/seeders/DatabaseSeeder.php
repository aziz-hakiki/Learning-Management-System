<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed baseline dummy data and local development accounts for PPSDMAP.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TrainingProgramSeeder::class,
            ArticleSeeder::class,
            PublicDocumentSeeder::class,
            FaqSeeder::class,
            InquirySeeder::class,
        ]);
    }
}
