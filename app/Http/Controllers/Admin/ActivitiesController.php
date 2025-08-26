<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivitiesPageContent;
use App\Models\ActivitiesTheme;
use App\Models\ActivitiesService;
use App\Models\ActivitiesGeographicCoverage;
use App\Models\ActivitiesTestimonial;

class ActivitiesController extends Controller
{
    public function index()
    {
        // Récupérer tous les contenus de page
        $pageContents = ActivitiesPageContent::all()->pluck('activities_content_value', 'activities_content_key');

        $themes = ActivitiesTheme::ordered()->get();
        $services = ActivitiesService::ordered()->get();
        $geographicCoverage = ActivitiesGeographicCoverage::first();
        $testimonials = ActivitiesTestimonial::ordered()->get();

        return view('admin.activities.index', compact(
            'pageContents',
            'themes',
            'services',
            'geographicCoverage',
            'testimonials'
        ));
    }

    // Page Content Management
    public function updatePageContent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'themes_section_title' => 'nullable|string|max:255',
            'themes_section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'services_section_title' => 'nullable|string|max:255',
            'contact_button_text' => 'nullable|string|max:50',
            'testimonials_section_title' => 'nullable|string|max:255',
        ]);

        // Mettre à jour chaque champ individuellement
        $fields = [
            'title', 'description', 'hero_title', 'themes_section_title',
            'services_section_title', 'contact_button_text', 'testimonials_section_title'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                ActivitiesPageContent::setContent($field, $request->$field, 'text');
            }
        }

        // Gérer l'image hero
        if ($request->hasFile('hero_image')) {
            $heroImage = $request->file('hero_image');
            $heroImagePath = $heroImage->store('activities', 'public');
            ActivitiesPageContent::setContent('hero_image', 'storage/' . $heroImagePath, 'image');
        }

        // Gérer l'image de section thèmes
        if ($request->hasFile('themes_section_image')) {
            $themesImage = $request->file('themes_section_image');
            $themesImagePath = $themesImage->store('activities', 'public');
            ActivitiesPageContent::setContent('themes_section_image', 'storage/' . $themesImagePath, 'image');
        }

        return redirect()->back()->with('success', 'Contenu de la page mis à jour avec succès.');
    }

    // Theme Management
    public function storeTheme(Request $request)
    {
        $request->validate([
            'activities_theme_title' => 'required|string|max:255',
            'activities_theme_description' => 'nullable|string',
            'activities_theme_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order' => 'nullable|integer|min:0',
        ]);

        $theme = new ActivitiesTheme();
        $theme->activities_theme_title = $request->activities_theme_title;
        $theme->activities_theme_description = $request->activities_theme_description;
        $theme->activities_theme_order = $request->order ?? 0;

        if ($request->hasFile('activities_theme_icon')) {
            $icon = $request->file('activities_theme_icon');
            $iconPath = $icon->store('activities/themes', 'public');
            $theme->activities_theme_icon = 'storage/' . $iconPath;
        }

        $theme->save();

        return redirect()->back()->with('success', 'Thème ajouté avec succès.');
    }

    public function updateTheme(Request $request, $id)
    {
        $request->validate([
            'activities_theme_title' => 'required|string|max:255',
            'activities_theme_description' => 'nullable|string',
            'activities_theme_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order' => 'nullable|integer|min:0',
        ]);

        $theme = ActivitiesTheme::findOrFail($id);
        $theme->activities_theme_title = $request->activities_theme_title;
        $theme->activities_theme_description = $request->activities_theme_description;
        $theme->activities_theme_order = $request->order ?? 0;

        if ($request->hasFile('activities_theme_icon')) {
            // Supprimer l'ancienne icône si elle existe
            if ($theme->activities_theme_icon) {
                Storage::disk('public')->delete(str_replace('storage/', '', $theme->activities_theme_icon));
            }

            $icon = $request->file('activities_theme_icon');
            $iconPath = $icon->store('activities/themes', 'public');
            $theme->activities_theme_icon = 'storage/' . $iconPath;
        }

        $theme->save();

        return redirect()->back()->with('success', 'Thème mis à jour avec succès.');
    }

    public function deleteTheme($id)
    {
        $theme = ActivitiesTheme::findOrFail($id);

        // Supprimer l'icône si elle existe
        if ($theme->activities_theme_icon) {
            Storage::disk('public')->delete(str_replace('storage/', '', $theme->activities_theme_icon));
        }

        $theme->delete();

        return redirect()->back()->with('success', 'Thème supprimé avec succès.');
    }

    // Service Management
    public function storeService(Request $request)
    {
        $request->validate([
            'activities_service_title' => 'required|string|max:255',
            'activities_service_features' => 'nullable|array',
            'activities_service_features.*' => 'string|max:255',
            'activities_service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service = new ActivitiesService();
        $service->activities_service_title = $request->activities_service_title;
        $service->activities_service_order = $request->order ?? 0;
        $service->activities_service_is_active = $request->is_active ?? true;

        // Générer le numéro de service automatiquement
        $lastService = ActivitiesService::orderBy('activities_service_number', 'desc')->first();
        $service->activities_service_number = $lastService ? $lastService->activities_service_number + 1 : 1;

        if ($request->hasFile('activities_service_image')) {
            $image = $request->file('activities_service_image');
            $imagePath = $image->store('activities/services', 'public');
            $service->activities_service_image = 'storage/' . $imagePath;
        }

        if ($request->has('activities_service_features')) {
            $features = array_filter($request->activities_service_features);
            $service->activities_service_features = $features;
        }

        $service->save();

        return redirect()->back()->with('success', 'Service ajouté avec succès.');
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'activities_service_title' => 'required|string|max:255',
            'activities_service_features' => 'nullable|array',
            'activities_service_features.*' => 'string|max:255',
            'activities_service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service = ActivitiesService::findOrFail($id);
        $service->activities_service_title = $request->activities_service_title;
        $service->activities_service_order = $request->order ?? 0;
        $service->activities_service_is_active = $request->is_active ?? true;

        if ($request->hasFile('activities_service_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($service->activities_service_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $service->activities_service_image));
            }

            $image = $request->file('activities_service_image');
            $imagePath = $image->store('activities/services', 'public');
            $service->activities_service_image = 'storage/' . $imagePath;
        }

        if ($request->has('activities_service_features')) {
            $features = array_filter($request->activities_service_features);
            $service->activities_service_features = $features;
        }

        $service->save();

        return redirect()->back()->with('success', 'Service mis à jour avec succès.');
    }

    public function deleteService($id)
    {
        $service = ActivitiesService::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($service->activities_service_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $service->activities_service_image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Service supprimé avec succès.');
    }

    // Geographic Coverage Management
    public function updateGeographicCoverage(Request $request)
    {
        $request->validate([
            'activities_coverage_title' => 'nullable|string|max:255',
            'activities_coverage_description' => 'nullable|string',
            'activities_coverage_map_svg' => 'nullable|string',
        ]);

        $coverage = ActivitiesGeographicCoverage::firstOrNew(['id' => 1]);
        $coverage->activities_geographic_title = $request->activities_coverage_title;
        $coverage->activities_geographic_description = $request->activities_coverage_description;
        $coverage->activities_geographic_map_svg = $request->activities_coverage_map_svg;
        $coverage->save();

        return redirect()->back()->with('success', 'Couverture géographique mise à jour avec succès.');
    }

    // Testimonial Management
    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'activities_testimonial_title' => 'required|string|max:255',
            'activities_testimonial_description' => 'nullable|string',
            'activities_testimonial_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_testimonial_link' => 'nullable|url',
        ]);

        $testimonial = new ActivitiesTestimonial();
        $testimonial->activities_testimonial_title = $request->activities_testimonial_title;
        $testimonial->activities_testimonial_description = $request->activities_testimonial_description;
        $testimonial->activities_testimonial_link = $request->activities_testimonial_link;

        if ($request->hasFile('activities_testimonial_image')) {
            $image = $request->file('activities_testimonial_image');
            $imagePath = $image->store('activities/testimonials', 'public');
            $testimonial->activities_testimonial_image = 'storage/' . $imagePath;
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Témoignage ajouté avec succès.');
    }

    public function updateTestimonial(Request $request, $id)
    {
        $request->validate([
            'activities_testimonial_title' => 'required|string|max:255',
            'activities_testimonial_description' => 'nullable|string',
            'activities_testimonial_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_testimonial_link' => 'nullable|url',
        ]);

        $testimonial = ActivitiesTestimonial::findOrFail($id);
        $testimonial->activities_testimonial_title = $request->activities_testimonial_title;
        $testimonial->activities_testimonial_description = $request->activities_testimonial_description;
        $testimonial->activities_testimonial_link = $request->activities_testimonial_link;

        if ($request->hasFile('activities_testimonial_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($testimonial->activities_testimonial_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $testimonial->activities_testimonial_image));
            }

            $image = $request->file('activities_testimonial_image');
            $imagePath = $image->store('activities/testimonials', 'public');
            $testimonial->activities_testimonial_image = 'storage/' . $imagePath;
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function deleteTestimonial($id)
    {
        $testimonial = ActivitiesTestimonial::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($testimonial->activities_testimonial_image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $testimonial->activities_testimonial_image));
        }

        $testimonial->delete();

        return redirect()->back()->with('success', 'Témoignage supprimé avec succès.');
    }
}
