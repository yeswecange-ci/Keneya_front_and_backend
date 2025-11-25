<?php

namespace Database\Seeders;

use App\Models\ActivitiesCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'country_code' => 'BF',
                'country_name' => 'Burkina Faso',
                'description' => 'Nos interventions au Burkina Faso se concentrent sur le renforcement des systèmes de santé et la formation du personnel médical dans les régions rurales.',
                'activities' => [
                    'Formation de 500 agents de santé communautaire',
                    'Mise en place de 15 centres de santé primaires',
                    'Programme de vaccination pour 50 000 enfants',
                    'Renforcement des capacités en santé maternelle et infantile',
                    'Distribution de kits médicaux d\'urgence dans 25 districts'
                ],
                'image' => 'img/countries/burkina-faso.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'country_code' => 'CI',
                'country_name' => 'Côte d\'Ivoire',
                'description' => 'En Côte d\'Ivoire, nous travaillons sur l\'amélioration de l\'accès aux soins de santé et le développement de programmes de prévention.',
                'activities' => [
                    'Formation de 300 professionnels de santé',
                    'Mise en œuvre de programmes de lutte contre le paludisme',
                    'Établissement de 10 unités de soins mobiles',
                    'Campagnes de sensibilisation sur l\'hygiène et la nutrition',
                    'Support technique aux structures sanitaires publiques'
                ],
                'image' => 'img/countries/cote-ivoire.jpg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'country_code' => 'SN',
                'country_name' => 'Sénégal',
                'description' => 'Au Sénégal, nos programmes visent à améliorer la qualité des soins et à renforcer les capacités des professionnels de santé.',
                'activities' => [
                    'Formation continue de 400 médecins et infirmiers',
                    'Développement de systèmes d\'information sanitaire',
                    'Programme de santé reproductive et planning familial',
                    'Renforcement des capacités en gestion hospitalière',
                    'Mise en place de télémédecine dans les zones reculées'
                ],
                'image' => 'img/countries/senegal.jpg',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'country_code' => 'ML',
                'country_name' => 'Mali',
                'description' => 'Au Mali, nous intervenons dans les zones rurales pour améliorer l\'accès aux soins de santé de base et la nutrition.',
                'activities' => [
                    'Formation de 250 sages-femmes',
                    'Programme de nutrition pour 30 000 enfants',
                    'Création de 8 centres de récupération nutritionnelle',
                    'Distribution de moustiquaires imprégnées',
                    'Renforcement du système de référence médical'
                ],
                'image' => 'img/countries/mali.jpg',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'country_code' => 'NE',
                'country_name' => 'Niger',
                'description' => 'Au Niger, nos actions se concentrent sur la lutte contre la malnutrition et le renforcement des infrastructures sanitaires.',
                'activities' => [
                    'Programme de lutte contre la malnutrition infantile',
                    'Formation de 200 agents de santé communautaire',
                    'Réhabilitation de 12 centres de santé',
                    'Campagnes de vaccination de masse',
                    'Support en médicaments essentiels pour 40 structures'
                ],
                'image' => 'img/countries/niger.jpg',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'country_code' => 'TD',
                'country_name' => 'Tchad',
                'description' => 'Au Tchad, nous travaillons sur la réponse aux urgences sanitaires et le renforcement du système de santé.',
                'activities' => [
                    'Formation en gestion des urgences sanitaires',
                    'Mise en place de 6 postes de santé avancés',
                    'Programme de santé maternelle dans 15 districts',
                    'Distribution de kits d\'accouchement sécurisé',
                    'Renforcement des capacités en épidémiologie'
                ],
                'image' => 'img/countries/tchad.jpg',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'country_code' => 'BJ',
                'country_name' => 'Bénin',
                'description' => 'Au Bénin, nous soutenons le développement de la couverture santé universelle et la formation du personnel médical.',
                'activities' => [
                    'Formation de 180 agents de santé',
                    'Programme de prévention des maladies non transmissibles',
                    'Mise en place de mutuelles de santé communautaires',
                    'Support à la décentralisation des services de santé',
                    'Renforcement de la surveillance épidémiologique'
                ],
                'image' => 'img/countries/benin.jpg',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'country_code' => 'TG',
                'country_name' => 'Togo',
                'description' => 'Au Togo, nos interventions portent sur l\'amélioration de la qualité des soins et la santé communautaire.',
                'activities' => [
                    'Formation de 150 professionnels de santé',
                    'Programme de santé scolaire dans 50 établissements',
                    'Mise en place de centres de dépistage VIH',
                    'Support aux programmes de vaccination',
                    'Renforcement des capacités en santé publique'
                ],
                'image' => 'img/countries/togo.jpg',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'country_code' => 'GH',
                'country_name' => 'Ghana',
                'description' => 'Au Ghana, nous collaborons avec les autorités locales pour améliorer la qualité des services de santé.',
                'activities' => [
                    'Formation de 350 professionnels de santé',
                    'Programme de lutte contre les maladies tropicales négligées',
                    'Mise en place de laboratoires d\'analyse médicale',
                    'Support à la recherche en santé publique',
                    'Renforcement des capacités en gestion pharmaceutique'
                ],
                'image' => 'img/countries/ghana.jpg',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'country_code' => 'CM',
                'country_name' => 'Cameroun',
                'description' => 'Au Cameroun, nous intervenons dans la lutte contre les maladies infectieuses et le renforcement des capacités sanitaires.',
                'activities' => [
                    'Formation de 280 agents de santé',
                    'Programme de lutte contre le paludisme',
                    'Mise en place de centres de diagnostic rapide',
                    'Support aux programmes de santé reproductive',
                    'Renforcement des capacités en soins d\'urgence'
                ],
                'image' => 'img/countries/cameroun.jpg',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'country_code' => 'GN',
                'country_name' => 'Guinée',
                'description' => 'En Guinée, nous soutenons la reconstruction du système de santé et la formation des professionnels.',
                'activities' => [
                    'Formation de 220 agents de santé',
                    'Réhabilitation de 10 centres de santé',
                    'Programme de surveillance des maladies à potentiel épidémique',
                    'Support à la vaccination de routine',
                    'Renforcement des capacités en gestion des déchets médicaux'
                ],
                'image' => 'img/countries/guinee.jpg',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'country_code' => 'NG',
                'country_name' => 'Nigeria',
                'description' => 'Au Nigeria, nous travaillons sur des programmes de grande envergure pour améliorer la santé publique.',
                'activities' => [
                    'Formation de 600 professionnels de santé',
                    'Programme de lutte contre la poliomyélite',
                    'Mise en place de systèmes de gestion des données de santé',
                    'Support aux campagnes de vaccination',
                    'Renforcement des capacités en santé maternelle et néonatale'
                ],
                'image' => 'img/countries/nigeria.jpg',
                'order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($countries as $country) {
            ActivitiesCountry::updateOrCreate(
                ['country_code' => $country['country_code']],
                $country
            );
        }
    }
}
