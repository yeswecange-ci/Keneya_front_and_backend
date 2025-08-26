<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSubmission;
use Carbon\Carbon;

class ContactSubmissionSeeder extends Seeder
{
    public function run()
    {
        $submissions = [
            [
                'first_name' => 'Jean',
                'last_name' => 'Dupont',
                'email' => 'jean.dupont@example.com',
                'phone' => '+225 01 02 03 04 05',
                'desired_position' => 'Développeur',
                'availability_date' => Carbon::now()->addDays(30),
                'cv_path' => null,
                'message' => null,
                'type' => 'application'
            ],
            [
                'first_name' => 'Marie',
                'last_name' => 'Martin',
                'email' => 'marie.martin@example.com',
                'phone' => '+225 05 04 03 02 01',
                'desired_position' => 'Designer',
                'availability_date' => Carbon::now()->addDays(15),
                'cv_path' => null,
                'message' => null,
                'type' => 'application'
            ],
            [
                'first_name' => 'Pierre',
                'last_name' => 'Durand',
                'email' => 'pierre.durand@example.com',
                'phone' => '+225 07 08 09 10 11',
                'desired_position' => null,
                'availability_date' => null,
                'cv_path' => null,
                'message' => 'Je souhaite obtenir un devis pour un site web e-commerce.',
                'type' => 'quote'
            ]
        ];

        foreach ($submissions as $submission) {
            ContactSubmission::create($submission);
        }
    }
}
