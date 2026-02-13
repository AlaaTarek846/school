<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            GallerySeeder::class,
            VideoSeeder::class,
            OneAboutSeeder::class,
            TwoAboutSeeder::class,
            WhyChooseUsSeeder::class,
            CampusTourSeeder::class,
            HowWeWelcomeChildSeeder::class,
            TestimonialSeeder::class,
            PrincipalMessageSeeder::class,
            SchoolDisciplinePolicySeeder::class,
            QualityAssuranceFileSeeder::class,
        ]);
    }
}
