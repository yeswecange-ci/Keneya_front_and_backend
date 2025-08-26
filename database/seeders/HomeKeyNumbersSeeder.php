<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeKeyNumber;
use App\Models\HomeKeyNumberStat;

class HomeKeyNumbersSeeder extends Seeder
{
    public function run()
    {
        // Créer la section chiffres clés
        $keyNumber = HomeKeyNumber::create([
            'home_key_numbers_section_title' => 'Nos chiffres clés',
            'home_key_numbers_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum ..',
            'home_key_numbers_image' => 'img/kids.jpg',
            'home_key_numbers_button_text' => 'Découvrir nos domaines d\'intervention',
            'home_key_numbers_button_link' => '#',
            'home_key_numbers_active' => true,
        ]);

        // Créer les statistiques
        $stats = [
            [
                'home_key_number_id' => $keyNumber->id,
                'home_stat_icon' => 'img/6.png',
                'home_stat_number' => 700,
                'home_stat_description' => 'Missions d\'assistance technique mise en oeuvre',
                'home_stat_order' => 1,
                'home_stat_active' => true,
            ],
            [
                'home_key_number_id' => $keyNumber->id,
                'home_stat_icon' => 'img/7.png',
                'home_stat_number' => 50,
                'home_stat_description' => 'Pays africains bénéficiaires',
                'home_stat_order' => 2,
                'home_stat_active' => true,
            ],
            [
                'home_key_number_id' => $keyNumber->id,
                'home_stat_icon' => 'img/8.png',
                'home_stat_number' => 400,
                'home_stat_description' => 'Consultants internationaux mobilisés',
                'home_stat_order' => 3,
                'home_stat_active' => true,
            ]
        ];

        foreach ($stats as $stat) {
            HomeKeyNumberStat::create($stat);
        }
    }
}
