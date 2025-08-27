<?php

namespace Database\Seeders;

use App\Models\ActivitiesService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'activities_service_number' => '01',
                'activities_service_title' => 'Conseil stratégique, analyses, diagnostics et revues en santé et protection sociale',
                'activities_service_features' => [
                    'Diagnostic et renforcement des systèmes de santé et protection sociale',
                    'Élaboration, revue et évaluation de politiques et stratégies ; plans opérationnels et de suivi-évaluation',
                    'Développement d\'approches multi-maladies intégrées',
                    'Développement de systèmes de santé communautaires efficaces'
                ],
                'activities_service_image' => 'img/12.jpg',
                'activities_service_order' => 1,
                'activities_service_is_active' => true,
            ],
            [
                'activities_service_number' => '02',
                'activities_service_title' => 'Formation et renforcement des capacités',
                'activities_service_features' => [
                    'Formation du personnel de santé aux nouvelles procédures',
                    'Renforcement des capacités institutionnelles',
                    'Développement de programmes de formation continue',
                    'Encadrement technique et supervision'
                ],
                'activities_service_image' => 'img/12.jpg',
                'activities_service_order' => 2,
                'activities_service_is_active' => true,
            ],
            [
                'activities_service_number' => '03',
                'activities_service_title' => 'Accompagnement technique et mise en œuvre',
                'activities_service_features' => [
                    'Assistance technique pour la mise en place de programmes',
                    'Suivi-évaluation des projets de santé publique',
                    'Gestion de projets multi-sectoriels',
                    'Coordination avec les partenaires locaux et internationaux'
                ],
                'activities_service_image' => 'img/12.jpg',
                'activities_service_order' => 3,
                'activities_service_is_active' => true,
            ]
        ];

        foreach ($services as $service) {
            ActivitiesService::create($service);
        }
    }
}
