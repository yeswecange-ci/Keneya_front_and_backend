<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamLeaderDetail;
use App\Models\TeamMemberDetail;
use App\Models\HomeExpertSpaceSection;

class TeamController extends Controller
{
    public function index()
    {
        $teamLeader = TeamLeaderDetail::first();
        $teamMembers = TeamMemberDetail::all();
        $expertSpaceSection = HomeExpertSpaceSection::active()->first();

        return view('frontend.team-details', compact('teamLeader', 'teamMembers', 'expertSpaceSection'));
    }
}
