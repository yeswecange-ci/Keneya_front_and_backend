<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlide;
use App\Models\HomeAbout;
use App\Models\HomeKeyNumber;
use App\Models\HomeRecruitment;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les données nécessaires pour la page d'accueil
        $homeSlides = HomeSlide::active()->ordered()->get();
        $homeAbout = HomeAbout::active()->first();
        $homeKeyNumbers = HomeKeyNumber::active()->with('activeStats')->first();
        $homeRecruitment = HomeRecruitment::active()->first();

        return view('frontend.home', compact(
            'homeSlides',
            'homeAbout',
            'homeKeyNumbers',
            'homeRecruitment'
        ));
    }
}
