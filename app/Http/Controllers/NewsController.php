<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsArticle;

class NewsController extends Controller
{
    public function index()
    {
        // Récupérer les articles par type et actifs seulement
        $blogArticles = NewsArticle::active()
            ->byType(NewsArticle::TYPE_BLOG)
            ->ordered()
            ->get();

        $eventArticles = NewsArticle::active()
            ->byType(NewsArticle::TYPE_EVENT)
            ->ordered()
            ->get();

        $publicationArticles = NewsArticle::active()
            ->byType(NewsArticle::TYPE_PUBLICATION)
            ->ordered()
            ->get();

        $pressReleaseArticles = NewsArticle::active()
            ->byType(NewsArticle::TYPE_PRESS_RELEASE)
            ->ordered()
            ->get();

        return view('frontend.news', compact(
            'blogArticles',
            'eventArticles',
            'publicationArticles',
            'pressReleaseArticles'
        ));
    }
}
