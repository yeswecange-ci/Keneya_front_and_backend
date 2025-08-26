<?php

namespace App\Http\Controllers;

use App\Models\ActivitiesTheme;
use App\Models\ActivitiesService;
use App\Models\ActivitiesGeographicCoverage;
use App\Models\ActivitiesTestimonial;
use App\Models\ActivitiesPageContent;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Affiche la page des activités
     */
    public function index()
    {
        // Récupération de tous les contenus nécessaires
        $pageContent = ActivitiesPageContent::all()->pluck('activities_content_value', 'activities_content_key');

        $themes = ActivitiesTheme::active()->ordered()->get();

        $services = ActivitiesService::active()->ordered()->get();

        $geographicCoverage = ActivitiesGeographicCoverage::active()->first();

        $testimonials = ActivitiesTestimonial::active()->ordered()->get();

        return view('frontend.activities', compact(
            'pageContent',
            'themes',
            'services',
            'geographicCoverage',
            'testimonials'
        ));
    }
}
