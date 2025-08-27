<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutMainSection;
use App\Models\AboutAccordionItem;
use App\Models\AboutTransitionSection;
use App\Models\AboutTeamMember;

class AboutController extends Controller
{
    public function index()
    {
        // Récupérer toutes les données nécessaires pour la page À propos
        $mainSection = AboutMainSection::getActiveSection();
        $accordionItems = AboutAccordionItem::getActiveItems();
        $transitionSection = AboutTransitionSection::where('about_transition_is_active', true)
                           ->with('aboutTransitionListItems')
                           ->first();
        $teamMembers = AboutTeamMember::getActiveMembers();

        // Debug pour vérifier que les données sont récupérées
        // dd($mainSection, $accordionItems, $transitionSection, $teamMembers);

        return view('frontend.about', compact(
            'mainSection',
            'accordionItems',
            'transitionSection',
            'teamMembers'
        ));
    }
}
