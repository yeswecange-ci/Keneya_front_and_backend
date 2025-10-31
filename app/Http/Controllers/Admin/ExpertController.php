<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamLeaderDetail;
use App\Models\TeamMemberDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    public function index()
    {
        $teamLeader = TeamLeaderDetail::first();
        $teamMembers = TeamMemberDetail::orderBy('id')->get();

        return view('admin.expert.index', compact('teamLeader', 'teamMembers'));
    }

    // Team Leader Management
    public function updateTeamLeader(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $teamLeader = TeamLeaderDetail::firstOrNew(['id' => 1]);
        $teamLeader->name = $request->name;
        $teamLeader->position = $request->position;
        $teamLeader->description = $request->description;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($teamLeader->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $teamLeader->image));
            }

            $image = $request->file('image');
            $imagePath = $image->store('team/leader', 'public');
            $teamLeader->image = 'storage/' . $imagePath;
        }

        $teamLeader->save();

        return redirect()->route('dashboard.expert')->with('success', 'Leader d\'équipe mis à jour avec succès.');
    }

    // Team Members Management
    public function storeTeamMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $member = new TeamMemberDetail();
        $member->name = $request->name;
        $member->position = $request->position;
        $member->link = $request->link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('team/members', 'public');
            $member->image = 'storage/' . $imagePath;
        }

        $member->save();

        return redirect()->route('dashboard.expert')->with('success', 'Membre d\'équipe ajouté avec succès.');
    }

    public function updateTeamMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $member = TeamMemberDetail::findOrFail($id);
        $member->name = $request->name;
        $member->position = $request->position;
        $member->link = $request->link;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($member->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $member->image));
            }

            $image = $request->file('image');
            $imagePath = $image->store('team/members', 'public');
            $member->image = 'storage/' . $imagePath;
        }

        $member->save();

        return redirect()->route('dashboard.expert')->with('success', 'Membre d\'équipe mis à jour avec succès.');
    }

    public function deleteTeamMember($id)
    {
        $member = TeamMemberDetail::findOrFail($id);

        // Supprimer l'image
        if ($member->image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $member->image));
        }

        $member->delete();

        return redirect()->route('dashboard.expert')->with('success', 'Membre d\'équipe supprimé avec succès.');
    }
}