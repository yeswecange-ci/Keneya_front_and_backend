<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class UserAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_agent',
        'ip_address',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
        'referrer',
        'landing_page',
        'pages_visited',
        'session_duration',
        'first_visit_at',
        'last_activity_at',
        'cookies_accepted',
        'cookies_accepted_at',
    ];

    protected $casts = [
        'pages_visited' => 'array',
        'first_visit_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'cookies_accepted_at' => 'datetime',
        'cookies_accepted' => 'boolean',
    ];

    /**
     * Ajouter une page visitée
     */
    public function addPageVisit($page, $timestamp = null)
    {
        $pages = $this->pages_visited ?? [];
        $pages[] = [
            'page' => $page,
            'visited_at' => $timestamp ?? now()->toISOString()
        ];
        $this->pages_visited = $pages;
        $this->save();
    }

    /**
     * Mettre à jour la durée de session
     */
    public function updateSessionDuration()
    {
        if ($this->first_visit_at) {
            $this->session_duration = now()->diffInSeconds($this->first_visit_at);
            $this->last_activity_at = now();
            $this->save();
        }
    }

    /**
     * Obtenir les informations de géolocalisation
     */
    public static function getLocationFromIP($ip)
    {
        try {
            $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}");
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'country' => $data['country'] ?? null,
                    'city' => $data['city'] ?? null,
                ];
            }
        } catch (\Exception $e) {
            // Log l'erreur si nécessaire
        }

        return ['country' => null, 'city' => null];
    }

    /**
     * Parser le User Agent
     */
    public static function parseUserAgent($userAgent)
    {
        $device = 'desktop';
        $browser = 'unknown';
        $os = 'unknown';

        // Détection du device
        if (preg_match('/Mobile|Android|iPhone|iPad/', $userAgent)) {
            if (preg_match('/iPad/', $userAgent)) {
                $device = 'tablet';
            } else {
                $device = 'mobile';
            }
        }

        // Détection du navigateur
        if (preg_match('/Chrome/', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox/', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari/', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Edge/', $userAgent)) {
            $browser = 'Edge';
        }

        // Détection de l'OS
        if (preg_match('/Windows/', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS/', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Linux/', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone|iPad/', $userAgent)) {
            $os = 'iOS';
        }

        return [
            'device_type' => $device,
            'browser' => $browser,
            'os' => $os
        ];
    }
}
