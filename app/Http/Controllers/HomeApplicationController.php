<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeApplication;
use Illuminate\Support\Str;

class HomeApplicationController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'home_application_first_name'   => 'required|string|max:255',
            'home_application_last_name'    => 'required|string|max:255',
            'home_application_email'        => 'required|email|max:255',
            'home_application_phone'        => 'required|string|max:20',
            'home_application_desired_position' => 'required|string|max:255',
            'home_application_availability_date' => 'required|date|after_or_equal:today',
            'home_application_cv'           => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        try {
            // Upload du CV
            $cvPath = $request->file('home_application_cv')
                ? $request->file('home_application_cv')->storeAs(
                    'home_applications/cvs',
                    Str::uuid() . '.' . $request->file('home_application_cv')->getClientOriginalExtension(),
                    'public'
                )
                : null;

            // Création de la candidature
            HomeApplication::create([
                ...$validated,
                'home_application_cv_path' => $cvPath,
                'home_application_status'  => 'pending',
            ]);

            return back()->with('success', 'Votre candidature a été soumise avec succès! Nous vous contacterons bientôt.');
        } catch (\Throwable $e) {
            // On peut logger l'erreur pour debug
            report($e);
            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}
