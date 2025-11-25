@extends('layouts.admin')

@section('title', 'Gestion de la page d\'accueil')
@section('page-title', 'Gestion de la page d\'accueil')

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'slides' }">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion de la page d'accueil</h1>
        <p class="page-description">Gérez tous les contenus de la page d'accueil de votre site</p>
    </div>

    <!-- Messages de succès/erreur -->
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button @click="activeTab = 'slides'"
                    :class="activeTab === 'slides' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Slides d'accueil
                </button>
                <button @click="activeTab = 'about'"
                    :class="activeTab === 'about' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    À propos
                </button>
                <button @click="activeTab = 'keynumbers'"
                    :class="activeTab === 'keynumbers' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Chiffres clés
                </button>
                <button @click="activeTab = 'partners'"
                    :class="activeTab === 'partners' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Partenaires
                </button>
                <button @click="activeTab = 'footer'"
                    :class="activeTab === 'footer' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Footer
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- SLIDES TAB -->
            <div x-show="activeTab === 'slides'" x-transition class="space-y-6">
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Slides d'accueil</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addSlideModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter une slide
                        </button>
                    </div>

                    @if (isset($homeSlides) && $homeSlides->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Ordre</th>
                                        <th>Image</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homeSlides as $slide)
                                        <tr>
                                            <td class="font-medium">{{ $slide->home_slide_number }}</td>
                                            <td>{{ Str::limit(strip_tags($slide->home_slide_title), 50) }}</td>
                                            <td class="text-muted">{{ Str::limit($slide->home_slide_description, 80) }}</td>
                                            <td>{{ $slide->home_slide_order }}</td>
                                            <td>
                                                @if ($slide->home_slide_image)
                                                    <img src="{{ asset($slide->home_slide_image) }}"
                                                        alt="Slide {{ $slide->home_slide_number }}"
                                                        class="h-12 w-20 object-cover rounded">
                                                @else
                                                    <span class="text-muted text-sm">Aucune image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $slide->home_slide_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $slide->home_slide_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editSlide(@json($slide))'>
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.stats.toggle', $slide->id) }}"
                                                        class="btn-secondary text-xs py-1 px-2">
                                                        {{ $slide->home_slide_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form action="{{ route('dashboard.accueil.slides.delete', $slide->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette slide ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucune slide</h3>
                            <p class="empty-state-description">Commencez par ajouter votre première slide</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ABOUT TAB -->
            <div x-show="activeTab === 'about'" x-transition class="space-y-6">
                <div class="dashboard-card">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Section À propos</h2>
                    <form action="{{ route('dashboard.accueil.about.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Titre de section</label>
                            <input type="text" class="form-input" name="home_about_section_title"
                                value="{{ isset($homeAbout) ? $homeAbout->home_about_section_title : old('home_about_section_title') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Titre principal</label>
                            <textarea class="form-textarea" name="home_about_main_title" rows="2" required>{{ isset($homeAbout) ? $homeAbout->home_about_main_title : old('home_about_main_title') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-textarea" name="home_about_description" rows="4" required>{{ isset($homeAbout) ? $homeAbout->home_about_description : old('home_about_description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Texte du bouton</label>
                                <input type="text" class="form-input" name="home_about_button_text"
                                    value="{{ isset($homeAbout) ? $homeAbout->home_about_button_text : old('home_about_button_text') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lien du bouton</label>
                                <input type="text" class="form-input" name="home_about_button_link"
                                    value="{{ isset($homeAbout) ? $homeAbout->home_about_button_link : old('home_about_button_link') }}"
                                    required>
                            </div>
                        </div>

                        <button type="submit" class="btn-success">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sauvegarder
                        </button>
                    </form>
                </div>
            </div>

            <!-- KEYNUMBERS TAB -->
            <div x-show="activeTab === 'keynumbers'" x-transition class="space-y-6">
                <!-- Section principale -->
                <div class="dashboard-card">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Section Chiffres clés</h2>
                    <form action="{{ route('dashboard.accueil.keynumbers.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Titre de section</label>
                            <input type="text" class="form-input" name="home_key_numbers_section_title"
                                value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_section_title : old('home_key_numbers_section_title') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-textarea" name="home_key_numbers_description" rows="3" required>{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_description : old('home_key_numbers_description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Texte du bouton</label>
                                <input type="text" class="form-input" name="home_key_numbers_button_text"
                                    value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_button_text : old('home_key_numbers_button_text') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lien du bouton</label>
                                <input type="text" class="form-input" name="home_key_numbers_button_link"
                                    value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_button_link : old('home_key_numbers_button_link') }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Image de section</label>
                            <input type="file" class="form-input" name="home_key_numbers_image" accept="image/*">
                            @if (isset($homeKeyNumbers) && $homeKeyNumbers->home_key_numbers_image)
                                <div class="mt-3">
                                    <img src="{{ asset($homeKeyNumbers->home_key_numbers_image) }}"
                                        alt="Image actuelle" class="h-24 w-auto rounded border border-gray-200">
                                    <small class="text-muted block mt-1">Image actuelle</small>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn-success">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <!-- Statistiques -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Statistiques</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addStatModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter une statistique
                        </button>
                    </div>

                    @if (isset($homeKeyNumbers) && $homeKeyNumbers->activeStats && $homeKeyNumbers->activeStats->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Icône</th>
                                        <th>Nombre</th>
                                        <th>Description</th>
                                        <th>Ordre</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homeKeyNumbers->activeStats as $stat)
                                        <tr>
                                            <td>
                                                @if ($stat->home_stat_icon)
                                                    <img src="{{ asset($stat->home_stat_icon) }}"
                                                        alt="Icône" class="h-8 w-8 object-contain">
                                                @else
                                                    <span class="text-muted text-sm">Aucune</span>
                                                @endif
                                            </td>
                                            <td class="font-semibold">{{ $stat->home_stat_number }}</td>
                                            <td>{{ $stat->home_stat_description }}</td>
                                            <td>{{ $stat->home_stat_order }}</td>
                                            <td>
                                                <span class="badge {{ $stat->home_stat_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $stat->home_stat_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editStat(@json($stat))'>
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.stats.toggle', $stat->id) }}"
                                                        class="btn-secondary text-xs py-1 px-2">
                                                        {{ $stat->home_stat_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form action="{{ route('dashboard.accueil.stats.delete', $stat->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Supprimer cette statistique ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucune statistique</h3>
                            <p class="empty-state-description">Ajoutez votre première statistique</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- PARTNERS TAB -->
            <div x-show="activeTab === 'partners'" x-transition class="space-y-6">
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Logos des partenaires</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addPartnerModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter un partenaire
                        </button>
                    </div>

                    @if (isset($homePartners) && $homePartners->allItems && $homePartners->allItems->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Texte alternatif</th>
                                        <th>Ordre</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homePartners->allItems as $partnerItem)
                                        <tr>
                                            <td>
                                                @if ($partnerItem->home_partner_item_image)
                                                    <img src="{{ asset($partnerItem->home_partner_item_image) }}"
                                                        alt="{{ $partnerItem->home_partner_item_alt }}"
                                                        class="h-12 w-20 object-contain">
                                                @else
                                                    <span class="text-muted text-sm">Aucune image</span>
                                                @endif
                                            </td>
                                            <td>{{ $partnerItem->home_partner_item_alt ?? 'Non défini' }}</td>
                                            <td>{{ $partnerItem->home_partner_item_order }}</td>
                                            <td>
                                                <span class="badge {{ $partnerItem->home_partner_item_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $partnerItem->home_partner_item_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editPartnerItem(@json($partnerItem))'>
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.partners.items.toggle', $partnerItem->id) }}"
                                                        class="btn-secondary text-xs py-1 px-2">
                                                        {{ $partnerItem->home_partner_item_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form action="{{ route('dashboard.accueil.partners.items.delete', $partnerItem->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Supprimer ce partenaire ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucun partenaire</h3>
                            <p class="empty-state-description">Ajoutez votre premier partenaire</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- FOOTER TAB -->
            <div x-show="activeTab === 'footer'" x-transition class="space-y-6">
                <!-- Paramètres généraux -->
                <div class="dashboard-card">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Paramètres généraux du Footer</h2>
                    <form action="{{ route('dashboard.accueil.footer.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Logo 1</label>
                                <input type="file" class="form-input" name="footer_logo1" accept="image/*">
                                @if (isset($footerSettings) && $footerSettings->footer_logo1)
                                    <div class="mt-3">
                                        <img src="{{ asset($footerSettings->footer_logo1) }}" alt="Logo 1" class="h-16 w-auto">
                                        <small class="text-muted block mt-1">Logo 1 actuel</small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Logo 2</label>
                                <input type="file" class="form-input" name="footer_logo2" accept="image/*">
                                @if (isset($footerSettings) && $footerSettings->footer_logo2)
                                    <div class="mt-3">
                                        <img src="{{ asset($footerSettings->footer_logo2) }}" alt="Logo 2" class="h-16 w-auto">
                                        <small class="text-muted block mt-1">Logo 2 actuel</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Copyright</label>
                                <input type="text" class="form-input" name="footer_copyright"
                                    value="{{ isset($footerSettings) ? $footerSettings->footer_copyright : old('footer_copyright') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lien mentions légales</label>
                                <input type="text" class="form-input" name="footer_legal_link"
                                    value="{{ isset($footerSettings) ? $footerSettings->footer_legal_link : old('footer_legal_link') }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Texte mentions légales</label>
                            <input type="text" class="form-input" name="footer_legal_text"
                                value="{{ isset($footerSettings) ? $footerSettings->footer_legal_text : old('footer_legal_text') }}"
                                required>
                        </div>

                        <button type="submit" class="btn-success">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sauvegarder les paramètres
                        </button>
                    </form>
                </div>

                <!-- Colonnes du Footer -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Colonnes du Footer</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addColumnModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter une colonne
                        </button>
                    </div>

                    @if (isset($footerColumns) && $footerColumns->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Ordre</th>
                                        <th>Nombre de liens</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($footerColumns as $column)
                                        <tr>
                                            <td class="font-semibold">{{ $column->column_title }}</td>
                                            <td>{{ $column->column_order }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $column->allLinks ? $column->allLinks->count() : 0 }} liens
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editColumn(@json($column))'>
                                                        Modifier
                                                    </button>
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='manageLinks(@json($column))'>
                                                        Gérer les liens
                                                    </button>
                                                    <form action="{{ route('dashboard.accueil.footer.columns.delete', $column->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Supprimer cette colonne et tous ses liens ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucune colonne</h3>
                            <p class="empty-state-description">Ajoutez votre première colonne de footer</p>
                        </div>
                    @endif
                </div>

                <!-- Liens du Footer -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Tous les liens du Footer</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addLinkModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter un lien
                        </button>
                    </div>

                    @if (isset($footerLinks) && $footerLinks->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Colonne</th>
                                        <th>Texte du lien</th>
                                        <th>URL</th>
                                        <th>Ordre</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($footerLinks as $link)
                                        <tr>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $link->column ? $link->column->column_title : 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="font-medium">{{ $link->link_text }}</td>
                                            <td class="text-muted text-sm">{{ Str::limit($link->link_url, 50) }}</td>
                                            <td>{{ $link->link_order }}</td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editLink(@json($link))'>
                                                        Modifier
                                                    </button>
                                                    <form action="{{ route('dashboard.accueil.footer.links.delete', $link->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Supprimer ce lien ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucun lien</h3>
                            <p class="empty-state-description">Ajoutez votre premier lien de footer</p>
                        </div>
                    @endif
                </div>

                <!-- Réseaux Sociaux -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Réseaux Sociaux</h2>
                        <button type="button" class="btn-primary" onclick="document.getElementById('addSocialModal').classList.remove('hidden')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter un réseau social
                        </button>
                    </div>

                    @if (isset($footerSocials) && $footerSocials->count() > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Icône</th>
                                        <th>Plateforme</th>
                                        <th>URL</th>
                                        <th>Ordre</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($footerSocials as $social)
                                        <tr>
                                            <td>
                                                @if ($social->social_icon)
                                                    <img src="{{ asset($social->social_icon) }}"
                                                        alt="{{ $social->social_platform }}"
                                                        class="h-8 w-8 object-contain">
                                                @else
                                                    <span class="text-muted text-sm">Aucune</span>
                                                @endif
                                            </td>
                                            <td class="font-semibold">{{ $social->social_platform }}</td>
                                            <td class="text-muted text-sm">{{ Str::limit($social->social_url, 50) }}</td>
                                            <td>{{ $social->social_order }}</td>
                                            <td>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                                        onclick='editSocial(@json($social))'>
                                                        Modifier
                                                    </button>
                                                    <form action="{{ route('dashboard.accueil.footer.socials.delete', $social->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Supprimer ce réseau social ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger text-xs py-1 px-2">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <h3 class="empty-state-title">Aucun réseau social</h3>
                            <p class="empty-state-description">Ajoutez votre premier réseau social</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modales -->
@include('admin.home.modals.slide-modals')
@include('admin.home.modals.stat-modals')
@include('admin.home.modals.partner-modals')
@include('admin.home.modals.footer-modals')

@push('scripts')
<script>
    function editSlide(slide) {
        document.getElementById('edit_home_slide_number').value = slide.home_slide_number;
        document.getElementById('edit_home_slide_title').value = slide.home_slide_title;
        document.getElementById('edit_home_slide_description').value = slide.home_slide_description;
        document.getElementById('edit_home_slide_order').value = slide.home_slide_order;

        const form = document.getElementById('editSlideForm');
        form.action = "{{ route('dashboard.accueil.slides.update', ':id') }}".replace(':id', slide.id);

        document.getElementById('editSlideModal').classList.remove('hidden');
    }

    function editStat(stat) {
        document.getElementById('edit_home_stat_number').value = stat.home_stat_number;
        document.getElementById('edit_home_stat_description').value = stat.home_stat_description;
        document.getElementById('edit_home_stat_order').value = stat.home_stat_order;

        const form = document.getElementById('editStatForm');
        form.action = "{{ route('dashboard.accueil.stats.update', ':id') }}".replace(':id', stat.id);

        document.getElementById('editStatModal').classList.remove('hidden');
    }

    function editPartnerItem(partnerItem) {
        document.getElementById('edit_home_partner_item_alt').value = partnerItem.home_partner_item_alt || '';
        document.getElementById('edit_home_partner_item_order').value = partnerItem.home_partner_item_order;

        const form = document.getElementById('editPartnerForm');
        form.action = "{{ route('dashboard.accueil.partners.items.update', ':id') }}".replace(':id', partnerItem.id);

        document.getElementById('editPartnerModal').classList.remove('hidden');
    }

    // Footer functions
    function editColumn(column) {
        document.getElementById('edit_column_title').value = column.column_title;
        document.getElementById('edit_column_order').value = column.column_order;

        const form = document.getElementById('editColumnForm');
        form.action = "{{ route('dashboard.accueil.footer.columns.update', ':id') }}".replace(':id', column.id);

        document.getElementById('editColumnModal').classList.remove('hidden');
    }

    function manageLinks(column) {
        document.getElementById('current_column_title').textContent = column.column_title;
        document.getElementById('quick_add_column_id').value = column.id;

        // TODO: Load links for this column via AJAX or pass them from controller
        document.getElementById('manageLinksModal').classList.remove('hidden');
    }

    function editLink(link) {
        document.getElementById('edit_link_column_id').value = link.footer_column_id;
        document.getElementById('edit_link_text').value = link.link_text;
        document.getElementById('edit_link_url').value = link.link_url;
        document.getElementById('edit_link_order').value = link.link_order;

        const form = document.getElementById('editLinkForm');
        form.action = "{{ route('dashboard.accueil.footer.links.update', ':id') }}".replace(':id', link.id);

        document.getElementById('editLinkModal').classList.remove('hidden');
    }

    function editSocial(social) {
        document.getElementById('edit_social_platform').value = social.social_platform;
        document.getElementById('edit_social_url').value = social.social_url;
        document.getElementById('edit_social_order').value = social.social_order;

        const form = document.getElementById('editSocialForm');
        form.action = "{{ route('dashboard.accueil.footer.socials.update', ':id') }}".replace(':id', social.id);

        document.getElementById('editSocialModal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
