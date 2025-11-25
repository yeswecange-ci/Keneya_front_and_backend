@extends('layouts.admin')

@section('title', 'Dashboard Analytics')
@section('page-title', 'Analytics')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Tableau de bord Analytics</h1>
        <p class="page-description">Vue d'ensemble des statistiques de visite de votre site</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Visiteurs -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Visiteurs Totaux</p>
                    <h3 class="text-3xl font-bold">{{ $stats['total_visitors'] ?? 0 }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Cookies Acceptés -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Cookies Acceptés</p>
                    <h3 class="text-3xl font-bold">{{ $stats['visitors_with_cookies'] ?? 0 }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-green-100">
                @php
                    $percentage = ($stats['total_visitors'] ?? 0) > 0
                        ? round((($stats['visitors_with_cookies'] ?? 0) / $stats['total_visitors']) * 100, 1)
                        : 0;
                @endphp
                {{ $percentage }}% des visiteurs
            </div>
        </div>

        <!-- Visiteurs Aujourd'hui -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Aujourd'hui</p>
                    <h3 class="text-3xl font-bold">{{ $stats['visitors_today'] ?? 0 }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-sm text-purple-100">
                +{{ $stats['visitors_today'] ?? 0 }} nouveaux
            </div>
        </div>

        <!-- Visiteurs Ce Mois -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Ce Mois</p>
                    <h3 class="text-3xl font-bold">{{ $stats['visitors_this_month'] ?? 0 }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers Visiteurs -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Derniers Visiteurs</h2>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>IP</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Dernière Activité</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVisitors ?? [] as $visitor)
                    <tr>
                        <td class="font-mono text-sm">{{ Str::limit($visitor->session_id, 20) }}</td>
                        <td class="font-mono text-sm">{{ $visitor->ip_address }}</td>
                        <td>
                            <span class="inline-flex items-center">
                                <span class="mr-2">🌍</span>
                                {{ $visitor->country ?? 'Inconnu' }}
                            </span>
                        </td>
                        <td>{{ $visitor->city ?? '-' }}</td>
                        <td class="text-gray-500">
                            {{ $visitor->last_activity_at?->format('d/m/Y H:i') ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            Aucun visiteur récent
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Pays -->
        <div class="dashboard-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Top Pays</h2>
            </div>

            @if(isset($topCountries) && count($topCountries) > 0)
                <div class="space-y-3">
                    @foreach($topCountries as $country)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-lg">🌍</span>
                                </div>
                                <span class="font-medium text-gray-900">{{ $country->country ?? 'Inconnu' }}</span>
                            </div>
                            <span class="badge badge-info">{{ $country->count }} visiteurs</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state py-8">
                    <p class="text-gray-500">Aucune donnée disponible</p>
                </div>
            @endif
        </div>

        <!-- Appareils -->
        <div class="dashboard-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Appareils Utilisés</h2>
            </div>

            @if(isset($deviceStats) && count($deviceStats) > 0)
                <div class="space-y-3">
                    @foreach($deviceStats as $device)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    @if($device->device_type == 'desktop')
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif($device->device_type == 'mobile')
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <span class="font-medium text-gray-900">{{ ucfirst($device->device_type) }}</span>
                            </div>
                            <span class="badge badge-success">{{ $device->count }} utilisateurs</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state py-8">
                    <p class="text-gray-500">Aucune donnée disponible</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Export Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Exporter les Données</h2>
                <p class="text-sm text-gray-600">Téléchargez vos statistiques analytics au format CSV</p>
            </div>
            <a href="{{ route('analytics.export') }}" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Exporter CSV
            </a>
        </div>
    </div>
</div>
@endsection
