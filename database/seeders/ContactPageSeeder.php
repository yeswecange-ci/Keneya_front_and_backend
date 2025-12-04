<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactPage;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::create([
            'image' => 'img/9.png',
            'text_above_image_fr' => 'Contactez-nous pour plus d\'informations',
            'text_above_image_en' => 'Contact us for more information',
            'text_above_image_es' => 'Contáctenos para más información',
            'location_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16801.114518740127!2d-3.9994224484780414!3d5.312937414646711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebf60b2e34af%3A0xa62c41360300c47!2sMarcory%20Residentiel%2C%20Abidjan!5e1!3m2!1sfr!2sci!4v1754061918651!5m2!1sfr!2sci',
            'location_text_fr' => 'Où nous trouver',
            'location_text_en' => 'Find us',
            'location_text_es' => 'Encuéntranos',
        ]);
    }
}
