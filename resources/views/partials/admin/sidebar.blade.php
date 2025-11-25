<!-- Sidebar pour mobile (overlay) -->
<div id="mobile-sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden hidden transition-opacity duration-300"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Logo -->
    <div class="flex items-center justify-center h-auto px-6 py-4 border-b border-gray-200 bg-white">
        <a href="{{ route('dashboard.homepage') }}" class="flex items-center justify-center">
            <img src="{{ asset('img/logo2.png') }}" alt="Keneya Logo" class="w-auto max-w-full">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('dashboard.homepage') }}" class="sidebar-link {{ request()->routeIs('dashboard.homepage') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Section Divider -->
        <div class="pt-4 pb-2">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Gestion du contenu</p>
        </div>

        <!-- Page d'Accueil -->
        <a href="{{ route('dashboard.accueil') }}" class="sidebar-link {{ request()->routeIs('dashboard.accueil') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <span>Page d'Accueil</span>
        </a>

        <!-- À Propos -->
        <a href="{{ route('dashboard.about') }}" class="sidebar-link {{ request()->routeIs('dashboard.about*') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>À Propos</span>
        </a>

        <!-- Activités -->
        <a href="{{ route('dashboard.activities') }}" class="sidebar-link {{ request()->routeIs('dashboard.activities*') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span>Activités</span>
        </a>

        <!-- Actualités -->
        <a href="{{ route('dashboard.actualities') }}" class="sidebar-link {{ request()->routeIs('dashboard.actualities*') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <span>Actualités</span>
        </a>

        <!-- Experts -->
        <a href="{{ route('dashboard.expert') }}" class="sidebar-link {{ request()->routeIs('dashboard.expert*') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span>Équipe d'Experts</span>
        </a>

        <!-- Contact -->
        <a href="{{ route('dashboard.contact') }}" class="sidebar-link {{ request()->routeIs('dashboard.contact*') ? 'active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>Contact & Soumissions</span>
        </a>
    </nav>

    <!-- Footer de la sidebar -->
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">
                    {{ Auth::user()->name ?? 'Utilisateur' }}
                </p>
                <p class="text-xs text-gray-500 truncate">
                    Administrateur
                </p>
            </div>
        </div>
    </div>
</aside>
