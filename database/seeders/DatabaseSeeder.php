<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EducationStageSeeder;
use Database\Seeders\FeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            // UserSeeder::class,
            GallerySeeder::class,
            VideoSeeder::class,
            OneAboutSeeder::class,
            TwoAboutSeeder::class,
            WhyChooseUsSeeder::class,
            EducationStageSeeder::class,
            FeeSeeder::class,
            CampusTourSeeder::class,
            HowWeWelcomeChildSeeder::class,
            TestimonialSeeder::class,
            PrincipalMessageSeeder::class,
            SchoolDisciplinePolicySeeder::class,
            QualityAssuranceFileSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
