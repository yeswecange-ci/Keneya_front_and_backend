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
            <div class="flex items-center justify-between mb-4">
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

        <!-- Sessions Actives -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Sessions Actives</p>
                    <h3 class="text-3xl font-bold">{{ $stats['active_sessions'] ?? 0 }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Taux de Conversion -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Taux d'Acceptation</p>
                    <h3 class="text-3xl font-bold">{{ $percentage ?? 0 }}%</h3>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Countries -->
        <div class="dashboard-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Top Pays</h2>
                <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</button>
            </div>

            @if(isset($countries) && count($countries) > 0)
                <div class="space-y-4">
                    @foreach($countries as $country)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-lg">🌍</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $country->country ?? 'Inconnu' }}</p>
                                    <p class="text-sm text-gray-500">{{ $country->count }} visiteurs</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ round(($country->count / $stats['total_visitors']) * 100, 1) }}%</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p class="text-gray-500">Aucune donnée disponible</p>
                </div>
            @endif
        </div>

        <!-- Top Browsers -->
        <div class="dashboard-card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Navigateurs Populaires</h2>
                <button class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</button>
            </div>

            @if(isset($browsers) && count($browsers) > 0)
                <div class="space-y-4">
                    @foreach($browsers as $browser)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $browser->browser ?? 'Inconnu' }}</p>
                                    <p class="text-sm text-gray-500">{{ $browser->count }} utilisateurs</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ round(($browser->count / $stats['total_visitors']) * 100, 1) }}%</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
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
