<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamStat;
use App\Models\TeamValue;

class TeamsController extends Controller
{
    public function index()
    {
        $leadership = Team::where('type', 'leadership')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $operational = Team::where('type', 'operational')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $stats = TeamStat::where('is_active', true)
            ->orderBy('order')
            ->get();

        $values = TeamValue::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.teams', compact('leadership', 'operational', 'stats', 'values'));
    }
}
