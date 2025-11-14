<?php
namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\HomeKeyNumber;
use App\Models\HomeRecruitment;
use App\Models\HomeSlide;
use App\Models\FooterColumn;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\FooterSocial;



class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les données nécessaires pour la page d'accueil
        $homeSlides      = HomeSlide::active()->ordered()->get();
        $homeAbout       = HomeAbout::active()->first();
        $homeKeyNumbers  = HomeKeyNumber::active()->with('activeStats')->first();
        $homeRecruitment = HomeRecruitment::active()->first();

        $footerSettings = FooterSetting::first();
    $footerColumns = FooterColumn::with('activeLinks')->active()->orderBy('column_order')->get();
    $footerSocials = FooterSocial::active()->get();

        return view('frontend.home', compact(
            'homeSlides',
            'homeAbout',
            'homeKeyNumbers',
            'homeRecruitment',
            'footerSettings',
            'footerColumns',
            'footerSocials'
        ));
    }
}
