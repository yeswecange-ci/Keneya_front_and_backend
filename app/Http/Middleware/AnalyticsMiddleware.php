<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserAnalytics;
use Symfony\Component\HttpFoundation\Response;

class AnalyticsMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Ne pas tracker les requêtes AJAX ou API
        if ($request->ajax() || $request->is('api/*')) {
            return $response;
        }

        $sessionId = session()->getId();
        $userAgent = $request->userAgent();
        $ip = $request->ip();
        $currentPage = $request->fullUrl();
        $referrer = $request->headers->get('referer');

        // Chercher ou créer l'enregistrement analytics
        $analytics = UserAnalytics::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'user_agent' => $userAgent,
                'ip_address' => $ip,
                'referrer' => $referrer,
                'landing_page' => $currentPage,
                'first_visit_at' => now(),
                'last_activity_at' => now(),
            ]
        );

        // Si c'est un nouvel enregistrement, ajouter les informations détaillées
        if ($analytics->wasRecentlyCreated) {
            $userAgentInfo = UserAnalytics::parseUserAgent($userAgent);
            $locationInfo = UserAnalytics::getLocationFromIP($ip);

            $analytics->update(array_merge($userAgentInfo, $locationInfo));
        }

        // Ajouter la page visitée et mettre à jour l'activité
        $analytics->addPageVisit($currentPage);
        $analytics->updateSessionDuration();

        return $response;
    }
}
