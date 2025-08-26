<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\TeamStat;
use App\Models\TeamValue;

class TeamSeeder extends Seeder
{
    public function run()
    {
        // Leadership Team
        Team::create([
            'name' => 'Dr. Marie Kouakou',
            'position' => 'Directrice Exécutive',
            'description' => '15 ans d\'expérience dans le développement communautaire et la gestion de projets sociaux.',
            'type' => 'leadership',
            'order' => 1,
            'is_active' => true
        ]);

        Team::create([
            'name' => 'Jean-Baptiste Traoré',
            'position' => 'Directeur des Programmes',
            'description' => 'Expert en conception et mise en œuvre de programmes éducatifs et sanitaires.',
            'type' => 'leadership',
            'order' => 2,
            'is_active' => true
        ]);

        Team::create([
            'name' => 'Aminata Diallo',
            'position' => 'Directrice des Partenariats',
            'description' => 'Spécialisée dans la mobilisation de ressources et les relations institutionnelles.',
            'type' => 'leadership',
            'order' => 3,
            'is_active' => true
        ]);

        // Operational Team
        for ($i = 1; $i <= 8; $i++) {
            $positions = ['Coordinateur Terrain', 'Responsable Logistique', 'Chargé de Communication', 'Assistant de Programme'];
            Team::create([
                'name' => 'Membre ' . $i,
                'position' => $positions[($i - 1) % 4],
                'description' => 'Spécialisé dans son domaine avec une passion pour l\'impact social.',
                'type' => 'operational',
                'order' => $i,
                'is_active' => true
            ]);
        }

        // Stats
        TeamStat::create([
            'title' => 'Formateurs bénévoles',
            'value' => 15,
            'description' => 'Formateurs bénévoles',
            'order' => 1,
            'is_active' => true
        ]);

        TeamStat::create([
            'title' => 'Animateurs communautaires',
            'value' => 20,
            'description' => 'Animateurs communautaires',
            'order' => 2,
            'is_active' => true
        ]);

        TeamStat::create([
            'title' => 'Support logistique',
            'value' => 15,
            'description' => 'Support logistique',
            'order' => 3,
            'is_active' => true
        ]);

        // Values
        $values = [
            [
                'title' => 'Collaboration',
                'description' => 'Nous travaillons ensemble pour atteindre nos objectifs communs',
                'icon' => 'users',
                'color' => 'blue'
            ],
            [
                'title' => 'Passion',
                'description' => 'Notre engagement pour créer un impact positif nous anime',
                'icon' => 'heart',
                'color' => 'green'
            ],
            [
                'title' => 'Excellence',
                'description' => 'Nous visons l\'excellence dans tout ce que nous entreprenons',
                'icon' => 'check-circle',
                'color' => 'yellow'
            ],
            [
                'title' => 'Innovation',
                'description' => 'Nous cherchons constamment de nouvelles façons d\'améliorer notre impact',
                'icon' => 'lightning',
                'color' => 'purple'
            ]
        ];

        foreach ($values as $index => $value) {
            TeamValue::create([
                'title' => $value['title'],
                'description' => $value['description'],
                'icon' => $value['icon'],
                'color' => $value['color'],
                'order' => $index + 1,
                'is_active' => true
            ]);
        }
    }
}
