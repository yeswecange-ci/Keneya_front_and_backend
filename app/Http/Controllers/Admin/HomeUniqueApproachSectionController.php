<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeUniqueApproachSection;
use App\Models\HomeUniqueApproachItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeUniqueApproachSectionController extends Controller
{
    public function index()
    {
        $section = HomeUniqueApproachSection::with('items')->first();

        return view('admin.home.unique-approach-section', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description_intro' => 'nullable|string',
            'description_middle' => 'nullable|string',
            'description_outro' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $section = HomeUniqueApproachSection::firstOrNew(['id' => 1]);

        $section->title = $request->title;
        $section->description_intro = $request->description_intro;
        $section->description_middle = $request->description_middle;
        $section->description_outro = $request->description_outro;
        $section->active = $request->has('active') ? true : false;

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists(str_replace('storage/', '', $section->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $section->image));
            }

            $imagePath = $request->file('image')->store('home/unique-approach', 'public');
            $section->image = 'storage/' . $imagePath;
        }

        $section->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section Approche Unique mise à jour avec succès!');
    }

    // Gestion des items
    public function storeItem(Request $request)
    {
        $request->validate([
            'item_text' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $section = HomeUniqueApproachSection::firstOrCreate(['id' => 1]);

        HomeUniqueApproachItem::create([
            'home_unique_approach_section_id' => $section->id,
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

        $item = HomeUniqueApproachItem::findOrFail($id);
        $item->update([
            'item_text' => $request->item_text,
            'order' => $request->order,
        ]);

        return redirect()->route('dashboard.accueil')->with('success', 'Item mis à jour avec succès!');
    }

    public function toggleItem($id)
    {
        $item = HomeUniqueApproachItem::findOrFail($id);
        $item->update(['active' => !$item->active]);

        return redirect()->route('dashboard.accueil')->with('success', 'Statut modifié avec succès!');
    }

    public function destroyItem($id)
    {
        $item = HomeUniqueApproachItem::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard.accueil')->with('success', 'Item supprimé avec succès!');
    }
}
