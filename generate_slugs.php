<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewsArticle;
use Illuminate\Support\Str;

echo "=== Génération automatique des slugs ===\n\n";

$articles = NewsArticle::whereNull('news_slug')
    ->orWhere('news_slug', '')
    ->get();

if ($articles->count() === 0) {
    echo "✅ Tous les articles ont déjà un slug.\n";
    exit(0);
}

echo "Articles à traiter: {$articles->count()}\n\n";

$updated = 0;
foreach ($articles as $article) {
    $baseSlug = Str::slug($article->news_title);
    $slug = $baseSlug;
    $counter = 1;

    // Vérifier l'unicité du slug
    while (NewsArticle::where('news_slug', $slug)->where('id', '!=', $article->id)->exists()) {
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }

    $article->news_slug = $slug;
    $article->save();

    echo "✅ ID: {$article->id} - \"{$article->news_title}\" → Slug: {$slug}\n";
    $updated++;
}

echo "\n=== RÉSUMÉ ===\n";
echo "Slugs générés: {$updated}\n";
echo "✅ Terminé !\n";
