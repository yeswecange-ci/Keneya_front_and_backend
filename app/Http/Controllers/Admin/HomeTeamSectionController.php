<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTeamSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeTeamSectionController extends Controller
{
    public function index()
    {
        $section = HomeTeamSection::first();

        return view('admin.home.team-section', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $section = HomeTeamSection::firstOrNew(['id' => 1]);

        $section->title = $request->title;
        $section->description = $request->description;
        $section->active = $request->has('active') ? true : false;

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists(str_replace('storage/', '', $section->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $section->image));
            }

            $imagePath = $request->file('image')->store('home/team', 'public');
            $section->image = 'storage/' . $imagePath;
        }

        $section->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section Équipe mise à jour avec succès!');
    }
}
