<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontEndController extends Controller
{
    /**
     * Afficher la page d'accueil
     */
    public function index(): View
    {
        return view('frontend.home');
    }

    /**
     * Afficher la page "À propos"
     */
    public function about(): View
    {
        return view('frontend.about');
    }

    /**
     * Afficher la page des activités
     */
    public function activities(): View
    {
        // TODO: Récupérer les activités depuis la base de données
        $activities = [];

        return view('frontend.activities', compact('activities'));
    }

    /**
     * Afficher la page de contact
     */
    public function contact(): View
    {
        return view('frontend.contact');
    }

    /**
     * Afficher la page des actualités
     */
    public function news(Request $request)
    {
        // TODO: Traiter la logique des actualités
        // Pour l'instant, on retourne une vue simple
        return view('frontend.news');
    }

    /**
     * Afficher la page des équipes
     */
    public function teams(Request $request)
    {
        // TODO: Récupérer les équipes depuis la base de données
        $teams = [];

        return view('frontend.teams', compact('teams'));
    }

    /**
     * Afficher les détails d'une équipe
     */
    public function teamDetails(Request $request)
    {
        // TODO: Récupérer les détails de l'équipe
        $teamId = $request->input('team_id');
        $team = null; // À remplacer par la logique de récupération

        return view('frontend.team-details', compact('team'));
    }
}
