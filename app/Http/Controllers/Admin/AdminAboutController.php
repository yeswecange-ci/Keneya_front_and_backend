<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutAccordionItem;
use App\Models\AboutMainSection;
use App\Models\AboutTeamMember;
use App\Models\AboutTransitionListItem;
use App\Models\AboutTransitionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function index()
    {
        $mainSection       = AboutMainSection::first();
        $accordionItems    = AboutAccordionItem::orderBy('about_accordion_order')->get();
        $transitionSection = AboutTransitionSection::with('aboutTransitionListItems')->first();
        $teamMembers       = AboutTeamMember::orderBy('about_team_order')->get();

        return view('admin.about.index', compact(
            'mainSection',
            'accordionItems',
            'transitionSection',
            'teamMembers'
        ));
    }

    // === SECTION PRINCIPALE ===
    // === SECTION PRINCIPALE ===
    public function updateMainSection(Request $request)
    {
        $validated = $request->validate([
            'about_title'         => 'required|string|max:255',
            'about_description_1' => 'required|string',
            'about_description_2' => 'nullable|string',
            'about_description_3' => 'nullable|string',
            'about_description_4' => 'nullable|string',
            'about_button_text'   => 'required|string|max:255',
            'about_button_link'   => 'required|string|max:500',
            'about_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $mainSection = AboutMainSection::firstOrNew([]);

        // Gérer l'upload d'image
        if ($request->hasFile('about_image')) {
            // Supprimer l'ancienne image
            if ($mainSection->about_image_path) {
                Storage::disk('public')->delete($mainSection->about_image_path);
            }

            // Stocker le chemin sans préfixe (Storage::url() ajoutera /storage/ automatiquement)
            $imagePath                     = $request->file('about_image')->store('about', 'public');
            $mainSection->about_image_path = $imagePath;
        }

        // Mettre à jour les autres champs
        $mainSection->about_title         = $validated['about_title'];
        $mainSection->about_description_1 = $validated['about_description_1'];
        $mainSection->about_description_2 = $validated['about_description_2'] ?? null;
        $mainSection->about_description_3 = $validated['about_description_3'] ?? null;
        $mainSection->about_description_4 = $validated['about_description_4'] ?? null;
        $mainSection->about_button_text   = $validated['about_button_text'];
        $mainSection->about_button_link   = $validated['about_button_link'];

        $mainSection->save();

        return redirect()->route('dashboard.about.manage')->with('success', 'Section principale mise à jour.');
    }

    // === ACCORDION ITEMS ===
    public function storeAccordionItem(Request $request)
    {
        $validated = $request->validate([
            'about_accordion_title'   => 'required|string|max:255',
            'about_accordion_content' => 'required|string',
        ]);

        // Déterminer l'ordre
        $lastOrder = AboutAccordionItem::max('about_accordion_order') ?? 0;

        AboutAccordionItem::create([
             ...$validated,
            'about_accordion_order'     => $lastOrder + 1,
            'about_accordion_is_active' => true,
        ]);

        return redirect()->route('dashboard.about.manage')->with('success', 'Élément ajouté.');
    }

    public function getAccordionItem($id)
    {
        $item = AboutAccordionItem::findOrFail($id);
        return response()->json($item);
    }

    public function updateAccordionItem(Request $request, $id)
    {
        $validated = $request->validate([
            'about_accordion_title'   => 'required|string|max:255',
            'about_accordion_content' => 'required|string',
        ]);

        $item = AboutAccordionItem::findOrFail($id);
        $item->update($validated);

        // CORRECTION : Retourner une redirection au lieu d'une réponse JSON
        return redirect()->route('dashboard.about.manage')->with('success', 'Élément d\'accordéon modifié avec succès.');
    }

    public function deleteAccordionItem($id)
    {
        $item = AboutAccordionItem::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard.about.manage')->with('success', 'Élément supprimé.');
    }

    // === SECTION TRANSITION ===
    public function updateTransitionSection(Request $request)
    {
        $validated = $request->validate([
            'about_transition_title'         => 'required|string',
            'about_transition_description_1' => 'required|string',
            'about_transition_description_2' => 'nullable|string',
            'about_transition_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'list_items'                     => 'nullable|array',
            'list_items.*'                   => 'nullable|string',
        ]);

        $transitionSection = AboutTransitionSection::firstOrNew([]);

        // Gérer l'upload d'image
        if ($request->hasFile('about_transition_image')) {
            if ($transitionSection->about_transition_image_path) {
                Storage::disk('public')->delete($transitionSection->about_transition_image_path);
            }

            $imagePath = $request->file('about_transition_image')->store('about', 'public');
            $validated['about_transition_image_path'] = $imagePath;
        }

        if ($transitionSection->exists) {
            $transitionSection->update($validated);
        } else {
            $transitionSection = AboutTransitionSection::create($validated);
        }

        // Gérer les éléments de liste
        if ($request->has('list_items')) {
            AboutTransitionListItem::where('about_transition_section_id', $transitionSection->id)->delete();

            foreach ($request->list_items as $index => $content) {
                if (! empty(trim($content))) {
                    AboutTransitionListItem::create([
                        'about_transition_section_id'     => $transitionSection->id,
                        'about_transition_list_content'   => $content,
                        'about_transition_list_order'     => $index + 1,
                        'about_transition_list_is_active' => true,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.about.manage')->with('success', 'Section transition mise à jour.');
    }

    // === TEAM MEMBERS ===
    public function storeTeamMember(Request $request)
    {
        $validated = $request->validate([
            'about_team_name'        => 'required|string|max:255',
            'about_team_position'    => 'required|string|max:255',
            'about_team_detail_link' => 'required|string|max:500',
            'about_team_image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $lastOrder = AboutTeamMember::max('about_team_order') ?? 0;

        $imagePath = $request->file('about_team_image')->store('team', 'public');

        AboutTeamMember::create([
            'about_team_name'        => $validated['about_team_name'],
            'about_team_position'    => $validated['about_team_position'],
            'about_team_detail_link' => $validated['about_team_detail_link'],
            'about_team_image_path'  => $imagePath,
            'about_team_order'       => $lastOrder + 1,
            'about_team_is_active'   => true,
        ]);

        return redirect()->route('dashboard.about.manage')->with('success', 'Membre ajouté.');
    }

    public function getTeamMember($id)
    {
        $member = AboutTeamMember::findOrFail($id);
        return response()->json($member);
    }

    public function updateTeamMember(Request $request, $id)
    {
        $validated = $request->validate([
            'about_team_name'        => 'required|string|max:255',
            'about_team_position'    => 'required|string|max:255',
            'about_team_detail_link' => 'required|string|max:500',
            'about_team_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $member = AboutTeamMember::findOrFail($id);

        // Gérer l'upload d'image
        if ($request->hasFile('about_team_image')) {
            if ($member->about_team_image_path) {
                Storage::disk('public')->delete($member->about_team_image_path);
            }

            $imagePath = $request->file('about_team_image')->store('team', 'public');
            $validated['about_team_image_path'] = $imagePath;
        }

        $member->update($validated);

        // CORRECTION : Retourner une redirection au lieu d'une réponse JSON
        return redirect()->route('dashboard.about.manage')->with('success', 'Membre d\'équipe modifié avec succès.');
    }

    public function deleteTeamMember($id)
    {
        $member = AboutTeamMember::findOrFail($id);

        if ($member->about_team_image_path) {
            Storage::disk('public')->delete($member->about_team_image_path);
        }

        $member->delete();

        return redirect()->route('dashboard.about.manage')->with('success', 'Membre supprimé.');
    }
}
