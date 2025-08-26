@extends('layouts.backend.app')

@section('title', 'Gestion des Activités')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion de la page Activités</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Page Content Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Contenu de la page</h6>
            <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#pageContentForm">
                <i class="fas fa-edit"></i> Modifier
            </button>
        </div>
        <div class="card-body">
            <div class="collapse" id="pageContentForm">
                <form action="{{ route('activities.update-page-content') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre de la page</label>
                                <input type="text" name="title" class="form-control"
                                       value="{{ $pageContents['title'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description Meta</label>
                                <input type="text" name="description" class="form-control"
                                       value="{{ $pageContents['description'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre Hero</label>
                                <input type="text" name="hero_title" class="form-control"
                                       value="{{ $pageContents['hero_title'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image Hero</label>
                                <input type="file" name="hero_image" class="form-control-file">
                                @if(isset($pageContents['hero_image']) && $pageContents['hero_image'])
                                    <small class="text-muted">Image actuelle: {{ basename($pageContents['hero_image']) }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre section thèmes</label>
                                <input type="text" name="themes_section_title" class="form-control"
                                       value="{{ $pageContents['themes_section_title'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image section thèmes</label>
                                <input type="file" name="themes_section_image" class="form-control-file">
                                @if(isset($pageContents['themes_section_image']) && $pageContents['themes_section_image'])
                                    <small class="text-muted">Image actuelle: {{ basename($pageContents['themes_section_image']) }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre section services</label>
                                <input type="text" name="services_section_title" class="form-control"
                                       value="{{ $pageContents['services_section_title'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Texte bouton contact</label>
                                <input type="text" name="contact_button_text" class="form-control"
                                       value="{{ $pageContents['contact_button_text'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre section témoignages</label>
                                <input type="text" name="testimonials_section_title" class="form-control"
                                       value="{{ $pageContents['testimonials_section_title'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Themes Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Domaines thématiques</h6>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addThemeModal">
                <i class="fas fa-plus"></i> Ajouter un thème
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
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
                        @forelse($themes as $theme)
                            <tr>
                                <td>{{ $theme->activities_theme_order }}</td>
                                <td>
                                    @if($theme->activities_theme_icon)
                                        <img src="{{ asset($theme->activities_theme_icon) }}"
                                             style="width: 30px; height: 30px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune icône</span>
                                    @endif
                                </td>
                                <td>{{ $theme->activities_theme_title }}</td>
                                <td>{{ Str::limit($theme->activities_theme_description, 50) }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editTheme({{ json_encode($theme) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-theme', $theme->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun thème trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Services</h6>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addServiceModal">
                <i class="fas fa-plus"></i> Ajouter un service
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
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
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->activities_service_order }}</td>
                                <td>
                                    @if($service->activities_service_image)
                                        <img src="{{ asset($service->activities_service_image) }}"
                                             style="width: 50px; height: 30px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $service->activities_service_title }}</td>
                                <td>{{ Str::limit($service->activities_service_description, 50) }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editService({{ json_encode($service) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-service', $service->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun service trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Geographic Coverage Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Couverture géographique</h6>
            <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#geographicForm">
                <i class="fas fa-edit"></i> Modifier
            </button>
        </div>
        <div class="card-body">
            <div class="collapse" id="geographicForm">
                <form action="{{ route('activities.update-geographic-coverage') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" name="activities_coverage_title" class="form-control"
                                       value="{{ $geographicCoverage->activities_geographic_title ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="activities_coverage_description" class="form-control" rows="3">{{ $geographicCoverage->activities_geographic_description ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Code SVG de la carte</label>
                                <textarea name="activities_coverage_map_svg" class="form-control" rows="10">{{ $geographicCoverage->activities_geographic_map_svg ?? '' }}</textarea>
                                <small class="text-muted">Collez ici le code SVG de votre carte</small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Témoignages</h6>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTestimonialModal">
                <i class="fas fa-plus"></i> Ajouter un témoignage
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
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
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    @if($testimonial->activities_testimonial_image)
                                        <img src="{{ asset($testimonial->activities_testimonial_image) }}"
                                             style="width: 50px; height: 30px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $testimonial->activities_testimonial_title }}</td>
                                <td>{{ Str::limit($testimonial->activities_testimonial_description, 50) }}</td>
                                <td>
                                    @if($testimonial->activities_testimonial_link)
                                        <a href="{{ $testimonial->activities_testimonial_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">Aucun lien</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editTestimonial({{ json_encode($testimonial) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('activities.delete-testimonial', $testimonial->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun témoignage trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Theme Modal -->
<div class="modal fade" id="addThemeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un thème</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('activities.store-theme') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="activities_theme_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_theme_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Icône</label>
                        <input type="file" name="activities_theme_icon" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Ordre</label>
                        <input type="number" name="activities_theme_order" class="form-control" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Theme Modal -->
<div class="modal fade" id="editThemeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le thème</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editThemeForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="activities_theme_title" id="edit_theme_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_theme_description" id="edit_theme_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Icône</label>
                        <input type="file" name="activities_theme_icon" class="form-control-file">
                        <small id="current_theme_icon" class="text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Ordre</label>
                        <input type="number" name="activities_theme_order" id="edit_theme_order" class="form-control" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un service</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('activities.store-service') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre *</label>
                                <input type="text" name="activities_service_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ordre</label>
                                <input type="number" name="activities_service_order" class="form-control" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_service_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="activities_service_image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Caractéristiques du service</label>
                        <div id="service-features">
                            <div class="input-group mb-2">
                                <input type="text" name="activities_service_features[]" class="form-control" placeholder="Caractéristique du service">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" onclick="addServiceFeature()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le service</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editServiceForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titre *</label>
                                <input type="text" name="activities_service_title" id="edit_service_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ordre</label>
                                <input type="number" name="activities_service_order" id="edit_service_order" class="form-control" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_service_description" id="edit_service_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="activities_service_image" class="form-control-file">
                        <small id="current_service_image" class="text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Caractéristiques du service</label>
                        <div id="edit-service-features">
                            <!-- Features will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un témoignage</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('activities.store-testimonial') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="activities_testimonial_title" class="form-control" required>
                    </div>
                                        <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_testimonial_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="activities_testimonial_image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input type="url" name="activities_testimonial_link" class="form-control" placeholder="https://exemple.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div class="modal fade" id="editTestimonialModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le témoignage</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editTestimonialForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="activities_testimonial_title" id="edit_testimonial_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="activities_testimonial_description" id="edit_testimonial_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="activities_testimonial_image" class="form-control-file">
                        <small id="current_testimonial_image" class="text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input type="url" name="activities_testimonial_link" id="edit_testimonial_link" class="form-control" placeholder="https://exemple.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Theme Management
function editTheme(theme) {
    document.getElementById('edit_theme_title').value = theme.activities_theme_title || '';
    document.getElementById('edit_theme_description').value = theme.activities_theme_description || '';
    document.getElementById('edit_theme_order').value = theme.activities_theme_order || 0;

    const iconInfo = document.getElementById('current_theme_icon');
    if (theme.activities_theme_icon) {
        iconInfo.textContent = 'Icône actuelle: ' + theme.activities_theme_icon.split('/').pop();
    } else {
        iconInfo.textContent = 'Aucune icône actuelle';
    }

    document.getElementById('editThemeForm').action = '{{ route("activities.update-theme", ":id") }}'.replace(':id', theme.id);
    $('#editThemeModal').modal('show');
}

// Service Management
function editService(service) {
    document.getElementById('edit_service_title').value = service.activities_service_title || '';
    document.getElementById('edit_service_description').value = service.activities_service_description || '';
    document.getElementById('edit_service_order').value = service.activities_service_order || 0;

    const imageInfo = document.getElementById('current_service_image');
    if (service.activities_service_image) {
        imageInfo.textContent = 'Image actuelle: ' + service.activities_service_image.split('/').pop();
    } else {
        imageInfo.textContent = 'Aucune image actuelle';
    }

    // Handle service features
    const featuresContainer = document.getElementById('edit-service-features');
    featuresContainer.innerHTML = '';

    let features = [];
    if (service.activities_service_features) {
        try {
            features = typeof service.activities_service_features === 'string'
                ? JSON.parse(service.activities_service_features)
                : service.activities_service_features;
        } catch (e) {
            features = [];
        }
    }

    if (features.length === 0) {
        features = [''];
    }

    features.forEach((feature, index) => {
        addEditServiceFeature(feature);
    });

    document.getElementById('editServiceForm').action = '{{ route("activities.update-service", ":id") }}'.replace(':id', service.id);
    $('#editServiceModal').modal('show');
}

function addServiceFeature() {
    const container = document.getElementById('service-features');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" name="activities_service_features[]" class="form-control" placeholder="Caractéristique du service">
        <div class="input-group-append">
            <button type="button" class="btn btn-danger" onclick="removeServiceFeature(this)">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
}

function addEditServiceFeature(value = '') {
    const container = document.getElementById('edit-service-features');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" name="activities_service_features[]" class="form-control" placeholder="Caractéristique du service" value="${value}">
        <div class="input-group-append">
            <button type="button" class="btn btn-success" onclick="addEditServiceFeature()">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-danger" onclick="removeServiceFeature(this)">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
}

function removeServiceFeature(button) {
    button.closest('.input-group').remove();
}

// Testimonial Management
function editTestimonial(testimonial) {
    document.getElementById('edit_testimonial_title').value = testimonial.activities_testimonial_title || '';
    document.getElementById('edit_testimonial_description').value = testimonial.activities_testimonial_description || '';
    document.getElementById('edit_testimonial_link').value = testimonial.activities_testimonial_link || '';

    const imageInfo = document.getElementById('current_testimonial_image');
    if (testimonial.activities_testimonial_image) {
        imageInfo.textContent = 'Image actuelle: ' + testimonial.activities_testimonial_image.split('/').pop();
    } else {
        imageInfo.textContent = 'Aucune image actuelle';
    }

    document.getElementById('editTestimonialForm').action = '{{ route("activities.update-testimonial", ":id") }}'.replace(':id', testimonial.id);
    $('#editTestimonialModal').modal('show');
}

// Auto-dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        });
    }, 5000);
});
</script>
@endsection
