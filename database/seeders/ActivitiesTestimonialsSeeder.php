<?php

namespace Database\Seeders;

use App\Models\ActivitiesTestimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesTestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'activities_testimonial_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
                'activities_testimonial_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
                'activities_testimonial_image' => 'img/21.jpg',
                'activities_testimonial_link' => '#',
                'activities_testimonial_order' => 1,
                'activities_testimonial_is_active' => true,
            ],
            [
                'activities_testimonial_title' => 'Impact de nos interventions en santé maternelle',
                'activities_testimonial_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
                'activities_testimonial_image' => 'img/22.jpg',
                'activities_testimonial_link' => '#',
                'activities_testimonial_order' => 2,
                'activities_testimonial_is_active' => true,
            ],
            [
                'activities_testimonial_title' => 'Renforcement des systèmes de santé communautaires',
                'activities_testimonial_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
                'activities_testimonial_image' => 'img/22.jpg',
                'activities_testimonial_link' => '#',
                'activities_testimonial_order' => 3,
                'activities_testimonial_is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            ActivitiesTestimonial::create($testimonial);
        }
    }
}
