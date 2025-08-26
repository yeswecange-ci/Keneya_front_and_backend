<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamLeaderDetail;
use App\Models\TeamMemberDetail;

class TeamController extends Controller
{
    public function index()
    {
        $teamLeader = TeamLeaderDetail::first();
        $teamMembers = TeamMemberDetail::all();

        return view('frontend.team-details', compact('teamLeader', 'teamMembers'));
    }
}
