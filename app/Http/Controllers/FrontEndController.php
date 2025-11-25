<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlide;
use App\Models\HomeAbout;
use App\Models\HomeKeyNumber;
use App\Models\HomeRecruitment;
use App\Models\HomePartner;

class FrontEndController extends Controller
{
    public function index()
    {
        // Récupérer toutes les données nécessaires pour la page d'accueil
        $homeSlides = HomeSlide::active()->ordered()->get();
        $homeAbout = HomeAbout::active()->first();
        $homeKeyNumbers = HomeKeyNumber::active()->with('activeStats')->first();
        $homeRecruitment = HomeRecruitment::active()->first();
        $homePartners = HomePartner::active()->with('activeItems')->first();

        return view('frontend.home', compact(
            'homeSlides',
            'homeAbout',
            'homeKeyNumbers',
            'homeRecruitment',
            'homePartners'
        ));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function activities()
    {
        return view('frontend.activities');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function news()
    {
        return view('frontend.news');
    }

    public function teams()
    {
        return view('frontend.teams');
    }

    public function teamDetails()
    {
        return view('frontend.team-details');
    }
}
