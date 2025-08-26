<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Commenté pour éviter les conflits
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Nos seeders spécifiques
        $this->call([
            AboutContentSeeder::class,
            HomeSlidesSeeder::class,
            HomeAboutSeeder::class,
            HomeKeyNumbersSeeder::class,
            HomeRecruitmentSeeder::class,
            ActivitiesPageContentSeeder::class,
            ActivitiesThemesSeeder::class,
            ActivitiesServicesSeeder::class,
            ActivitiesGeographicCoverageSeeder::class,
            ActivitiesTestimonialsSeeder::class,
            ContactSubmissionSeeder::class,
            TeamDetailsSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
