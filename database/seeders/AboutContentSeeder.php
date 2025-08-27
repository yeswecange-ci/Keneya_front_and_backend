<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutMainSection;
use App\Models\AboutAccordionItem;
use App\Models\AboutTransitionSection;
use App\Models\AboutTransitionListItem;
use App\Models\AboutTeamMember;

class AboutContentSeeder extends Seeder
{
    public function run()
    {
        // Seeder pour la section principale
        AboutMainSection::create([
            'about_title' => 'À propos de nous',
            'about_description_1' => 'Créé en 2012 sous l\'impulsion du Dr. Jean-Baptiste Guiard-Schmid, KENAYA Impact (anciennement appelée Initiatives Conseil International-Santé (ICI-Santé)) est un leader Africain dans l\'assistance technique pour faire émerger des solutions de santé publique innovantes et durables.',
            'about_description_2' => 'KENAYA Impact est fondé sur la conviction qu\'il est vital de développer et renforcer l\'expertise Africaine dans le domaine de la santé, afin de la porter au plus haut niveau d\'excellence afin de la mettre au service de la santé des habitants du continent.',
            'about_description_3' => 'KENAYA Impact dispose d\'une expertise internationalement reconnue dans la riposte aux pandémies et aux maladies non transmissibles, ainsi que dans le renforcement de systèmes de santé durables en Afrique.',
            'about_description_4' => 'Son équipe et ses experts participent, à un niveau élevé, aux instances décisionnelles et de réforme sectorielle du secteur de la santé aux plans international, régional, national et local. Avec un siège situé à Ouagadougou (Burkina Faso), KENAYA Impact dispose déjà de représentations au Mali, au Niger, au Nigéria et au Tchad.',
            'about_image_path' => 'img/10.jpg',
            'about_button_text' => 'Découvrir nos domaines d\'intervention',
            'about_button_link' => '#',
            'about_is_active' => true
        ]);

        // Seeder pour les items de l'accordion
        $accordionItems = [
            [
                'about_accordion_title' => 'Mission',
                'about_accordion_content' => 'Mobiliser et mettre à disposition l\'expertise pour la conception, le développement, la mise en œuvre et le suivi-évaluation des réponses adaptées aux problèmes de santé des populations.',
                'about_accordion_order' => 1,
                'about_accordion_is_active' => true
            ],
            [
                'about_accordion_title' => 'Vision',
                'about_accordion_content' => 'Notre vision ici…',
                'about_accordion_order' => 2,
                'about_accordion_is_active' => true
            ],
            [
                'about_accordion_title' => 'Valeurs',
                'about_accordion_content' => 'Nos valeurs ici…',
                'about_accordion_order' => 3,
                'about_accordion_is_active' => true
            ]
        ];

        foreach ($accordionItems as $item) {
            AboutAccordionItem::create($item);
        }

        // Seeder pour la section transition
        $transitionSection = AboutTransitionSection::create([
            'about_transition_title' => 'Transition ICI-Santé Kenaya Impact',
            'about_transition_description_1' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum .',
            'about_transition_description_2' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum ..',
            'about_transition_image_path' => 'img/11.jpg',
            'about_transition_is_active' => true
        ]);

        // Seeder pour les items de liste de la section transition
        $transitionListItems = [
            [
                'about_transition_section_id' => $transitionSection->id,
                'about_transition_list_content' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pr',
                'about_transition_list_order' => 1,
                'about_transition_list_is_active' => true
            ],
            [
                'about_transition_section_id' => $transitionSection->id,
                'about_transition_list_content' => 'etium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet.',
                'about_transition_list_order' => 2,
                'about_transition_list_is_active' => true
            ],
            [
                'about_transition_section_id' => $transitionSection->id,
                'about_transition_list_content' => 'Massa scelerisque pellentesque condimentum',
                'about_transition_list_order' => 3,
                'about_transition_list_is_active' => true
            ]
        ];

        foreach ($transitionListItems as $item) {
            AboutTransitionListItem::create($item);
        }

        // Seeder pour l'équipe
        $teamMembers = [
            [
                'about_team_name' => 'DR JEAN-BAPTISTE GUIARD-SCHMID',
                'about_team_position' => 'Directeur Général',
                'about_team_image_path' => 'img/12.jpg',
                'about_team_detail_link' => 'team-details.html',
                'about_team_order' => 1,
                'about_team_is_active' => true
            ],
            [
                'about_team_name' => 'DR BENOIT KAFANDO',
                'about_team_position' => 'Directeur des Programmes',
                'about_team_image_path' => 'img/13.jpg',
                'about_team_detail_link' => 'team-details.html',
                'about_team_order' => 2,
                'about_team_is_active' => true
            ],
            [
                'about_team_name' => 'MARTIAL SIDWAYAN ZONGO',
                'about_team_position' => 'Directeur Administratif et Financier',
                'about_team_image_path' => 'img/14.jpg',
                'about_team_detail_link' => 'team-details.html',
                'about_team_order' => 3,
                'about_team_is_active' => true
            ]
        ];

        foreach ($teamMembers as $member) {
            AboutTeamMember::create($member);
        }
    }
}
