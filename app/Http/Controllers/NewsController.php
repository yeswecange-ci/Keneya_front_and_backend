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

    public function show($slug)
    {
        // Récupérer l'article par son slug
        $article = NewsArticle::where('news_slug', $slug)
            ->where('news_is_active', true)
            ->firstOrFail();

        // Récupérer des articles similaires du même type (excluant l'article actuel)
        $relatedArticles = NewsArticle::active()
            ->byType($article->news_type)
            ->where('id', '!=', $article->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('frontend.news-detail', compact('article', 'relatedArticles'));
    }
}
