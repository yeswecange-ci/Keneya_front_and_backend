<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeRecruitment;

class HomeRecruitmentSeeder extends Seeder
{
    public function run()
    {
        HomeRecruitment::create([
            'home_recruitment_section_title' => 'Venez travailler avec nous',
            'home_recruitment_description' => 'Merci de remplir ce formulaire, afin de postuler pour les positions disponibles dans notre cabinet.',
            'home_recruitment_active' => true,
        ]);
    }
}
