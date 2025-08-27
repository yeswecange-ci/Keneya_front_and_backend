<?php

namespace Database\Seeders;

use App\Models\ActivitiesPageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesPageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
                'activities_content_key' => 'header_title',
                'activities_content_value' => 'Nos activités',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Titre principal de la page activités'
            ],
            [
                'activities_content_key' => 'header_background_image',
                'activities_content_value' => 'img/24.jpg',
                'activities_content_type' => 'image',
                'activities_content_description' => 'Image de fond de l\'en-tête'
            ],
            [
                'activities_content_key' => 'themes_section_title',
                'activities_content_value' => 'Domaines thématiques en santé publique',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Titre de la section des domaines thématiques'
            ],
            [
                'activities_content_key' => 'themes_section_image',
                'activities_content_value' => 'img/15.jpg',
                'activities_content_type' => 'image',
                'activities_content_description' => 'Image de la section des domaines thématiques'
            ],
            [
                'activities_content_key' => 'contact_button_text',
                'activities_content_value' => 'Contactez nous',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Texte du bouton de contact'
            ],
            [
                'activities_content_key' => 'contact_button_url',
                'activities_content_value' => '#',
                'activities_content_type' => 'url',
                'activities_content_description' => 'URL du bouton de contact'
            ],
            [
                'activities_content_key' => 'services_section_title',
                'activities_content_value' => 'Notre offre de services en santé et protection sociale',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Titre de la section des services'
            ],
            [
                'activities_content_key' => 'testimonials_section_title',
                'activities_content_value' => 'Études de cas/témoignages',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Titre de la section des témoignages'
            ],
            [
                'activities_content_key' => 'page_title',
                'activities_content_value' => 'Activités - Keneya',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Titre de la page (balise title)'
            ],
            [
                'activities_content_key' => 'page_description',
                'activities_content_value' => 'Découvrez nos différentes activités et programmes pour le développement communautaire.',
                'activities_content_type' => 'text',
                'activities_content_description' => 'Description de la page (meta description)'
            ]
        ];

        foreach ($contents as $content) {
            ActivitiesPageContent::create($content);
        }
    }
}
