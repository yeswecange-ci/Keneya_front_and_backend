<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsArticle;

class NewsArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Articles de blog
        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/21.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_BLOG,
            'news_order' => 1,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_BLOG,
            'news_order' => 2,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_BLOG,
            'news_order' => 3,
            'news_is_active' => true,
        ]);

        // Articles d'événements
        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/21.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_EVENT,
            'news_order' => 1,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_EVENT,
            'news_order' => 2,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_EVENT,
            'news_order' => 3,
            'news_is_active' => true,
        ]);

        // Articles de publications
        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/21.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_PUBLICATION,
            'news_order' => 1,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_PUBLICATION,
            'news_order' => 2,
            'news_is_active' => true,
        ]);

        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/22.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_PUBLICATION,
            'news_order' => 3,
            'news_is_active' => true,
        ]);

        // Communiqué de presse
        NewsArticle::create([
            'news_title' => 'Lorem ipsum dolor sit amet dolor sit amet',
            'news_description' => 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.',
            'news_image' => 'img/21.jpg',
            'news_link' => '#',
            'news_type' => NewsArticle::TYPE_PRESS_RELEASE,
            'news_order' => 1,
            'news_is_active' => true,
        ]);
    }
}
