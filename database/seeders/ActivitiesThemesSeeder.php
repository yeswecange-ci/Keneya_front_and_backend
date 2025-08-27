<?php

namespace Database\Seeders;

use App\Models\ActivitiesTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'activities_theme_title' => 'Santé reproductive, santé des mères, des nouveau-nés, des enfants et des adolescents',
                'activities_theme_description' => null,
                'activities_theme_icon' => 'img/16.png',
                'activities_theme_order' => 1,
                'activities_theme_is_active' => true,
            ],
            [
                'activities_theme_title' => 'Maladies transmissibles',
                'activities_theme_description' => 'VIH/sida, tuberculose, paludisme, hépatites, maladies infectieuses émergentes',
                'activities_theme_icon' => 'img/17.png',
                'activities_theme_order' => 2,
                'activities_theme_is_active' => true,
            ],
            [
                'activities_theme_title' => 'Maladies non transmissibles',
                'activities_theme_description' => 'Diabète, maladies cardiovasculaires, santé mentale - addictions, cancers, traumatismes liés aux accidents de la route',
                'activities_theme_icon' => 'img/18.png',
                'activities_theme_order' => 3,
                'activities_theme_is_active' => true,
            ],
            [
                'activities_theme_title' => 'Sécurité sanitaire, santé-environnement et changement climatique',
                'activities_theme_description' => 'Approche One Health et règlement sanitaire international ; préparation aux épidémies et réponse aux catastrophes ; résistance microbienne aux antibiotiques ; prévention et contrôle des infections',
                'activities_theme_icon' => 'img/19.png',
                'activities_theme_order' => 4,
                'activities_theme_is_active' => true,
            ],
            [
                'activities_theme_title' => 'Gouvernance et financement de la santé',
                'activities_theme_description' => 'Couverture sanitaire universelle et mutualité sociale, micro-assurance privée ; développement des prestations de services ; développement des ressources humaines en santé ; développement des systèmes d\'information sanitaire ; gestion des approvisionnements et des stocks de produits de santé, vaccins et technologies (GAS, AQ, laboratoires).',
                'activities_theme_icon' => 'img/20.png',
                'activities_theme_order' => 5,
                'activities_theme_is_active' => true,
            ],
        ];

        foreach ($themes as $theme) {
            ActivitiesTheme::create($theme);
        }
    }
}
