<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Change the application locale
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLocale(Request $request)
    {
        $locale = $request->input('locale');

        // Vérifier que la locale est supportée
        if (in_array($locale, config('app.available_locales'))) {
            // Sauvegarder la locale en session
            Session::put('locale', $locale);

            // Changer la locale de l'application
            App::setLocale($locale);
        }

        // Retourner à la page précédente
        return redirect()->back();
    }

    /**
     * Get current locale (for AJAX calls)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentLocale()
    {
        return response()->json([
            'locale' => App::getLocale()
        ]);
    }
}
