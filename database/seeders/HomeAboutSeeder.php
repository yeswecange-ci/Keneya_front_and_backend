<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeAbout;

class HomeAboutSeeder extends Seeder
{
    public function run()
    {
        HomeAbout::create([
            'home_about_section_title' => 'À propos de nous',
            'home_about_main_title' => 'Créé en 2012 sous l\'impulsion du <br> Dr. Jean-Baptiste Guiard-Schmid,',
            'home_about_description' => '<strong>KENAYA Impact</strong> (anciennement appelée Initiatives Conseil International-Santé (ICI-Santé)) est un leader Africain dans l\'assistance technique pour faire émerger des solutions de santé publique innovantes et durables.',
            'home_about_button_text' => 'En savoir plus',
            'home_about_button_link' => '#',
            'home_about_active' => true,
        ]);
    }
}
