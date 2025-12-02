<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeServicesSection;
use App\Models\HomeTargetAudienceSection;
use App\Models\HomeTargetAudienceItem;
use App\Models\HomeUniqueApproachSection;
use App\Models\HomeUniqueApproachItem;
use App\Models\HomeTeamSection;
use App\Models\HomeExpertSpaceSection;

class HomeNewSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Section Services
        HomeServicesSection::create([
            'title' => 'Notre offre de services en santé et protection sociale',
            'description' => 'KENAYA Impact propose une gamme complète de services d\'assistance technique en santé publique et protection sociale, adaptés aux besoins spécifiques de chaque partenaire. Nos interventions couvrent l\'ensemble du cycle de projet, de la conception stratégique à l\'évaluation, en passant par la mise en œuvre et le suivi-évaluation.',
            'image' => 'images/doc1.png',
            'active' => true,
        ]);

        // 2. Section Public Cible
        $targetAudience = HomeTargetAudienceSection::create([
            'title' => 'À qui s\'adresse notre assistance technique ?',
            'description' => 'KENAYA Impact accompagne un large éventail d\'acteurs du secteur de la santé, notamment :',
            'outro_description' => 'À travers nos services, nous contribuons à la conception, la mise en œuvre et l\'évaluation de programmes de santé générateurs d\'impact durable, apportant des réponses solides aux défis sanitaires prioritaires du continent africain.',
            'image' => 'images/kids.jpg',
            'button_text' => 'En savoir plus',
            'button_link' => '/activities',
            'active' => true,
        ]);

        // Items Public Cible
        $targetItems = [
            'Institutions internationales',
            'Instances gouvernementales et ministères',
            'Organisations non gouvernementales',
            'Organisations de la société civile',
            'Acteurs du secteur privé',
        ];

        foreach ($targetItems as $index => $item) {
            HomeTargetAudienceItem::create([
                'home_target_audience_section_id' => $targetAudience->id,
                'item_text' => $item,
                'order' => $index + 1,
                'active' => true,
            ]);
        }

        // 3. Section Approche Unique
        $uniqueApproach = HomeUniqueApproachSection::create([
            'title' => 'Notre approche unique',
            'description_intro' => 'KENAYA Impact s\'appuie sur une connaissance profonde du contexte socio-économique et culturel africain pour concevoir des solutions pratiques, culturellement adaptées et économiquement viables.',
            'description_middle' => 'Nous mobilisons un réseau d\'experts locaux et internationaux pour relever les défis majeurs de santé publique, tout en assurant la pleine participation des parties prenantes, en particulier les populations vulnérables et usagers de la santé. Nos interventions intègrent systématiquement :',
            'description_outro' => 'Nous développons également des programmes originaux dans des domaines peu ou pas couverts en Afrique, avec une envergure et une échelle permettant un impact réel là où il est nécessaire.',
            'image' => 'images/doc1.png',
            'active' => true,
        ]);

        // Items Approche Unique
        $approachItems = [
            'Genre et droits humains',
            'Durabilité et impact à long terme',
            'Innovation et adaptation au contexte local',
        ];

        foreach ($approachItems as $index => $item) {
            HomeUniqueApproachItem::create([
                'home_unique_approach_section_id' => $uniqueApproach->id,
                'item_text' => $item,
                'order' => $index + 1,
                'active' => true,
            ]);
        }

        // 4. Section Équipe
        HomeTeamSection::create([
            'title' => 'Notre équipe',
            'description' => 'KENAYA Impact rassemble une équipe multidisciplinaire, combinant expertise locale et internationale, pour relever les défis majeurs de santé publique. Chaque membre contribue à la conception, la mise en œuvre et l\'évaluation de programmes innovants, avec un engagement fort pour la qualité, l\'impact et la durabilité.',
            'image' => 'images/9.png',
            'active' => true,
        ]);

        // 5. Section Espace Expert
        HomeExpertSpaceSection::create([
            'title' => 'L\'espace expert',
            'description' => 'Rejoignez notre réseau d\'experts pour participer à des projets innovants et durables en Afrique. Créez votre profil dès aujourd\'hui et mettez votre expertise au service des systèmes de santé et des communautés. Cliquez sur le bouton ci-dessous pour accéder au site de création de votre CV et intégrer notre pool d\'experts.',
            'button_text' => 'Rejoindre notre pool d\'experts',
            'button_link' => '/team-details',
            'image' => 'images/doc.png',
            'active' => true,
        ]);
    }
}
