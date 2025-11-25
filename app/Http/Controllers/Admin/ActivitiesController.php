<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivitiesCountry;
use App\Models\ActivitiesGeographicCoverage;
use App\Models\ActivitiesKeyNumber;
use App\Models\ActivitiesPageContent;
use App\Models\ActivitiesService;
use App\Models\ActivitiesTestimonial;
use App\Models\ActivitiesTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
{
    public function index()
    {
        // Récupérer tous les contenus de page
        $pageContents = ActivitiesPageContent::all()->pluck('activities_content_value', 'activities_content_key');

        $themes             = ActivitiesTheme::orderBy('activities_theme_order')->get();
        $services           = ActivitiesService::orderBy('activities_service_order')->get();
        $geographicCoverage = ActivitiesGeographicCoverage::first();
        $testimonials       = ActivitiesTestimonial::orderBy('created_at', 'desc')->get();
        $keyNumbers         = ActivitiesKeyNumber::orderBy('activities_keynumber_order')->get();
        $countries          = ActivitiesCountry::ordered()->get();

        return view('admin.activities.index', compact(
            'pageContents',
            'themes',
            'services',
            'geographicCoverage',
            'testimonials',
            'keyNumbers',
            'countries'
        ));
    }

    // Page Content Management
    public function updatePageContent(Request $request)
    {
        $validated = $request->validate([
            'title'                      => 'nullable|string|max:255',
            'description'                => 'nullable|string',
            'hero_title'                 => 'nullable|string|max:255',
            'hero_image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'themes_section_title'       => 'nullable|string|max:255',
            'themes_section_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'services_section_title'     => 'nullable|string|max:255',
            'contact_button_text'        => 'nullable|string|max:50',
            'contact_button_url'         => 'nullable|url|max:255',
            'testimonials_section_title' => 'nullable|string|max:255',
        ]);

        // Mettre à jour chaque champ individuellement
        $fields = [
            'title', 'description', 'hero_title', 'themes_section_title',
            'services_section_title', 'contact_button_text', 'contact_button_url', 'testimonials_section_title',
        ];

        foreach ($fields as $field) {
            if ($request->has($field) && !empty($request->$field)) {
                ActivitiesPageContent::setContent($field, $request->$field, 'text');
            }
        }

        // Gérer l'image hero
        if ($request->hasFile('hero_image')) {
            $heroImage     = $request->file('hero_image');
            $heroImagePath = $heroImage->store('activities', 'public');
            ActivitiesPageContent::setContent('hero_image', 'storage/' . $heroImagePath, 'image');
        }

        // Gérer l'image de section thèmes
        if ($request->hasFile('themes_section_image')) {
            $themesImage     = $request->file('themes_section_image');
            $themesImagePath = $themesImage->store('activities', 'public');
            ActivitiesPageContent::setContent('themes_section_image', 'storage/' . $themesImagePath, 'image');
        }

        return redirect()->back()->with('success', 'Contenu de la page mis à jour avec succès.');
    }

    // Theme Management
    public function storeTheme(Request $request)
    {
        $request->validate([
            'activities_theme_title'       => 'required|string|max:255',
            'activities_theme_description' => 'nullable|string',
            'activities_theme_icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'activities_theme_order'       => 'nullable|integer|min:0',
        ]);

        $theme                               = new ActivitiesTheme();
        $theme->activities_theme_title       = $request->activities_theme_title;
        $theme->activities_theme_description = $request->activities_theme_description;
        $theme->activities_theme_order       = $request->activities_theme_order ?? 0;

        if ($request->hasFile('activities_theme_icon')) {
            $icon                         = $request->file('activities_theme_icon');
            $iconPath                     = $icon->store('activities/themes', 'public');
            $theme->activities_theme_icon = 'storage/' . $iconPath;
        }

        $theme->save();

        return redirect()->back()->with('success', 'Thème ajouté avec succès.');
    }

    public function updateTheme(Request $request, $id)
    {
        $request->validate([
            'activities_theme_title'       => 'required|string|max:255',
            'activities_theme_description' => 'nullable|string',
            'activities_theme_icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'activities_theme_order'       => 'nullable|integer|min:0',
        ]);

        $theme                               = ActivitiesTheme::findOrFail($id);
        $theme->activities_theme_title       = $request->activities_theme_title;
        $theme->activities_theme_description = $request->activities_theme_description;
        $theme->activities_theme_order       = $request->activities_theme_order ?? 0;

        if ($request->hasFile('activities_theme_icon')) {
            // Supprimer l'ancienne icône si elle existe
            if ($theme->activities_theme_icon) {
                Storage::disk('public')->delete(str_replace('storage/', '', $theme->activities_theme_icon));
            }

            $icon                         = $request->file('activities_theme_icon');
            $iconPath                     = $icon->store('activities/themes', 'public');
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

    // Service Management - CORRIGÉ pour correspondre à votre table
    public function storeService(Request $request)
    {
        $request->validate([
            'activities_service_title'      => 'required|string|max:255',
            'activities_service_features'   => 'nullable|array',
            'activities_service_features.*' => 'string|max:255',
            'activities_service_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_service_order'      => 'nullable|integer|min:0',
            'is_active'                     => 'nullable|boolean',
        ]);

        $service                               = new ActivitiesService();
        $service->activities_service_title     = $request->activities_service_title;
        $service->activities_service_order     = $request->activities_service_order ?? 0;
        $service->activities_service_is_active = $request->is_active ?? true;

        // Générer le numéro de service automatiquement
        $lastService = ActivitiesService::orderBy('activities_service_number', 'desc')->first();
        $service->activities_service_number = $lastService ? $lastService->activities_service_number + 1 : 1;

        if ($request->hasFile('activities_service_image')) {
            $image                             = $request->file('activities_service_image');
            $imagePath                         = $image->store('activities/services', 'public');
            $service->activities_service_image = 'storage/' . $imagePath;
        }

        if ($request->has('activities_service_features')) {
            $features = array_filter($request->activities_service_features);
            $service->activities_service_features = !empty($features) ? $features : null;
        }

        $service->save();

        return redirect()->back()->with('success', 'Service ajouté avec succès.');
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'activities_service_title'      => 'required|string|max:255',
            'activities_service_features'   => 'nullable|array',
            'activities_service_features.*' => 'string|max:255',
            'activities_service_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_service_order'      => 'nullable|integer|min:0',
            'is_active'                     => 'nullable|boolean',
        ]);

        $service                               = ActivitiesService::findOrFail($id);
        $service->activities_service_title     = $request->activities_service_title;
        $service->activities_service_order     = $request->activities_service_order ?? 0;
        $service->activities_service_is_active = $request->is_active ?? true;

        if ($request->hasFile('activities_service_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($service->activities_service_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $service->activities_service_image));
            }

            $image                             = $request->file('activities_service_image');
            $imagePath                         = $image->store('activities/services', 'public');
            $service->activities_service_image = 'storage/' . $imagePath;
        }

        if ($request->has('activities_service_features')) {
            $features = array_filter($request->activities_service_features);
            $service->activities_service_features = !empty($features) ? $features : null;
        } else {
            $service->activities_service_features = null;
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
            'activities_coverage_title'       => 'nullable|string|max:255',
            'activities_coverage_description' => 'nullable|string',
            'activities_coverage_map_svg'     => 'nullable|string',
        ]);

        $coverage                                    = ActivitiesGeographicCoverage::firstOrNew(['id' => 1]);
        $coverage->activities_geographic_title       = $request->activities_coverage_title;
        $coverage->activities_geographic_description = $request->activities_coverage_description;
        $coverage->activities_geographic_map_svg     = $request->activities_coverage_map_svg;
        $coverage->save();

        return redirect()->back()->with('success', 'Couverture géographique mise à jour avec succès.');
    }

    // Testimonial Management
    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'activities_testimonial_title'       => 'required|string|max:255',
            'activities_testimonial_description' => 'nullable|string',
            'activities_testimonial_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_testimonial_link'        => 'nullable|url',
        ]);

        $testimonial                                     = new ActivitiesTestimonial();
        $testimonial->activities_testimonial_title       = $request->activities_testimonial_title;
        $testimonial->activities_testimonial_description = $request->activities_testimonial_description;
        $testimonial->activities_testimonial_link        = $request->activities_testimonial_link;

        if ($request->hasFile('activities_testimonial_image')) {
            $image                                     = $request->file('activities_testimonial_image');
            $imagePath                                 = $image->store('activities/testimonials', 'public');
            $testimonial->activities_testimonial_image = 'storage/' . $imagePath;
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Témoignage ajouté avec succès.');
    }

    public function updateTestimonial(Request $request, $id)
    {
        $request->validate([
            'activities_testimonial_title'       => 'required|string|max:255',
            'activities_testimonial_description' => 'nullable|string',
            'activities_testimonial_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activities_testimonial_link'        => 'nullable|url',
        ]);

        $testimonial                                     = ActivitiesTestimonial::findOrFail($id);
        $testimonial->activities_testimonial_title       = $request->activities_testimonial_title;
        $testimonial->activities_testimonial_description = $request->activities_testimonial_description;
        $testimonial->activities_testimonial_link        = $request->activities_testimonial_link;

        if ($request->hasFile('activities_testimonial_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($testimonial->activities_testimonial_image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $testimonial->activities_testimonial_image));
            }

            $image                                     = $request->file('activities_testimonial_image');
            $imagePath                                 = $image->store('activities/testimonials', 'public');
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

    // Key Numbers Management
    public function storeKeyNumber(Request $request)
    {
        $request->validate([
            'activities_keynumber_title'       => 'required|string|max:255',
            'activities_keynumber_value'       => 'required|integer',
            'activities_keynumber_description' => 'nullable|string|max:500',
            'activities_keynumber_icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'activities_keynumber_order'       => 'nullable|integer|min:0',
        ]);

        $keyNumber                                   = new ActivitiesKeyNumber();
        $keyNumber->activities_keynumber_title       = $request->activities_keynumber_title;
        $keyNumber->activities_keynumber_value       = $request->activities_keynumber_value;
        $keyNumber->activities_keynumber_description = $request->activities_keynumber_description;
        $keyNumber->activities_keynumber_order       = $request->activities_keynumber_order ?? 0;

        if ($request->hasFile('activities_keynumber_icon')) {
            $icon                                 = $request->file('activities_keynumber_icon');
            $iconPath                             = $icon->store('activities/keynumbers', 'public');
            $keyNumber->activities_keynumber_icon = 'storage/' . $iconPath;
        }

        $keyNumber->save();

        return redirect()->back()->with('success', 'Chiffre clé ajouté avec succès.');
    }

    public function updateKeyNumber(Request $request, $id)
    {
        $request->validate([
            'activities_keynumber_title'       => 'required|string|max:255',
            'activities_keynumber_value'       => 'required|integer',
            'activities_keynumber_description' => 'nullable|string|max:500',
            'activities_keynumber_icon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'activities_keynumber_order'       => 'nullable|integer|min:0',
        ]);

        $keyNumber                                   = ActivitiesKeyNumber::findOrFail($id);
        $keyNumber->activities_keynumber_title       = $request->activities_keynumber_title;
        $keyNumber->activities_keynumber_value       = $request->activities_keynumber_value;
        $keyNumber->activities_keynumber_description = $request->activities_keynumber_description;
        $keyNumber->activities_keynumber_order       = $request->activities_keynumber_order ?? 0;

        if ($request->hasFile('activities_keynumber_icon')) {
            // Supprimer l'ancienne icône si elle existe
            if ($keyNumber->activities_keynumber_icon) {
                Storage::disk('public')->delete(str_replace('storage/', '', $keyNumber->activities_keynumber_icon));
            }

            $icon                                 = $request->file('activities_keynumber_icon');
            $iconPath                             = $icon->store('activities/keynumbers', 'public');
            $keyNumber->activities_keynumber_icon = 'storage/' . $iconPath;
        }

        $keyNumber->save();

        return redirect()->back()->with('success', 'Chiffre clé mis à jour avec succès.');
    }

    public function deleteKeyNumber($id)
    {
        $keyNumber = ActivitiesKeyNumber::findOrFail($id);

        // Supprimer l'icône si elle existe
        if ($keyNumber->activities_keynumber_icon) {
            Storage::disk('public')->delete(str_replace('storage/', '', $keyNumber->activities_keynumber_icon));
        }

        $keyNumber->delete();

        return redirect()->back()->with('success', 'Chiffre clé supprimé avec succès.');
    }

    // Edit methods for AJAX requests
    public function editKeyNumber($id)
    {
        $keyNumber = ActivitiesKeyNumber::findOrFail($id);
        return response()->json($keyNumber);
    }

    public function editTheme($id)
    {
        $theme = ActivitiesTheme::findOrFail($id);
        return response()->json($theme);
    }

    public function editService($id)
    {
        $service = ActivitiesService::findOrFail($id);
        return response()->json($service);
    }

    public function editTestimonial($id)
    {
        $testimonial = ActivitiesTestimonial::findOrFail($id);
        return response()->json($testimonial);
    }

    // Country Management
    public function storeCountry(Request $request)
    {
        $validated = $request->validate([
            'country_code' => 'required|string|size:2|unique:activities_countries,country_code',
            'country_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activities' => 'nullable|array',
            'activities.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $country = new ActivitiesCountry();
        $country->country_code = strtoupper($validated['country_code']);
        $country->country_name = $validated['country_name'];
        $country->description = $validated['description'] ?? null;
        $country->activities = $validated['activities'] ?? [];
        $country->order = $validated['order'] ?? 0;
        $country->is_active = $validated['is_active'] ?? true;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('activities/countries', 'public');
            $country->image = 'storage/' . $imagePath;
        }

        $country->save();

        return redirect()->back()->with('success', 'Pays ajouté avec succès.');
    }

    public function editCountry($id)
    {
        $country = ActivitiesCountry::findOrFail($id);
        return response()->json($country);
    }

    public function updateCountry(Request $request, $id)
    {
        $validated = $request->validate([
            'country_code' => 'required|string|size:2|unique:activities_countries,country_code,' . $id,
            'country_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activities' => 'nullable|array',
            'activities.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        $country = ActivitiesCountry::findOrFail($id);
        $country->country_code = strtoupper($validated['country_code']);
        $country->country_name = $validated['country_name'];
        $country->description = $validated['description'] ?? null;
        $country->activities = $validated['activities'] ?? [];
        $country->order = $validated['order'] ?? 0;
        $country->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($country->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $country->image));
            }

            $image = $request->file('image');
            $imagePath = $image->store('activities/countries', 'public');
            $country->image = 'storage/' . $imagePath;
        }

        $country->save();

        return redirect()->back()->with('success', 'Pays mis à jour avec succès.');
    }

    public function deleteCountry($id)
    {
        $country = ActivitiesCountry::findOrFail($id);

        // Supprimer l'image
        if ($country->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $country->image));
        }

        $country->delete();

        return redirect()->back()->with('success', 'Pays supprimé avec succès.');
    }

    public function getCountryData($countryCode)
    {
        $country = ActivitiesCountry::where('country_code', strtoupper($countryCode))
            ->where('is_active', true)
            ->first();

        if (!$country) {
            return response()->json(['error' => 'Pays non trouvé'], 404);
        }

        return response()->json($country);
    }
}