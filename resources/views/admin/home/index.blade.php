@extends('layouts.backend.app')

@section('title', 'Gestion de la page d\'accueil')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        font-weight: 600;
        border-bottom: 3px solid #0d6efd;
    }

    .card-header {
        background-color: #f8f9fa;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.85em;
    }

    .tab-pane {
        padding: 20px 0;
    }

    .alert {
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #198754;
    }

    .alert-danger {
        border-left-color: #dc3545;
    }

    .img-thumbnail {
        height: 70px !important;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <!-- Messages de succès/erreur -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Titre de la page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion de la page d'accueil</h1>
        </div>

        <!-- Onglets -->
        <ul class="nav nav-tabs" id="homeTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="slides-tab" data-bs-toggle="tab" data-bs-target="#slides" type="button"
                    role="tab" aria-selected="true">
                    Slides d'accueil
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button"
                    role="tab" aria-selected="false">
                    À propos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="keynumbers-tab" data-bs-toggle="tab" data-bs-target="#keynumbers"
                    type="button" role="tab" aria-selected="false">
                    Chiffres clés
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="partners-tab" data-bs-toggle="tab" data-bs-target="#partners" type="button"
                    role="tab" aria-selected="false">
                    Partenaires
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button"
                    role="tab" aria-selected="false">
                    Footer
                </button>
            </li>
        </ul>

        <div class="tab-content p-3 border-start border-end border-bottom rounded-bottom" id="homeTabContent">
            <!-- GESTION DES SLIDES -->
            <div class="tab-pane fade show active" id="slides" role="tabpanel" aria-labelledby="slides-tab">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Slides d'accueil</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSlideModal">
                            Ajouter une slide
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($homeSlides) && $homeSlides->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
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
                                                <td>{{ $slide->home_slide_number }}</td>
                                                <td>{{ Str::limit(strip_tags($slide->home_slide_title), 50) }}</td>
                                                <td>{{ Str::limit($slide->home_slide_description, 80) }}</td>
                                                <td>{{ $slide->home_slide_order }}</td>
                                                <td>
                                                    @if ($slide->home_slide_image)
                                                        <img src="{{ asset($slide->home_slide_image) }}"
                                                            alt="Slide {{ $slide->home_slide_number }} - {{ Str::limit(strip_tags($slide->home_slide_title), 30) }}"
                                                            class="img-thumbnail">
                                                    @else
                                                        <span class="text-muted">Aucune image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $slide->home_slide_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $slide->home_slide_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editSlide({{ $slide->toJson() }})" data-bs-toggle="modal"
                                                        data-bs-target="#editSlideModal">
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.stats.toggle', $slide->id) }}"
                                                        class="btn btn-sm {{ $slide->home_slide_active ? 'btn-secondary' : 'btn-success' }}">
                                                        {{ $slide->home_slide_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('dashboard.accueil.slides.delete', $slide->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette slide ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Aucune slide trouvée. <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#addSlideModal">Ajouter la première slide</a></p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- GESTION À PROPOS -->
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Section À propos</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.accueil.about.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Titre de section</label>
                                <input type="text" class="form-control" name="home_about_section_title"
                                    value="{{ isset($homeAbout) ? $homeAbout->home_about_section_title : old('home_about_section_title') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Titre principal</label>
                                <textarea class="form-control" name="home_about_main_title" rows="2" required>{{ isset($homeAbout) ? $homeAbout->home_about_main_title : old('home_about_main_title') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name='home_about_description' rows="4" required>{{ isset($homeAbout) ? $homeAbout->home_about_description : old('home_about_description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Texte du bouton</label>
                                        <input type="text" class="form-control" name="home_about_button_text"
                                            value="{{ isset($homeAbout) ? $homeAbout->home_about_button_text : old('home_about_button_text') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lien du bouton</label>
                                        <input type="url" class="form-control" name="home_about_button_link"
                                            value="{{ isset($homeAbout) ? $homeAbout->home_about_button_link : old('home_about_button_link') }}"
                                            pattern="https?://.+" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- GESTION CHIFFRES CLÉS -->
            <div class="tab-pane fade" id="keynumbers" role="tabpanel" aria-labelledby='keynumbers-tab'>
                <!-- Section principale -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Section Chiffres clés</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.accueil.keynumbers.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Titre de section</label>
                                <input type="text" class="form-control" name="home_key_numbers_section_title"
                                    value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_section_title : old('home_key_numbers_section_title') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="home_key_numbers_description" rows="3" required>{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_description : old('home_key_numbers_description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Texte du bouton</label>
                                        <input type="text" class="form-control" name="home_key_numbers_button_text"
                                            value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_button_text : old('home_key_numbers_button_text') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lien du bouton</label>
                                        <input type="url" class="form-control" name="home_key_numbers_button_link"
                                            value="{{ isset($homeKeyNumbers) ? $homeKeyNumbers->home_key_numbers_button_link : old('home_key_numbers_button_link') }}"
                                            pattern="https?://.+" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image de section</label>
                                <input type="file" class="form-control" name="home_key_numbers_image"
                                    accept="image/*">
                                @if (isset($homeKeyNumbers) && $homeKeyNumbers->home_key_numbers_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($homeKeyNumbers->home_key_numbers_image) }}"
                                            alt="Image actuelle des chiffres clés" class="img-thumbnail">
                                        <small class="text-muted d-block">Image actuelle</small>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </form>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Statistiques</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addStatModal">
                            Ajouter une statistique
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($homeKeyNumbers) && $homeKeyNumbers->activeStats && $homeKeyNumbers->activeStats->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
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
                                                            alt="Icône statistique {{ $stat->home_stat_number }}"
                                                            class="img-thumbnail" style="width: 30px; height: 30px;">
                                                    @else
                                                        <span class="text-muted">Aucune icône</span>
                                                    @endif
                                                </td>
                                                <td>{{ $stat->home_stat_number }}</td>
                                                <td>{{ $stat->home_stat_description }}</td>
                                                <td>{{ $stat->home_stat_order }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $stat->home_stat_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $stat->home_stat_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editStat({{ $stat->toJson() }})" data-bs-toggle="modal"
                                                        data-bs-target="#editStatModal">
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.stats.toggle', $stat->id) }}"
                                                        class="btn btn-sm {{ $stat->home_stat_active ? 'btn-secondary' : 'btn-success' }}">
                                                        {{ $stat->home_stat_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('dashboard.accueil.stats.delete', $stat->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Supprimer cette statistique ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Aucune statistique trouvée.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- GESTION PARTENAIRES -->
            <div class="tab-pane fade" id="partners" role="tabpanel" aria-labelledby="partners-tab">
                <!-- Section principale -->
                {{-- <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Section Partenaires</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.accueil.partners.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Titre de section</label>
                                <input type="text" class="form-control" name="home_partner_section_title"
                                    value="{{ isset($homePartners) ? $homePartners->home_partner_section_title : old('home_partner_section_title') }}"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </form>
                    </div>
                </div> --}}

                <!-- Items partenaires -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Logos des partenaires</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addPartnerModal">
                            Ajouter un partenaire
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($homePartners) && $homePartners->allItems && $homePartners->allItems->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
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
                                                            class="img-thumbnail" style="max-height: 50px;">
                                                    @else
                                                        <span class="text-muted">Aucune image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $partnerItem->home_partner_item_alt ?? 'Non défini' }}</td>
                                                <td>{{ $partnerItem->home_partner_item_order }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $partnerItem->home_partner_item_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $partnerItem->home_partner_item_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editPartnerItem({{ $partnerItem->toJson() }})"
                                                        data-bs-toggle="modal" data-bs-target="#editPartnerModal">
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.partners.items.toggle', $partnerItem->id) }}"
                                                        class="btn btn-sm {{ $partnerItem->home_partner_item_active ? 'btn-secondary' : 'btn-success' }}">
                                                        {{ $partnerItem->home_partner_item_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('dashboard.accueil.partners.items.delete', $partnerItem->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Supprimer ce partenaire ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Aucun partenaire trouvé.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- GESTION FOOTER -->
            <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                <!-- Paramètres généraux du footer -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Paramètres généraux du Footer</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.accueil.footer.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Logo 1</label>
                                        <input type="file" class="form-control" name="footer_logo1" accept="image/*">
                                        @if (isset($footerSettings) && $footerSettings->footer_logo1)
                                            <div class="mt-2">
                                                <img src="{{ asset($footerSettings->footer_logo1) }}" alt="Logo 1 actuel" class="img-thumbnail" style="max-height: 60px;">
                                                <small class="text-muted d-block">Logo 1 actuel</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Logo 2</label>
                                        <input type="file" class="form-control" name="footer_logo2" accept="image/*">
                                        @if (isset($footerSettings) && $footerSettings->footer_logo2)
                                            <div class="mt-2">
                                                <img src="{{ asset($footerSettings->footer_logo2) }}" alt="Logo 2 actuel" class="img-thumbnail" style="max-height: 60px;">
                                                <small class="text-muted d-block">Logo 2 actuel</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Copyright</label>
                                        <input type="text" class="form-control" name="footer_copyright"
                                            value="{{ isset($footerSettings) ? $footerSettings->footer_copyright : old('footer_copyright') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lien mentions légales</label>
                                        <input type="text" class="form-control" name="footer_legal_link"
                                            value="{{ isset($footerSettings) ? $footerSettings->footer_legal_link : old('footer_legal_link') }}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Texte mentions légales</label>
                                <input type="text" class="form-control" name="footer_legal_text"
                                    value="{{ isset($footerSettings) ? $footerSettings->footer_legal_text : old('footer_legal_text') }}"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-success">Sauvegarder les paramètres</button>
                        </form>
                    </div>
                </div>

                <!-- Gestion des colonnes -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Colonnes du Footer</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addColumnModal">
                            Ajouter une colonne
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($footerColumns) && $footerColumns->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Titre</th>
                                            <th>Ordre</th>
                                            <th>Nombre de liens</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($footerColumns as $column)
                                            <tr>
                                                <td>{{ $column->column_title }}</td>
                                                <td>{{ $column->column_order }}</td>
                                                <td>{{ $column->allLinks->count() }}</td>
                                                <td>
                                                    <span class="badge {{ $column->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $column->is_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editColumn({{ $column->toJson() }})" data-bs-toggle="modal"
                                                        data-bs-target="#editColumnModal">
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.footer.columns.toggle', $column->id) }}"
                                                        class="btn btn-sm {{ $column->is_active ? 'btn-secondary' : 'btn-success' }}">
                                                        {{ $column->is_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        onclick="manageLinks({{ $column->toJson() }})" data-bs-toggle="modal"
                                                        data-bs-target="#manageLinksModal">
                                                        Gérer les liens
                                                    </button>
                                                    <form action="{{ route('dashboard.accueil.footer.columns.delete', $column->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Supprimer cette colonne et tous ses liens ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Aucune colonne trouvée.</p>
                        @endif
                    </div>
                </div>

                <!-- Gestion des liens -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Liens du Footer</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLinkModal">
                            Ajouter un lien
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($footerColumns) && $footerColumns->count() > 0)
                            @foreach ($footerColumns as $column)
                                @if ($column->allLinks->count() > 0)
                                    <div class="mb-4">
                                        <h6 class="text-primary">{{ $column->column_title }}</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Texte</th>
                                                        <th>URL</th>
                                                        <th>Ordre</th>
                                                        <th>Statut</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($column->allLinks as $link)
                                                        <tr>
                                                            <td>{{ $link->link_text }}</td>
                                                            <td>{{ Str::limit($link->link_url, 30) }}</td>
                                                            <td>{{ $link->link_order }}</td>
                                                            <td>
                                                                <span class="badge {{ $link->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                                    {{ $link->is_active ? 'Actif' : 'Inactif' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-warning"
                                                                    onclick="editLink({{ $link->toJson() }})" data-bs-toggle="modal"
                                                                    data-bs-target="#editLinkModal">
                                                                    Modifier
                                                                </button>
                                                                <a href="{{ route('dashboard.accueil.footer.links.toggle', $link->id) }}"
                                                                    class="btn btn-sm {{ $link->is_active ? 'btn-secondary' : 'btn-success' }}">
                                                                    {{ $link->is_active ? 'Désactiver' : 'Activer' }}
                                                                </a>
                                                                <form action="{{ route('dashboard.accueil.footer.links.delete', $link->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Supprimer ce lien ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-center text-muted">Aucun lien trouvé. Créez d'abord une colonne.</p>
                        @endif
                    </div>
                </div>

                <!-- Gestion des réseaux sociaux -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Réseaux sociaux</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSocialModal">
                            Ajouter un réseau
                        </button>
                    </div>
                    <div class="card-body">
                        @if (isset($footerSocials) && $footerSocials->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Plateforme</th>
                                            <th>URL</th>
                                            <th>Icône</th>
                                            <th>Ordre</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($footerSocials as $social)
                                            <tr>
                                                <td>{{ $social->social_platform }}</td>
                                                <td>{{ Str::limit($social->social_url, 30) }}</td>
                                                <td>
                                                    @if ($social->social_icon)
                                                        <img src="{{ asset($social->social_icon) }}" alt="{{ $social->social_platform }}" class="img-thumbnail" style="width: 30px; height: 30px;">
                                                    @else
                                                        <span class="text-muted">Aucune icône</span>
                                                    @endif
                                                </td>
                                                <td>{{ $social->social_order }}</td>
                                                <td>
                                                    <span class="badge {{ $social->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $social->is_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editSocial({{ $social->toJson() }})" data-bs-toggle="modal"
                                                        data-bs-target="#editSocialModal">
                                                        Modifier
                                                    </button>
                                                    <a href="{{ route('dashboard.accueil.footer.socials.toggle', $social->id) }}"
                                                        class="btn btn-sm {{ $social->is_active ? 'btn-secondary' : 'btn-success' }}">
                                                        {{ $social->is_active ? 'Désactiver' : 'Activer' }}
                                                    </a>
                                                    <form action="{{ route('dashboard.accueil.footer.socials.delete', $social->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Supprimer ce réseau social ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted">Aucun réseau social trouvé.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales existantes -->
    @include('admin.home.modals.slide-modals')
    @include('admin.home.modals.stat-modals')
    @include('admin.home.modals.partner-modals')

    <!-- Nouvelles modales pour le footer -->
    @include('admin.home.modals.footer-modals')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonctions existantes
        function editSlide(slide) {
            document.getElementById('edit_home_slide_number').value = slide.home_slide_number;
            document.getElementById('edit_home_slide_title').value = slide.home_slide_title;
            document.getElementById('edit_home_slide_description').value = slide.home_slide_description;
            document.getElementById('edit_home_slide_order').value = slide.home_slide_order;

            const form = document.getElementById('editSlideForm');
            form.action = "{{ route('dashboard.accueil.slides.update', ':id') }}".replace(':id', slide.id);
        }

        function editStat(stat) {
            document.getElementById('edit_home_stat_number').value = stat.home_stat_number;
            document.getElementById('edit_home_stat_description').value = stat.home_stat_description;
            document.getElementById('edit_home_stat_order').value = stat.home_stat_order;

            const form = document.getElementById('editStatForm');
            form.action = "{{ route('dashboard.accueil.stats.update', ':id') }}".replace(':id', stat.id);
        }

        function editPartnerItem(partnerItem) {
            document.getElementById('edit_home_partner_item_alt').value = partnerItem.home_partner_item_alt || '';
            document.getElementById('edit_home_partner_item_order').value = partnerItem.home_partner_item_order;

            const form = document.getElementById('editPartnerForm');
            form.action = "{{ route('dashboard.accueil.partners.items.update', ':id') }}".replace(':id', partnerItem.id);
        }

        // Nouvelles fonctions pour le footer
        function editColumn(column) {
            document.getElementById('edit_column_title').value = column.column_title;
            document.getElementById('edit_column_order').value = column.column_order;

            const form = document.getElementById('editColumnForm');
            form.action = "{{ route('dashboard.accueil.footer.columns.update', ':id') }}".replace(':id', column.id);
        }

        function editLink(link) {
            document.getElementById('edit_link_text').value = link.link_text;
            document.getElementById('edit_link_url').value = link.link_url;
            document.getElementById('edit_link_order').value = link.link_order;
            document.getElementById('edit_link_column_id').value = link.footer_column_id;

            const form = document.getElementById('editLinkForm');
            form.action = "{{ route('dashboard.accueil.footer.links.update', ':id') }}".replace(':id', link.id);
        }

        function editSocial(social) {
            document.getElementById('edit_social_platform').value = social.social_platform;
            document.getElementById('edit_social_url').value = social.social_url;
            document.getElementById('edit_social_order').value = social.social_order;

            const form = document.getElementById('editSocialForm');
            form.action = "{{ route('dashboard.accueil.footer.socials.update', ':id') }}".replace(':id', social.id);
        }

        function manageLinks(column) {
            document.getElementById('current_column_id').value = column.id;
            document.getElementById('current_column_title').textContent = column.column_title;
            document.getElementById('quick_add_column_id').value = column.id;
        }
    </script>
@endsection