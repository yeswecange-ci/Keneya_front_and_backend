<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTargetAudienceSection;
use App\Models\HomeTargetAudienceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeTargetAudienceSectionController extends Controller
{
    public function index()
    {
        $section = HomeTargetAudienceSection::with('items')->first();

        return view('admin.home.target-audience-section', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'outro_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
        ]);

        $section = HomeTargetAudienceSection::firstOrNew(['id' => 1]);

        $section->title = $request->title;
        $section->description = $request->description;
        $section->outro_description = $request->outro_description;
        $section->button_text = $request->button_text;
        $section->button_link = $request->button_link;
        $section->active = $request->has('active') ? true : false;

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists(str_replace('storage/', '', $section->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $section->image));
            }

            $imagePath = $request->file('image')->store('home/target-audience', 'public');
            $section->image = 'storage/' . $imagePath;
        }

        $section->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section Public Cible mise à jour avec succès!');
    }

    // Gestion des items
    public function storeItem(Request $request)
    {
        $request->validate([
            'item_text' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $section = HomeTargetAudienceSection::firstOrCreate(['id' => 1]);

        HomeTargetAudienceItem::create([
            'home_target_audience_section_id' => $section->id,
            'item_text' => $request->item_text,
            'order' => $request->order,
            'active' => true,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Item ajouté avec succès!');
    }

    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'item_text' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $item = HomeTargetAudienceItem::findOrFail($id);
        $item->update([
            'item_text' => $request->item_text,
            'order' => $request->order,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Item mis à jour avec succès!');
    }

    public function toggleItem($id)
    {
        $item = HomeTargetAudienceItem::findOrFail($id);
        $item->update(['active' => !$item->active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut modifié avec succès!');
    }

    public function destroyItem($id)
    {
        $item = HomeTargetAudienceItem::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Item supprimé avec succès!');
    }
}
