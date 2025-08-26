<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\NewsArticle;

class NewsController extends Controller
{
    public function index()
    {
        // Récupérer tous les articles groupés par type
        $blogArticles = NewsArticle::byType(NewsArticle::TYPE_BLOG)->ordered()->get();
        $eventArticles = NewsArticle::byType(NewsArticle::TYPE_EVENT)->ordered()->get();
        $publicationArticles = NewsArticle::byType(NewsArticle::TYPE_PUBLICATION)->ordered()->get();
        $pressReleaseArticles = NewsArticle::byType(NewsArticle::TYPE_PRESS_RELEASE)->ordered()->get();

        return view('admin.news.index', compact(
            'blogArticles',
            'eventArticles',
            'publicationArticles',
            'pressReleaseArticles'
        ));
    }

    public function create()
    {
        $types = NewsArticle::getTypes();
        return view('admin.news.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_title' => 'required|string|max:255',
            'news_description' => 'nullable|string',
            'news_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'news_link' => 'nullable|url',
            'news_type' => 'required|in:' . implode(',', array_keys(NewsArticle::getTypes())),
            'news_is_active' => 'nullable|boolean',
            'news_order' => 'nullable|integer|min:0',
        ]);

        $article = new NewsArticle();
        $article->news_title = $request->news_title;
        $article->news_description = $request->news_description;
        $article->news_link = $request->news_link;
        $article->news_type = $request->news_type;
        $article->news_is_active = $request->news_is_active ?? true;
        $article->news_order = $request->news_order ?? 0;

        if ($request->hasFile('news_image')) {
            $image = $request->file('news_image');
            $imagePath = $image->store('news', 'public');
            $article->news_image = 'storage/' . $imagePath;
        }

        $article->save();

        return redirect()->route('dashboard.actualities')->with('success', 'Article créé avec succès.');
    }

    public function edit($id)
    {
        $article = NewsArticle::findOrFail($id);
        $types = NewsArticle::getTypes();

        return view('admin.news.edit', compact('article', 'types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'news_title' => 'required|string|max:255',
            'news_description' => 'nullable|string',
            'news_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'news_link' => 'nullable|url',
            'news_type' => 'required|in:' . implode(',', array_keys(NewsArticle::getTypes())),
            'news_is_active' => 'nullable|boolean',
            'news_order' => 'nullable|integer|min:0',
        ]);

        $article = NewsArticle::findOrFail($id);
        $article->news_title = $request->news_title;
        $article->news_description = $request->news_description;
        $article->news_link = $request->news_link;
        $article->news_type = $request->news_type;
        $article->news_is_active = $request->news_is_active ?? true;
        $article->news_order = $request->news_order ?? 0;

        if ($request->hasFile('news_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->news_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $article->news_image));
            }

            $image = $request->file('news_image');
            $imagePath = $image->store('news', 'public');
            $article->news_image = 'storage/' . $imagePath;
        }

        $article->save();

        return redirect()->route('dashboard.actualities')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $article = NewsArticle::findOrFail($id);

        // Supprimer l'image associée si elle existe
        if ($article->news_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $article->news_image));
        }

        $article->delete();

        return redirect()->route('dashboard.actualities')->with('success', 'Article supprimé avec succès.');
    }

    public function toggleStatus($id)
    {
        $article = NewsArticle::findOrFail($id);
        $article->news_is_active = !$article->news_is_active;
        $article->save();

        return redirect()->back()->with('success', 'Statut de l\'article modifié avec succès.');
    }
}
