<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivitiesCountry;
use Illuminate\Support\Facades\DB;

class AfricanCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider la table d'abord pour éviter les doublons
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ActivitiesCountry::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $africanCountries = [
            // Afrique du Nord
            ['code' => 'DZ', 'name' => 'Algérie', 'color' => '#006233', 'region' => 'Afrique du Nord'],
            ['code' => 'EG', 'name' => 'Égypte', 'color' => '#CE1126', 'region' => 'Afrique du Nord'],
            ['code' => 'LY', 'name' => 'Libye', 'color' => '#239E46', 'region' => 'Afrique du Nord'],
            ['code' => 'MA', 'name' => 'Maroc', 'color' => '#C1272D', 'region' => 'Afrique du Nord'],
            ['code' => 'TN', 'name' => 'Tunisie', 'color' => '#E70013', 'region' => 'Afrique du Nord'],
            ['code' => 'SD', 'name' => 'Soudan', 'color' => '#007229', 'region' => 'Afrique du Nord'],
            ['code' => 'SS', 'name' => 'Soudan du Sud', 'color' => '#078930', 'region' => 'Afrique du Nord'],

            // Afrique de l'Ouest
            ['code' => 'BJ', 'name' => 'Bénin', 'color' => '#FCD116', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'BF', 'name' => 'Burkina Faso', 'color' => '#EF2B2D', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'CV', 'name' => 'Cap-Vert', 'color' => '#003893', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'CI', 'name' => 'Côte d\'Ivoire', 'color' => '#F77F00', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'GM', 'name' => 'Gambie', 'color' => '#CE1126', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'GH', 'name' => 'Ghana', 'color' => '#006B3F', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'GN', 'name' => 'Guinée', 'color' => '#CE1126', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'GW', 'name' => 'Guinée-Bissau', 'color' => '#CE1126', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'LR', 'name' => 'Liberia', 'color' => '#006B3F', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'ML', 'name' => 'Mali', 'color' => '#14B53A', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'MR', 'name' => 'Mauritanie', 'color' => '#006233', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'NE', 'name' => 'Niger', 'color' => '#E05206', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'NG', 'name' => 'Nigeria', 'color' => '#008751', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'SN', 'name' => 'Sénégal', 'color' => '#00853F', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'SL', 'name' => 'Sierra Leone', 'color' => '#1EB53A', 'region' => 'Afrique de l\'Ouest'],
            ['code' => 'TG', 'name' => 'Togo', 'color' => '#FFD100', 'region' => 'Afrique de l\'Ouest'],

            // Afrique Centrale
            ['code' => 'AO', 'name' => 'Angola', 'color' => '#CC092F', 'region' => 'Afrique Centrale'],
            ['code' => 'CM', 'name' => 'Cameroun', 'color' => '#007A5E', 'region' => 'Afrique Centrale'],
            ['code' => 'CF', 'name' => 'République centrafricaine', 'color' => '#003082', 'region' => 'Afrique Centrale'],
            ['code' => 'TD', 'name' => 'Tchad', 'color' => '#002664', 'region' => 'Afrique Centrale'],
            ['code' => 'CG', 'name' => 'République du Congo', 'color' => '#009543', 'region' => 'Afrique Centrale'],
            ['code' => 'CD', 'name' => 'République démocratique du Congo', 'color' => '#007FFF', 'region' => 'Afrique Centrale'],
            ['code' => 'GQ', 'name' => 'Guinée équatoriale', 'color' => '#3E9A00', 'region' => 'Afrique Centrale'],
            ['code' => 'GA', 'name' => 'Gabon', 'color' => '#009E60', 'region' => 'Afrique Centrale'],
            ['code' => 'ST', 'name' => 'Sao Tomé-et-Principe', 'color' => '#12AD2B', 'region' => 'Afrique Centrale'],

            // Afrique de l'Est
            ['code' => 'BI', 'name' => 'Burundi', 'color' => '#CE1126', 'region' => 'Afrique de l\'Est'],
            ['code' => 'KM', 'name' => 'Comores', 'color' => '#3A75C4', 'region' => 'Afrique de l\'Est'],
            ['code' => 'DJ', 'name' => 'Djibouti', 'color' => '#6AB2E7', 'region' => 'Afrique de l\'Est'],
            ['code' => 'ER', 'name' => 'Érythrée', 'color' => '#EA0437', 'region' => 'Afrique de l\'Est'],
            ['code' => 'ET', 'name' => 'Éthiopie', 'color' => '#078930', 'region' => 'Afrique de l\'Est'],
            ['code' => 'KE', 'name' => 'Kenya', 'color' => '#006600', 'region' => 'Afrique de l\'Est'],
            ['code' => 'MG', 'name' => 'Madagascar', 'color' => '#FC3D32', 'region' => 'Afrique de l\'Est'],
            ['code' => 'MW', 'name' => 'Malawi', 'color' => '#CE1126', 'region' => 'Afrique de l\'Est'],
            ['code' => 'MU', 'name' => 'Maurice', 'color' => '#EA2839', 'region' => 'Afrique de l\'Est'],
            ['code' => 'MZ', 'name' => 'Mozambique', 'color' => '#007168', 'region' => 'Afrique de l\'Est'],
            ['code' => 'RW', 'name' => 'Rwanda', 'color' => '#00A1DE', 'region' => 'Afrique de l\'Est'],
            ['code' => 'SC', 'name' => 'Seychelles', 'color' => '#003F87', 'region' => 'Afrique de l\'Est'],
            ['code' => 'SO', 'name' => 'Somalie', 'color' => '#4189DD', 'region' => 'Afrique de l\'Est'],
            ['code' => 'TZ', 'name' => 'Tanzanie', 'color' => '#1EB53A', 'region' => 'Afrique de l\'Est'],
            ['code' => 'UG', 'name' => 'Ouganda', 'color' => '#FCDC04', 'region' => 'Afrique de l\'Est'],
            ['code' => 'ZM', 'name' => 'Zambie', 'color' => '#198A00', 'region' => 'Afrique de l\'Est'],
            ['code' => 'ZW', 'name' => 'Zimbabwe', 'color' => '#006B3F', 'region' => 'Afrique de l\'Est'],

            // Afrique Australe
            ['code' => 'BW', 'name' => 'Botswana', 'color' => '#75AADB', 'region' => 'Afrique Australe'],
            ['code' => 'LS', 'name' => 'Lesotho', 'color' => '#00209F', 'region' => 'Afrique Australe'],
            ['code' => 'NA', 'name' => 'Namibie', 'color' => '#003580', 'region' => 'Afrique Australe'],
            ['code' => 'ZA', 'name' => 'Afrique du Sud', 'color' => '#007A4D', 'region' => 'Afrique Australe'],
            ['code' => 'SZ', 'name' => 'Eswatini', 'color' => '#3E5EB9', 'region' => 'Afrique Australe'],
        ];

        $order = 1;
        foreach ($africanCountries as $country) {
            ActivitiesCountry::create([
                'country_code' => $country['code'],
                'country_name' => $country['name'],
                'color' => $country['color'],
                'description' => "Pays situé en {$country['region']}.",
                'activities' => [],
                'order' => $order++,
                'is_active' => true,
            ]);
        }

        $this->command->info('✅ ' . count($africanCountries) . ' pays africains ont été créés avec succès!');
    }
}
