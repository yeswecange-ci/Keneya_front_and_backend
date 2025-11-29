@extends('layouts.admin')

@section('title', 'Gestion des Activités')
@section('page-title', 'Gestion des Activités')

@section('content')
<div class="space-y-6" x-data="{
    keyNumberModal: false,
    themeModal: false,
    serviceModal: false,
    testimonialModal: false,
    countryModal: false,
    editMode: false
}">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion de la page Activités</h1>
        <p class="page-description">Gérez tous les contenus de votre page activités</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Content Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Contenu de la page</h2>
            <button type="button" class="btn-primary" onclick="toggleSection('pageContentForm')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </button>
        </div>

        <div id="pageContentForm" class="hidden">
            <form action="{{ route('activities.update-page-content') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Titre de la page</label>
                        <input type="text" name="title" class="form-input" value="{{ $pageContents['title'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description Meta</label>
                        <input type="text" name="description" class="form-input" value="{{ $pageContents['description'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Titre Hero</label>
                        <input type="text" name="hero_title" class="form-input" value="{{ $pageContents['hero_title'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image Hero</label>
                        <input type="file" name="hero_image" class="form-input" accept="image/*">
                        @if (isset($pageContents['hero_image']) && $pageContents['hero_image'])
                            <p class="text-xs text-muted mt-1">Image actuelle: {{ basename($pageContents['hero_image']) }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Titre section thèmes</label>
                        <input type="text" name="themes_section_title" class="form-input" value="{{ $pageContents['themes_section_title'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image section thèmes</label>
                        <input type="file" name="themes_section_image" class="form-input" accept="image/*">
                        @if (isset($pageContents['themes_section_image']) && $pageContents['themes_section_image'])
                            <p class="text-xs text-muted mt-1">Image actuelle: {{ basename($pageContents['themes_section_image']) }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Titre section services</label>
                        <input type="text" name="services_section_title" class="form-input" value="{{ $pageContents['services_section_title'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Texte bouton contact</label>
                        <input type="text" name="contact_button_text" class="form-input" value="{{ $pageContents['contact_button_text'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lien bouton contact</label>
                        <input type="url" name="contact_button_url" class="form-input" value="{{ $pageContents['contact_button_url'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Titre section témoignages</label>
                        <input type="text" name="testimonials_section_title" class="form-input" value="{{ $pageContents['testimonials_section_title'] ?? '' }}">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn-success">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Key Numbers Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Chiffres clés</h2>
            <button type="button" class="btn-primary" @click="keyNumberModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un chiffre
            </button>
        </div>

        @if($keyNumbers && $keyNumbers->count() > 0)
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Ordre</th>
                            <th>Icône</th>
                            <th>Valeur</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keyNumbers as $keyNumber)
                        <tr>
                            <td>{{ $keyNumber->activities_keynumber_order }}</td>
                            <td>
                                @if($keyNumber->activities_keynumber_icon)
                                    <img src="{{ asset($keyNumber->activities_keynumber_icon) }}"
                                         alt="Icône"
                                         class="w-8 h-8 object-contain">
                                @else
                                    <span class="text-muted">Aucune icône</span>
                                @endif
                            </td>
                            <td class="font-semibold text-primary">{{ $keyNumber->activities_keynumber_value }}</td>
                            <td>{{ $keyNumber->activities_keynumber_title }}</td>
                            <td>{{ Str::limit($keyNumber->activities_keynumber_description, 50) }}</td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                            onclick="editKeyNumber({{ $keyNumber->id }})">
                                        Modifier
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-keynumber', $keyNumber->id) }}"
                                          onsubmit="return confirm('Êtes-vous sûr ?')" class="inline">
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
            <p class="text-center text-muted py-8">Aucun chiffre clé trouvé</p>
        @endif
    </div>

    <!-- Themes Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Domaines thématiques</h2>
            <button type="button" class="btn-primary" @click="themeModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un thème
            </button>
        </div>

        @if($themes && $themes->count() > 0)
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Ordre</th>
                            <th>Icône</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($themes as $theme)
                        <tr>
                            <td>{{ $theme->activities_theme_order }}</td>
                            <td>
                                @if($theme->activities_theme_icon)
                                    <img src="{{ asset($theme->activities_theme_icon) }}"
                                         alt="Icône"
                                         class="w-8 h-8 object-contain">
                                @else
                                    <span class="text-muted">Aucune icône</span>
                                @endif
                            </td>
                            <td>{{ $theme->activities_theme_title }}</td>
                            <td>{{ Str::limit($theme->activities_theme_description, 50) }}</td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                            onclick="editTheme({{ $theme->id }})">
                                        Modifier
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-theme', $theme->id) }}"
                                          onsubmit="return confirm('Êtes-vous sûr ?')" class="inline">
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
            <p class="text-center text-muted py-8">Aucun thème trouvé</p>
        @endif
    </div>

    <!-- Services Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Services</h2>
            <button type="button" class="btn-primary" @click="serviceModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un service
            </button>
        </div>

        @if($services && $services->count() > 0)
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Ordre</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->activities_service_order }}</td>
                            <td>
                                @if($service->activities_service_image)
                                    <img src="{{ asset($service->activities_service_image) }}"
                                         alt="Image"
                                         class="w-16 h-10 object-cover rounded">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td>{{ $service->activities_service_title }}</td>
                            <td>{{ Str::limit($service->activities_service_description, 50) }}</td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                            onclick="editService({{ $service->id }})">
                                        Modifier
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-service', $service->id) }}"
                                          onsubmit="return confirm('Êtes-vous sûr ?')" class="inline">
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
            <p class="text-center text-muted py-8">Aucun service trouvé</p>
        @endif
    </div>

    <!-- Geographic Coverage Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Couverture géographique</h2>
            <button type="button" class="btn-primary" onclick="toggleSection('geographicForm')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </button>
        </div>

        <div id="geographicForm" class="hidden">
            <form action="{{ route('activities.update-geographic-coverage') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Titre</label>
                        <input type="text" name="activities_coverage_title" class="form-input"
                               value="{{ $geographicCoverage->activities_geographic_title ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="activities_coverage_description" class="form-textarea" rows="3">{{ $geographicCoverage->activities_geographic_description ?? '' }}</textarea>
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="form-label">Code SVG de la carte</label>
                        <textarea name="activities_coverage_map_svg" class="form-textarea" rows="10">{{ $geographicCoverage->activities_geographic_map_svg ?? '' }}</textarea>
                        <p class="text-xs text-muted mt-1">Collez ici le code SVG de votre carte</p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn-success">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Témoignages</h2>
            <button type="button" class="btn-primary" @click="testimonialModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un témoignage
            </button>
        </div>

        @if($testimonials && $testimonials->count() > 0)
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Lien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>
                                @if($testimonial->activities_testimonial_image)
                                    <img src="{{ asset($testimonial->activities_testimonial_image) }}"
                                         alt="Image"
                                         class="w-16 h-10 object-cover rounded">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td>{{ $testimonial->activities_testimonial_title }}</td>
                            <td>{{ Str::limit($testimonial->activities_testimonial_description, 50) }}</td>
                            <td>
                                @if($testimonial->activities_testimonial_link)
                                    <a href="{{ $testimonial->activities_testimonial_link }}" target="_blank"
                                       class="text-primary hover:text-primary-dark">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-muted">Aucun lien</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="btn-secondary text-xs py-1 px-2"
                                            onclick="editTestimonial({{ $testimonial->id }})">
                                        Modifier
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-testimonial', $testimonial->id) }}"
                                          onsubmit="return confirm('Êtes-vous sûr ?')" class="inline">
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
            <p class="text-center text-muted py-8">Aucun témoignage trouvé</p>
        @endif
    </div>

    <!-- Bulk Color Update Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">🎨 Gestion des couleurs - Mise à jour groupée</h3>
        </div>

        <div class="card-body">
            <p class="text-sm text-muted mb-4">
                Sélectionnez plusieurs pays pour leur attribuer la même couleur en une seule fois.
            </p>

            @if($countries && $countries->count() > 0)
                <form method="POST" action="{{ route('activities.bulk-colors') }}" id="bulkColorForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <!-- Sélecteur de couleur -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Couleur à appliquer
                            </label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="color" id="bulkColor" value="#FFD700" required
                                       class="h-12 w-20 p-1 rounded border-2 border-gray-300 cursor-pointer">
                                <span id="colorPreview" class="text-sm font-mono text-gray-700">#FFD700</span>
                            </div>
                        </div>

                        <!-- Compteur de sélection -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-lg border border-green-200">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Pays sélectionnés
                            </label>
                            <div class="text-3xl font-bold text-green-600">
                                <span id="selectedCount">0</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-end">
                            <div class="w-full space-y-2">
                                <button type="submit" class="btn-success w-full" id="applyColorBtn" disabled>
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                    Appliquer la couleur
                                </button>
                                <button type="button" class="btn-secondary w-full text-xs" onclick="selectAllCountries()">
                                    Tout sélectionner
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des pays avec checkboxes -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                        @foreach($countries as $country)
                            <label class="country-checkbox-item cursor-pointer">
                                <input type="checkbox" name="country_ids[]" value="{{ $country->id }}"
                                       class="country-checkbox sr-only" onchange="updateSelectedCount()">
                                <div class="country-card">
                                    <div class="country-flag" style="background-color: {{ $country->color ?? '#FFD700' }}"></div>
                                    <div class="country-info">
                                        <span class="country-code">{{ strtoupper($country->country_code) }}</span>
                                        <span class="country-name">{{ $country->country_name }}</span>
                                    </div>
                                    <div class="country-check">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </form>

                <style>
                    .country-checkbox-item {
                        position: relative;
                    }

                    .country-card {
                        position: relative;
                        padding: 0.75rem;
                        background: white;
                        border: 2px solid #e5e7eb;
                        border-radius: 0.75rem;
                        transition: all 0.2s ease;
                    }

                    .country-card:hover {
                        border-color: #9ca3af;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }

                    .country-checkbox:checked + .country-card {
                        border-color: #3b82f6;
                        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
                        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
                    }

                    .country-flag {
                        width: 100%;
                        height: 3rem;
                        border-radius: 0.5rem;
                        margin-bottom: 0.5rem;
                        border: 1px solid rgba(0, 0, 0, 0.1);
                    }

                    .country-info {
                        display: flex;
                        flex-direction: column;
                        gap: 0.125rem;
                    }

                    .country-code {
                        font-size: 0.875rem;
                        font-weight: 700;
                        color: #1f2937;
                        font-family: monospace;
                    }

                    .country-name {
                        font-size: 0.75rem;
                        color: #6b7280;
                        line-height: 1.2;
                    }

                    .country-check {
                        position: absolute;
                        top: 0.5rem;
                        right: 0.5rem;
                        width: 1.5rem;
                        height: 1.5rem;
                        background: #3b82f6;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        opacity: 0;
                        transform: scale(0);
                        transition: all 0.2s ease;
                    }

                    .country-checkbox:checked ~ .country-card .country-check {
                        opacity: 1;
                        transform: scale(1);
                    }
                </style>
            @else
                <p class="text-muted">Aucun pays disponible pour la mise à jour groupée.</p>
            @endif
        </div>
    </div>

    <!-- Countries Section (Carte d'Afrique Interactive) -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Pays - Carte Interactive</h3>
            <button @click="countryModal = true; editMode = false" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un pays
            </button>
        </div>

        <div class="card-body">
            <p class="text-sm text-muted mb-4">
                Gérez les informations des pays qui s'afficheront sur la carte interactive d'Afrique.
                Utilisez le code ISO à 2 lettres du pays (ex: BF pour Burkina Faso, CI pour Côte d'Ivoire).
            </p>

            @if($countries && $countries->count() > 0)
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Pays</th>
                                <th>Nombre d'activités</th>
                                <th>Image</th>
                                <th>Couleur</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                            <tr>
                                <td>
                                    <span class="font-mono font-bold text-primary">{{ strtoupper($country->country_code) }}</span>
                                </td>
                                <td class="font-medium">{{ $country->country_name }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ is_array($country->activities) ? count($country->activities) : 0 }} activité(s)
                                    </span>
                                </td>
                                <td>
                                    @if($country->image)
                                        <img src="{{ asset($country->image) }}"
                                             alt="{{ $country->country_name }}"
                                             class="w-16 h-10 object-cover rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 rounded border border-gray-200" style="background-color: {{ $country->color ?? '#FFD700' }}"></div>
                                        <span class="text-xs text-muted">{{ $country->color ?? '#FFD700' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $country->is_active ? 'success' : 'secondary' }}">
                                        {{ $country->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <button type="button" class="btn-warning btn-sm"
                                                onclick="editCountry({{ $country->id }})">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <form method="POST" action="{{ route('activities.delete-country', $country->id) }}"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce pays ?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger btn-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted py-8">
                    Aucun pays ajouté. Cliquez sur "Ajouter un pays" pour commencer.
                </p>
            @endif
        </div>
    </div>

    <!-- Modals will be included here -->
    @include('admin.activities.modals.keynumber-modals')
    @include('admin.activities.modals.theme-modals')
    @include('admin.activities.modals.service-modals')
    @include('admin.activities.modals.testimonial-modals')
    @include('admin.activities.modals.country-modals')
</div>
@endsection

@push('scripts')
<script>
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.classList.toggle('hidden');
}

// Bulk Color Update Functions
function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.country-checkbox:checked');
    const count = checkboxes.length;
    document.getElementById('selectedCount').textContent = count;
    document.getElementById('applyColorBtn').disabled = count === 0;
}

function selectAllCountries() {
    const checkboxes = document.querySelectorAll('.country-checkbox');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);

    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });

    updateSelectedCount();
}

// Mise à jour de l'aperçu de couleur
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('bulkColor');
    const colorPreview = document.getElementById('colorPreview');

    if (colorInput && colorPreview) {
        colorInput.addEventListener('input', function(e) {
            colorPreview.textContent = e.target.value.toUpperCase();
        });
    }
});

// Key Number Functions
function editKeyNumber(id) {
    fetch(`/dashboard/activities/keynumbers/${id}/edit`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById('edit_keynumber_title').value = data.activities_keynumber_title || '';
            document.getElementById('edit_keynumber_value').value = data.activities_keynumber_value || 0;
            document.getElementById('edit_keynumber_description').value = data.activities_keynumber_description || '';
            document.getElementById('edit_keynumber_order').value = data.activities_keynumber_order || 0;

            document.getElementById('editKeyNumberForm').action = `/dashboard/activities/keynumbers/${id}`;
            window.dispatchEvent(new CustomEvent('open-keynumber-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}

// Theme Functions
function editTheme(id) {
    fetch(`/dashboard/activities/themes/${id}/edit`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById('edit_theme_title').value = data.activities_theme_title || '';
            document.getElementById('edit_theme_description').value = data.activities_theme_description || '';
            document.getElementById('edit_theme_order').value = data.activities_theme_order || 0;

            document.getElementById('editThemeForm').action = `/dashboard/activities/themes/${id}`;
            window.dispatchEvent(new CustomEvent('open-theme-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}

// Service Functions
function editService(id) {
    fetch(`/dashboard/activities/services/${id}/edit`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById('edit_service_title').value = data.activities_service_title || '';
            document.getElementById('edit_service_description').value = data.activities_service_description || '';
            document.getElementById('edit_service_order').value = data.activities_service_order || 0;

            // Handle PDF info
            const pdfInfo = document.getElementById('current_pdf_info');
            if (data.activities_service_pdf_path) {
                pdfInfo.innerHTML = 'PDF actuel: <a href="/storage/' + data.activities_service_pdf_path + '" target="_blank" class="text-blue-600 hover:underline">Télécharger</a>';
            } else {
                pdfInfo.innerHTML = 'Aucun PDF actuellement.';
            }

            // Handle service features
            const featuresContainer = document.getElementById('edit-service-features');
            featuresContainer.innerHTML = '';

            let features = [];
            if (data.activities_service_features) {
                try {
                    features = typeof data.activities_service_features === 'string' ?
                        JSON.parse(data.activities_service_features) : data.activities_service_features;
                } catch (e) {
                    features = [];
                }
            }

            if (features.length === 0) features = [''];
            features.forEach(feature => addEditServiceFeature(feature));

            document.getElementById('editServiceForm').action = `/dashboard/activities/services/${id}`;
            window.dispatchEvent(new CustomEvent('open-service-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}

function addServiceFeature() {
    const container = document.getElementById('service-features');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="activities_service_features[]" class="form-input flex-1" placeholder="Caractéristique du service">
        <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeServiceFeature(this)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function addEditServiceFeature(value = '') {
    const container = document.getElementById('edit-service-features');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="activities_service_features[]" class="form-input flex-1" placeholder="Caractéristique du service" value="${value}">
        <button type="button" class="btn-success text-xs py-2 px-3" onclick="addEditServiceFeature()">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>
        <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeServiceFeature(this)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeServiceFeature(button) {
    const container = button.closest('#service-features, #edit-service-features');
    if (container.children.length > 1) {
        button.closest('.flex').remove();
    } else {
        button.previousElementSibling.value = '';
    }
}

// Testimonial Functions
function editTestimonial(id) {
    fetch(`/dashboard/activities/testimonials/${id}/edit`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById('edit_testimonial_title').value = data.activities_testimonial_title || '';
            document.getElementById('edit_testimonial_description').value = data.activities_testimonial_description || '';
            document.getElementById('edit_testimonial_link').value = data.activities_testimonial_link || '';

            document.getElementById('editTestimonialForm').action = `/dashboard/activities/testimonials/${id}`;
            window.dispatchEvent(new CustomEvent('open-testimonial-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}
</script>
@endpush
