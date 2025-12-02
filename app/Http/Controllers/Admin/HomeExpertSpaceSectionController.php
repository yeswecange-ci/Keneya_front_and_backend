<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeExpertSpaceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeExpertSpaceSectionController extends Controller
{
    public function index()
    {
        $section = HomeExpertSpaceSection::first();

        return view('admin.home.expert-space-section', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $section = HomeExpertSpaceSection::firstOrNew(['id' => 1]);

        $section->title = $request->title;
        $section->description = $request->description;
        $section->button_text = $request->button_text;
        $section->button_link = $request->button_link;
        $section->active = $request->has('active') ? true : false;

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists(str_replace('storage/', '', $section->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $section->image));
            }

            $imagePath = $request->file('image')->store('home/expert-space', 'public');
            $section->image = 'storage/' . $imagePath;
        }

        $section->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section Espace Expert mise à jour avec succès!');
    }
}
