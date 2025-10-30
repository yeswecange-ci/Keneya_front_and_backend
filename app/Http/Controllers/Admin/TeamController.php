<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.team.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'is_leader' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('team', $imageName, 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // If this member is set as leader, remove leader status from others
        if (isset($validated['is_leader']) && $validated['is_leader']) {
            TeamMember::where('is_leader', true)->update(['is_leader' => false]);
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre de l\'équipe créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamMember $team)
    {
        return view('admin.team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'is_leader' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('team', $imageName, 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // If this member is set as leader, remove leader status from others
        if (isset($validated['is_leader']) && $validated['is_leader'] && !$team->is_leader) {
            TeamMember::where('is_leader', true)->update(['is_leader' => false]);
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre de l\'équipe mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $team)
    {
        // Delete image if exists
        if ($team->image && file_exists(public_path($team->image))) {
            unlink(public_path($team->image));
        }

        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre de l\'équipe supprimé avec succès.');
    }

    /**
     * Toggle leader status
     */
    public function toggleLeader(TeamMember $team)
    {
        if (!$team->is_leader) {
            // Remove leader status from all others
            TeamMember::where('is_leader', true)->update(['is_leader' => false]);
            // Set this member as leader
            $team->update(['is_leader' => true]);
            $message = $team->name . ' est maintenant le leader de l\'équipe.';
        } else {
            $team->update(['is_leader' => false]);
            $message = $team->name . ' n\'est plus le leader de l\'équipe.';
        }

        return redirect()->route('admin.team.index')
            ->with('success', $message);
    }
}
