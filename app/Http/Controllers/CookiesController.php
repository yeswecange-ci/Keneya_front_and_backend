<?php
namespace App\Http\Controllers;

use App\Models\UserAnalytics;
use Illuminate\Http\Request;
use hisorange\BrowserDetect\Parser as Browser;

class CookiesController extends Controller
{
    /**
     * Accepter les cookies
     */
    public function accept(Request $request)
    {
        $sessionId = session()->getId();

        // Récupérer les informations du navigateur et géolocalisation
        $browserInfo = $this->getBrowserInfo();
        $geoInfo = $this->getGeoInfo($request);

        // Chercher ou créer un enregistrement analytics
        $analytics = UserAnalytics::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'ip_address'     => $request->ip(),
                'first_visit_at' => now(),
                'browser'        => $browserInfo['browser'],
                'os'             => $browserInfo['os'],
                'device_type'    => $browserInfo['device_type'],
                'country'        => $geoInfo['country'],
                'city'           => $geoInfo['city'],
            ]
        );

        // Mettre à jour consentement et informations
        $analytics->update([
            'cookies_accepted'    => true,
            'cookies_accepted_at' => now(),
            'last_activity_at'    => now(),
            // Mettre à jour les infos si elles étaient vides
            'country'             => $analytics->country ?? $geoInfo['country'],
            'city'                => $analytics->city ?? $geoInfo['city'],
            'browser'             => $analytics->browser ?? $browserInfo['browser'],
            'os'                  => $analytics->os ?? $browserInfo['os'],
            'device_type'         => $analytics->device_type ?? $browserInfo['device_type'],
        ]);

        // Définir le cookie navigateur (1 an)
        cookie()->queue('cookies_accepted', 'yes', 525600);

        return response()->json([
            'success' => true,
            'message' => 'Cookies acceptés avec succès',
        ]);
    }

    /**
     * Refuser les cookies
     */
    public function decline(Request $request)
    {
        // Définir le cookie de refus (valide 1 an)
        cookie()->queue('cookies_accepted', 'no', 525600);

        return response()->json([
            'success' => true,
            'message' => 'Cookies refusés',
        ]);
    }

    /**
     * Vérifier le statut des cookies
     */
    public function status(Request $request)
    {
        $cookiesAccepted = $request->cookie('cookies_accepted');

        return response()->json([
            'cookies_accepted' => $cookiesAccepted,
            'show_banner'      => ! $cookiesAccepted,
        ]);
    }

    /**
     * Obtenir les informations du navigateur
     */
    private function getBrowserInfo()
    {
        return [
            'browser'     => Browser::browserName(),
            'os'          => Browser::platformName(),
            'device_type' => Browser::deviceType(),
        ];
    }

    /**
     * Obtenir les informations géographiques
     */
    private function getGeoInfo(Request $request)
    {
        $ip = $request->ip();

        // Pour les adresses locales
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return [
                'country' => 'Local',
                'city'    => 'Localhost'
            ];
        }

        try {
            // Utilisation de ipinfo.io (service gratuit)
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

            return [
                'country' => $details->country ?? 'Inconnu',
                'city'    => $details->city ?? 'Inconnu'
            ];
        } catch (\Exception $e) {
            return [
                'country' => 'Inconnu',
                'city'    => 'Inconnu'
            ];
        }
    }

    /**
     * Tableau de bord analytics (admin)
     */
    public function dashboard()
    {
        $stats = [
            'total_visitors'        => UserAnalytics::count(),
            'visitors_with_cookies' => UserAnalytics::where('cookies_accepted', true)->count(),
            'visitors_today'        => UserAnalytics::whereDate('created_at', today())->count(),
            'visitors_this_month'   => UserAnalytics::whereMonth('created_at', now()->month)->count(),
        ];

        $recentVisitors = UserAnalytics::where('cookies_accepted', true)
            ->orderBy('last_activity_at', 'desc')
            ->limit(10)
            ->get();

        $topCountries = UserAnalytics::where('cookies_accepted', true)
            ->whereNotNull('country')
            ->where('country', '!=', 'Local')
            ->where('country', '!=', 'Inconnu')
            ->selectRaw('country, count(*) as count')
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $deviceStats = UserAnalytics::where('cookies_accepted', true)
            ->whereNotNull('device_type')
            ->selectRaw('device_type, count(*) as count')
            ->groupBy('device_type')
            ->get();

        return view('admin.analytics.dashboard', compact(
            'stats',
            'recentVisitors',
            'topCountries',
            'deviceStats'
        ));
    }

    /**
     * Export des données (CSV)
     */
    public function export()
    {
        $filename = 'analytics-' . now()->format('Y-m-d') . '.csv';
        $headers  = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            // En-têtes CSV
            fputcsv($file, [
                'Session ID', 'IP', 'Pays', 'Ville', 'Navigateur', 'OS',
                'Type d\'appareil', 'Pages visitées', 'Durée session (min)',
                'Première visite', 'Dernière activité', 'Cookies acceptés',
            ]);

            UserAnalytics::where('cookies_accepted', true)
                ->chunk(1000, function ($analytics) use ($file) {
                    foreach ($analytics as $analytic) {
                        fputcsv($file, [
                            $analytic->session_id,
                            $analytic->ip_address,
                            $analytic->country,
                            $analytic->city,
                            $analytic->browser,
                            $analytic->os,
                            $analytic->device_type,
                            count($analytic->pages_visited ?? []),
                            round($analytic->session_duration / 60, 2),
                            $analytic->first_visit_at?->format('Y-m-d H:i:s'),
                            $analytic->last_activity_at?->format('Y-m-d H:i:s'),
                            $analytic->cookies_accepted ? 'Oui' : 'Non'
                        ]);
                    }
                });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Mettre à jour les informations géographiques pour les anciens visiteurs
     * (Méthode utilitaire pour mettre à jour les enregistrements existants)
     */
    public function updateGeoInfoForExisting()
    {
        $analytics = UserAnalytics::whereNull('country')->orWhere('country', 'Inconnu')->get();

        $updated = 0;
        foreach ($analytics as $analytic) {
            $geoInfo = $this->getGeoInfoFromIP($analytic->ip_address);

            $analytic->update([
                'country' => $geoInfo['country'],
                'city'    => $geoInfo['city']
            ]);

            $updated++;
        }

        return response()->json([
            'success' => true,
            'message' => "{$updated} enregistrements mis à jour",
        ]);
    }

    /**
     * Obtenir les infos géo à partir d'une IP
     */
    private function getGeoInfoFromIP($ip)
    {
        // Pour les adresses locales
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return [
                'country' => 'Local',
                'city'    => 'Localhost'
            ];
        }

        try {
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

            return [
                'country' => $details->country ?? 'Inconnu',
                'city'    => $details->city ?? 'Inconnu'
            ];
        } catch (\Exception $e) {
            return [
                'country' => 'Inconnu',
                'city'    => 'Inconnu'
            ];
        }
    }
}
