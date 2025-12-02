<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeServicesSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeServicesSectionController extends Controller
{
    public function index()
    {
        $section = HomeServicesSection::first();

        return view('admin.home.services-section', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $section = HomeServicesSection::firstOrNew(['id' => 1]);

        $section->title = $request->title;
        $section->description = $request->description;
        $section->active = $request->has('active') ? true : false;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($section->image && Storage::disk('public')->exists(str_replace('storage/', '', $section->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $section->image));
            }

            $imagePath = $request->file('image')->store('home/services', 'public');
            $section->image = 'storage/' . $imagePath;
        }

        $section->save();

        return redirect()->route('dashboard.accueil')->with('success', 'Section Services mise à jour avec succès!');
    }
}
