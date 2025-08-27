<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSlide;

class HomeSlidesSeeder extends Seeder
{
    public function run()
    {
        $slides = [
            [
                'home_slide_number' => '01',
                'home_slide_title' => 'Formulation des programmes<br>et projets de santé',
                'home_slide_description' => 'Nous disposons d\'une expertise internationalement reconnue dans la riposte aux pandémies et aux maladies non transmissibles',
                'home_slide_image' => 'img/23.jpg',
                'home_slide_order' => 1,
                'home_slide_active' => true,
            ],
            [
                'home_slide_number' => '02',
                'home_slide_title' => 'Formulation des programmes<br>et projets de santé',
                'home_slide_description' => 'Nous disposons d\'une expertise internationalement reconnue dans la riposte aux pandémies et aux maladies non transmissibles',
                'home_slide_image' => 'img/24.jpg',
                'home_slide_order' => 2,
                'home_slide_active' => true,
            ]
        ];

        foreach ($slides as $slide) {
            HomeSlide::create($slide);
        }
    }
}
