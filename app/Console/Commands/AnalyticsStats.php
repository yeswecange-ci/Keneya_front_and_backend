<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserAnalytics;
use Carbon\Carbon;

class AnalyticsStats extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'analytics:stats {--period=30 : Period in days for statistics}';

    /**
     * The console command description.
     */
    protected $description = 'Display analytics statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $period = $this->option('period');
        $startDate = Carbon::now()->subDays($period);

        $this->info("📊 Statistiques Analytics - Derniers {$period} jours");
        $this->info("Période : du {$startDate->format('d/m/Y')} au " . Carbon::now()->format('d/m/Y'));
        $this->line('');

        // Statistiques générales
        $totalVisitors = UserAnalytics::where('created_at', '>=', $startDate)->count();
        $cookiesAccepted = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)->count();
        $conversionRate = $totalVisitors > 0 ? round(($cookiesAccepted / $totalVisitors) * 100, 2) : 0;

        $this->table([
            'Métrique', 'Valeur'
        ], [
            ['👥 Total visiteurs', number_format($totalVisitors)],
            ['🍪 Cookies acceptés', number_format($cookiesAccepted)],
            ['📈 Taux d\'acceptation', $conversionRate . '%'],
        ]);

        // Top pays
        $this->line('');
        $this->info('🌍 Top 5 Pays');
        $topCountries = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)
            ->where('country', '!=', null)
            ->selectRaw('country, count(*) as visits')
            ->groupBy('country')
            ->orderBy('visits', 'desc')
            ->limit(5)
            ->get();

        if ($topCountries->count() > 0) {
            $countriesData = [];
            foreach ($topCountries as $country) {
                $countriesData[] = [$country->country, $country->visits];
            }
            $this->table(['Pays', 'Visites'], $countriesData);
        } else {
            $this->warn('Aucune donnée de géolocalisation disponible');
        }

        // Répartition par appareil
        $this->line('');
        $this->info('📱 Répartition par type d\'appareil');
        $deviceStats = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)
            ->selectRaw('device_type, count(*) as count')
            ->groupBy('device_type')
            ->orderBy('count', 'desc')
            ->get();

        if ($deviceStats->count() > 0) {
            $deviceData = [];
            $total = $deviceStats->sum('count');
            foreach ($deviceStats as $device) {
                $percentage = $total > 0 ? round(($device->count / $total) * 100, 1) : 0;
                $icon = $this->getDeviceIcon($device->device_type);
                $deviceData[] = [
                    $icon . ' ' . ucfirst($device->device_type ?? 'Inconnu'),
                    $device->count,
                    $percentage . '%'
                ];
            }
            $this->table(['Appareil', 'Visites', 'Pourcentage'], $deviceData);
        } else {
            $this->warn('Aucune donnée d\'appareil disponible');
        }

        // Navigateurs
        $this->line('');
        $this->info('🌐 Top 5 Navigateurs');
        $browserStats = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)
            ->where('browser', '!=', null)
            ->selectRaw('browser, count(*) as count')
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        if ($browserStats->count() > 0) {
            $browserData = [];
            foreach ($browserStats as $browser) {
                $icon = $this->getBrowserIcon($browser->browser);
                $browserData[] = [
                    $icon . ' ' . $browser->browser,
                    $browser->count
                ];
            }
            $this->table(['Navigateur', 'Visites'], $browserData);
        } else {
            $this->warn('Aucune donnée de navigateur disponible');
        }

        // Statistiques de session
        $this->line('');
        $this->info('⏱️  Statistiques de session');
        $avgSessionDuration = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)
            ->where('session_duration', '>', 0)
            ->avg('session_duration');

        $totalPageViews = UserAnalytics::where('created_at', '>=', $startDate)
            ->where('cookies_accepted', true)
            ->get()
            ->sum(function($analytics) {
                return count($analytics->pages_visited ?? []);
            });

        $avgPagesPerSession = $cookiesAccepted > 0 ? round($totalPageViews / $cookiesAccepted, 2) : 0;

        $sessionData = [
            ['⏱️ Durée moyenne de session', $this->formatDuration($avgSessionDuration)],
            ['📄 Pages vues totales', number_format($totalPageViews)],
            ['📊 Pages par session (moyenne)', $avgPagesPerSession],
        ];

        $this->table(['Métrique', 'Valeur'], $sessionData);

        // Évolution quotidienne (derniers 7 jours)
        if ($period >= 7) {
            $this->line('');
            $this->info('📅 Évolution des 7 derniers jours');
            $dailyStats = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dayVisitors = UserAnalytics::whereDate('created_at', $date)->count();
                $dayCookies = UserAnalytics::whereDate('created_at', $date)
                    ->where('cookies_accepted', true)->count();

                $dailyStats[] = [
                    $date->format('d/m'),
                    $dayVisitors,
                    $dayCookies,
                    $dayVisitors > 0 ? round(($dayCookies / $dayVisitors) * 100, 1) . '%' : '0%'
                ];
            }
            $this->table(['Date', 'Visiteurs', 'Cookies OK', 'Taux'], $dailyStats);
        }

        $this->line('');
        $this->info('✅ Rapport terminé');

        return 0;
    }

    /**
     * Get device icon
     */
    private function getDeviceIcon($deviceType)
    {
        switch (strtolower($deviceType)) {
            case 'mobile':
                return '📱';
            case 'tablet':
                return '📟';
            case 'desktop':
            default:
                return '💻';
        }
    }

    /**
     * Get browser icon
     */
    private function getBrowserIcon($browser)
    {
        switch (strtolower($browser)) {
            case 'chrome':
                return '🔵';
            case 'firefox':
                return '🦊';
            case 'safari':
                return '🧭';
            case 'edge':
                return '🔷';
            default:
                return '🌐';
        }
    }

    /**
     * Format duration in seconds to human readable format
     */
    private function formatDuration($seconds)
    {
        if (!$seconds) return '0s';

        $seconds = round($seconds);
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        $parts = [];
        if ($hours > 0) $parts[] = $hours . 'h';
        if ($minutes > 0) $parts[] = $minutes . 'm';
        if ($remainingSeconds > 0 || empty($parts)) $parts[] = $remainingSeconds . 's';

        return implode(' ', $parts);
    }
}

// Commande pour créer cette commande :
// php artisan make:command AnalyticsStats

// Utilisation :
// php artisan analytics:stats
// php artisan analytics:stats --period=7
// php artisan analytics:stats --period=90
