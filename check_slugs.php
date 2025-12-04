<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewsArticle;
use Illuminate\Support\Str;

echo "=== Vérification des slugs des articles ===\n\n";

$articles = NewsArticle::all();
$articlesWithoutSlug = [];
$articlesWithSlug = [];

foreach ($articles as $article) {
    if (empty($article->news_slug)) {
        $articlesWithoutSlug[] = $article;
        echo "❌ ID: {$article->id} - \"{$article->news_title}\" - Type: {$article->news_type} - PAS DE SLUG\n";
    } else {
        $articlesWithSlug[] = $article;
        echo "✅ ID: {$article->id} - \"{$article->news_title}\" - Slug: {$article->news_slug}\n";
    }
}

echo "\n=== RÉSUMÉ ===\n";
echo "Total articles: " . $articles->count() . "\n";
echo "Avec slug: " . count($articlesWithSlug) . "\n";
echo "Sans slug: " . count($articlesWithoutSlug) . "\n";

if (count($articlesWithoutSlug) > 0) {
    echo "\n⚠️ Des articles n'ont pas de slug. Voulez-vous les générer automatiquement ?\n";
    echo "Exécutez: php generate_slugs.php\n";
}
