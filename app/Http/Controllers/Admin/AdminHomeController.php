<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\HomeSlide;
use App\Models\HomeAbout;
use App\Models\HomeKeyNumber;
use App\Models\HomeKeyNumberStat;
use App\Models\HomeRecruitment;

class AdminHomeController extends Controller
{
    public function index()
    {
        $homeSlides = HomeSlide::orderBy('home_slide_order')->get();
        $homeAbout = HomeAbout::first();
        $homeKeyNumbers = HomeKeyNumber::with('activeStats')->first();
        $homeRecruitment = HomeRecruitment::first();

        return view('admin.home.index', compact(
            'homeSlides',
            'homeAbout',
            'homeKeyNumbers',
            'homeRecruitment'
        ));
    }

    // GESTION DES SLIDES
    public function storeSlide(Request $request)
    {
        $request->validate([
            'home_slide_number' => 'required|string|max:10',
            'home_slide_title' => 'required|string|max:500',
            'home_slide_description' => 'required|string',
            'home_slide_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_slide_order' => 'required|integer'
        ]);

        $imagePath = null;
        if ($request->hasFile('home_slide_image')) {
            $imagePath = $request->file('home_slide_image')->store('slides', 'public');
        }

        HomeSlide::create([
            'home_slide_number' => $request->home_slide_number,
            'home_slide_title' => $request->home_slide_title,
            'home_slide_description' => $request->home_slide_description,
            'home_slide_image' => $imagePath ? 'storage/' . $imagePath : null,
            'home_slide_order' => $request->home_slide_order,
            'home_slide_active' => true
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Slide ajoutée avec succès!');
    }

    public function updateSlide(Request $request, $id)
    {
        $slide = HomeSlide::findOrFail($id);

        $request->validate([
            'home_slide_number' => 'required|string|max:10',
            'home_slide_title' => 'required|string|max:500',
            'home_slide_description' => 'required|string',
            'home_slide_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_slide_order' => 'required|integer'
        ]);

        $data = [
            'home_slide_number' => $request->home_slide_number,
            'home_slide_title' => $request->home_slide_title,
            'home_slide_description' => $request->home_slide_description,
            'home_slide_order' => $request->home_slide_order,
        ];

        if ($request->hasFile('home_slide_image')) {
            // Supprimer l'ancienne image
            if ($slide->home_slide_image && Storage::disk('public')->exists(str_replace('storage/', '', $slide->home_slide_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $slide->home_slide_image));
            }

            $imagePath = $request->file('home_slide_image')->store('slides', 'public');
            $data['home_slide_image'] = 'storage/' . $imagePath;
        }

        $slide->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Slide modifiée avec succès!');
    }

    public function deleteSlide($id)
    {
        $slide = HomeSlide::findOrFail($id);

        // Supprimer l'image
        if ($slide->home_slide_image && Storage::disk('public')->exists(str_replace('storage/', '', $slide->home_slide_image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $slide->home_slide_image));
        }

        $slide->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Slide supprimée avec succès!');
    }

    public function toggleSlideStatus($id)
    {
        $slide = HomeSlide::findOrFail($id);
        $slide->update(['home_slide_active' => !$slide->home_slide_active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut de la slide modifié avec succès!');
    }

    // GESTION DE LA SECTION À PROPOS
    public function updateAbout(Request $request)
    {
        $request->validate([
            'home_about_section_title' => 'required|string|max:255',
            'home_about_main_title' => 'required|string|max:500',
            'home_about_description' => 'required|string',
            'home_about_button_text' => 'required|string|max:100',
            'home_about_button_link' => 'required|url|max:500'
        ]);

        $homeAbout = HomeAbout::first();

        if ($homeAbout) {
            $homeAbout->update($request->all());
        } else {
            HomeAbout::create($request->all());
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Section À propos mise à jour avec succès!');
    }

    // GESTION DES CHIFFRES CLÉS
    public function updateKeyNumbers(Request $request)
    {
        $request->validate([
            'home_key_numbers_section_title' => 'required|string|max:255',
            'home_key_numbers_description' => 'required|string',
            'home_key_numbers_button_text' => 'required|string|max:100',
            'home_key_numbers_button_link' => 'required|url|max:500',
            'home_key_numbers_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $homeKeyNumbers = HomeKeyNumber::first();
        $data = $request->except('home_key_numbers_image');

        if ($request->hasFile('home_key_numbers_image')) {
            // Supprimer l'ancienne image
            if ($homeKeyNumbers && $homeKeyNumbers->home_key_numbers_image && Storage::disk('public')->exists(str_replace('storage/', '', $homeKeyNumbers->home_key_numbers_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $homeKeyNumbers->home_key_numbers_image));
            }

            $imagePath = $request->file('home_key_numbers_image')->store('key-numbers', 'public');
            $data['home_key_numbers_image'] = 'storage/' . $imagePath;
        }

        if ($homeKeyNumbers) {
            $homeKeyNumbers->update($data);
        } else {
            HomeKeyNumber::create($data);
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Chiffres clés mis à jour avec succès!');
    }

    // GESTION DES STATISTIQUES
    public function storeStat(Request $request)
    {
        $request->validate([
            'home_stat_number' => 'required|string|max:50',
            'home_stat_description' => 'required|string|max:255',
            'home_stat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'home_stat_order' => 'required|integer'
        ]);

        $iconPath = null;
        if ($request->hasFile('home_stat_icon')) {
            $iconPath = $request->file('home_stat_icon')->store('stats', 'public');
        }

        $homeKeyNumbers = HomeKeyNumber::first();
        if (!$homeKeyNumbers) {
            return redirect()->route('dashboard.accueil')->with('error', 'Veuillez d\'abord créer la section chiffres clés.');
        }

        HomeKeyNumberStat::create([
            'home_key_number_id' => $homeKeyNumbers->id,
            'home_stat_number' => $request->home_stat_number,
            'home_stat_description' => $request->home_stat_description,
            'home_stat_icon' => $iconPath ? 'storage/' . $iconPath : null,
            'home_stat_order' => $request->home_stat_order,
            'home_stat_active' => true
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique ajoutée avec succès!');
    }

    public function updateStat(Request $request, $id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);

        $request->validate([
            'home_stat_number' => 'required|string|max:50',
            'home_stat_description' => 'required|string|max:255',
            'home_stat_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'home_stat_order' => 'required|integer'
        ]);

        $data = [
            'home_stat_number' => $request->home_stat_number,
            'home_stat_description' => $request->home_stat_description,
            'home_stat_order' => $request->home_stat_order,
        ];

        if ($request->hasFile('home_stat_icon')) {
            // Supprimer l'ancienne icône
            if ($stat->home_stat_icon && Storage::disk('public')->exists(str_replace('storage/', '', $stat->home_stat_icon))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $stat->home_stat_icon));
            }

            $iconPath = $request->file('home_stat_icon')->store('stats', 'public');
            $data['home_stat_icon'] = 'storage/' . $iconPath;
        }

        $stat->update($data);

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique modifiée avec succès!');
    }

    public function deleteStat($id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);

        // Supprimer l'icône
        if ($stat->home_stat_icon && Storage::disk('public')->exists(str_replace('storage/', '', $stat->home_stat_icon))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $stat->home_stat_icon));
        }

        $stat->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Statistique supprimée avec succès!');
    }

    public function toggleStatStatus($id)
    {
        $stat = HomeKeyNumberStat::findOrFail($id);
        $stat->update(['home_stat_active' => !$stat->home_stat_active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut de la statistique modifié avec succès!');
    }

    // GESTION DU RECRUTEMENT
    public function updateRecruitment(Request $request)
    {
        $request->validate([
            'home_recruitment_section_title' => 'required|string|max:255',
            'home_recruitment_description' => 'required|string'
        ]);

        $homeRecruitment = HomeRecruitment::first();

        if ($homeRecruitment) {
            $homeRecruitment->update($request->all());
        } else {
            HomeRecruitment::create($request->all());
        }

        return redirect()->route('dashboard.accueil')->with('success', 'Section recrutement mise à jour avec succès!');
    }
}
