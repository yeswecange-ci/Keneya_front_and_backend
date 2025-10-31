@extends('layouts.backend.app')

@section('title', 'Gestion des Contacts')

@section('content')
<div class="container-fluid">
    <!-- Header avec gradient subtil -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h1 class="h3 mb-1 text-gray-900 font-weight-bold">Gestion des Contacts</h1>
            <p class="text-muted mb-0 small">Gérez vos candidatures et demandes de devis</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Candidatures Section -->
    <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header py-3 border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle p-2 mr-3 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-briefcase" style="color: #667eea;"></i>
                </div>
                <div>
                    <h6 class="m-0 font-weight-bold text-white">
                        Candidatures Spontanées
                    </h6>
                    <small class="text-white" style="opacity: 0.9;">{{ $applications->count() }} candidature(s) reçue(s)</small>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f8f9fc;">
                        <tr>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted px-4 py-3">Candidat</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Contact</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Poste</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Disponibilité</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Date</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr class="{{ is_null($application->read_at) ? 'bg-light' : '' }}" style="border-left: 3px solid {{ is_null($application->read_at) ? '#667eea' : 'transparent' }};">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 35px; height: 35px; font-size: 14px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            {{ strtoupper(substr($application->first_name, 0, 1)) }}{{ strtoupper(substr($application->last_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="text-gray-900">{{ $application->first_name }} {{ $application->last_name }}</strong>
                                            @if(is_null($application->read_at))
                                                <span class="badge badge-pill ml-2" style="background-color: #667eea; color: white; font-size: 10px;">Nouveau</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="small">
                                        <div class="text-gray-900"><i class="fas fa-envelope text-muted mr-1" style="font-size: 11px;"></i> {{ $application->email }}</div>
                                        <div class="text-muted"><i class="fas fa-phone text-muted mr-1" style="font-size: 11px;"></i> {{ $application->phone }}</div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-pill px-3 py-2" style="background-color: #e3f2fd; color: #1976d2; font-weight: 500;">{{ $application->desired_position }}</span>
                                </td>
                                <td class="py-3">
                                    @if($application->availability_date)
                                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($application->availability_date)->format('d/m/Y') }}</span>
                                    @else
                                        <span class="text-muted small">Non spécifiée</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <span class="text-muted small">{{ $application->created_at->format('d/m/Y H:i') }}</span>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm view-application-btn" data-id="{{ $application->id }}" title="Voir les détails" style="background-color: #e3f2fd; color: #1976d2; border: none;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('dashboard.contact.download-cv', $application->id) }}" class="btn btn-sm" title="Télécharger CV" style="background-color: #e8f5e9; color: #388e3c; border: none;">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form method="POST" action="{{ route('dashboard.contact.destroy', $application->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" title="Supprimer" style="background-color: #ffebee; color: #c62828; border: none;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-inbox text-muted mb-3" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="text-muted mb-0">Aucune candidature pour le moment</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Demandes de Devis Section -->
    <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header py-3 border-0" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle p-2 mr-3 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-file-invoice" style="color: #f093fb;"></i>
                </div>
                <div>
                    <h6 class="m-0 font-weight-bold text-white">
                        Demandes de Devis
                    </h6>
                    <small class="text-white" style="opacity: 0.9;">{{ $quotes->count() }} demande(s) reçue(s)</small>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f8f9fc;">
                        <tr>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted px-4 py-3">Client</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Contact</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Message</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3">Date</th>
                            <th class="border-0 text-uppercase small font-weight-bold text-muted py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr class="{{ is_null($quote->read_at) ? 'bg-light' : '' }}" style="border-left: 3px solid {{ is_null($quote->read_at) ? '#f093fb' : 'transparent' }};">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-3" style="width: 35px; height: 35px; font-size: 14px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                            {{ strtoupper(substr($quote->first_name, 0, 1)) }}{{ strtoupper(substr($quote->last_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="text-gray-900">{{ $quote->first_name }} {{ $quote->last_name }}</strong>
                                            @if(is_null($quote->read_at))
                                                <span class="badge badge-pill ml-2" style="background-color: #f093fb; color: white; font-size: 10px;">Nouveau</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="small">
                                        <div class="text-gray-900"><i class="fas fa-envelope text-muted mr-1" style="font-size: 11px;"></i> {{ $quote->email }}</div>
                                        <div class="text-muted"><i class="fas fa-phone text-muted mr-1" style="font-size: 11px;"></i> {{ $quote->phone }}</div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="text-gray-700">
                                        {{ Str::limit($quote->message, 50) }}
                                        @if(strlen($quote->message) > 50)
                                            <button class="btn btn-link btn-sm p-0 view-quote-btn" data-id="{{ $quote->id }}" style="color: #f093fb; text-decoration: none;">Voir plus <i class="fas fa-arrow-right ml-1" style="font-size: 10px;"></i></button>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted small">{{ $quote->created_at->format('d/m/Y H:i') }}</span>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm view-quote-btn" data-id="{{ $quote->id }}" title="Voir les détails" style="background-color: #e3f2fd; color: #1976d2; border: none;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form method="POST" action="{{ route('dashboard.contact.destroy', $quote->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" title="Supprimer" style="background-color: #ffebee; color: #c62828; border: none;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-inbox text-muted mb-3" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="text-muted mb-0">Aucune demande de devis pour le moment</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir les détails d'une candidature -->
<div class="modal fade" id="applicationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white font-weight-bold">Détails de la Candidature</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="applicationDetails">
                <!-- Les détails seront chargés ici via AJAX -->
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir les détails d'un devis -->
<div class="modal fade" id="quoteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white font-weight-bold">Détails de la Demande de Devis</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="quoteDetails">
                <!-- Les détails seront chargés ici via AJAX -->
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Debug function
function debug(message, data = null) {
    console.log('DEBUG:', message, data || '');
}

// Vérifier que le DOM est chargé et que jQuery est disponible
$(document).ready(function() {
    debug('Document ready');
    debug('jQuery version:', $().jquery);
    debug('Boutons application trouvés:', $('.view-application-btn').length);
    debug('Boutons quote trouvés:', $('.view-quote-btn').length);
    
    // Vérifier que Bootstrap est chargé
    if (typeof $.fn.modal === 'function') {
        debug('Bootstrap modal est disponible');
    } else {
        debug('ERREUR: Bootstrap modal non disponible');
    }
});

// Gestion des candidatures - Version SIMPLIFIÉE pour debug
$(document).on('click', '.view-application-btn', function(e) {
    e.preventDefault();
    debug('Bouton application cliqué');
    
    const applicationId = $(this).data('id');
    debug('ID application:', applicationId);
    
    // Test simple d'abord - juste ouvrir le modal
    $('#applicationDetails').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
            <p>Chargement des détails...</p>
        </div>
    `);
    
    $('#applicationModal').modal('show');
    debug('Modal application ouvert');
    
    // Ensuite faire l'AJAX
    const url = '{{ route("dashboard.contact.show-application", ":id") }}'.replace(':id', applicationId);
    const markReadUrl = '{{ route("dashboard.contact.mark-read", ":id") }}'.replace(':id', applicationId);
    
    debug('URL AJAX:', url);
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            debug('Réponse AJAX reçue:', response);
            
            $('#applicationDetails').html(`
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Prénom</small>
                            <p class="mb-0 text-gray-900 font-weight-bold">${response.first_name}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Nom</small>
                            <p class="mb-0 text-gray-900 font-weight-bold">${response.last_name}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Email</small>
                            <p class="mb-0 text-gray-900">${response.email}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Téléphone</small>
                            <p class="mb-0 text-gray-900">${response.phone}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Poste souhaité</small>
                            <p class="mb-0"><span class="badge badge-pill px-3 py-2" style="background-color: #e3f2fd; color: #1976d2; font-weight: 500;">${response.desired_position}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Date de disponibilité</small>
                            <p class="mb-0 text-gray-900">${response.availability_date || 'Non spécifiée'}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="p-3 rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <a href="${'{{ route("dashboard.contact.download-cv", ":id") }}'.replace(':id', response.id)}" class="btn btn-white btn-block shadow-sm">
                                <i class="fas fa-download mr-2"></i> Télécharger le CV
                            </a>
                        </div>
                        <p class="text-muted small mt-3 mb-0"><i class="far fa-clock mr-1"></i> Soumis le ${response.created_at}</p>
                    </div>
                </div>
            `);
            
            // Marquer comme lu
            $.post(markReadUrl).done(function() {
                debug('Marqué comme lu');
            });
        },
        error: function(xhr, status, error) {
            debug('Erreur AJAX:', error);
            $('#applicationDetails').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Erreur lors du chargement des détails: ${error}
                </div>
            `);
        }
    });
});

// Gestion des demandes de devis - Version SIMPLIFIÉE pour debug
$(document).on('click', '.view-quote-btn', function(e) {
    e.preventDefault();
    debug('Bouton quote cliqué');
    
    const quoteId = $(this).data('id');
    debug('ID quote:', quoteId);
    
    // Test simple d'abord - juste ouvrir le modal
    $('#quoteDetails').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
            <p>Chargement des détails...</p>
        </div>
    `);
    
    $('#quoteModal').modal('show');
    debug('Modal quote ouvert');
    
    // Ensuite faire l'AJAX
    const url = '{{ route("dashboard.contact.show-quote", ":id") }}'.replace(':id', quoteId);
    const markReadUrl = '{{ route("dashboard.contact.mark-read", ":id") }}'.replace(':id', quoteId);
    
    debug('URL AJAX:', url);
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            debug('Réponse AJAX reçue:', response);
            
            $('#quoteDetails').html(`
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Prénom</small>
                            <p class="mb-0 text-gray-900 font-weight-bold">${response.first_name}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Nom</small>
                            <p class="mb-0 text-gray-900 font-weight-bold">${response.last_name}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Email</small>
                            <p class="mb-0 text-gray-900">${response.email}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-1" style="font-size: 11px; font-weight: 600;">Téléphone</small>
                            <p class="mb-0 text-gray-900">${response.phone}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 p-3 bg-light rounded">
                            <small class="text-muted text-uppercase d-block mb-2" style="font-size: 11px; font-weight: 600;">Message</small>
                            <div class="p-3 bg-white border rounded">
                                ${response.message}
                            </div>
                        </div>
                        <p class="text-muted small mb-0"><i class="far fa-clock mr-1"></i> Soumis le ${response.created_at}</p>
                    </div>
                </div>
            `);
            
            // Marquer comme lu
            $.post(markReadUrl).done(function() {
                debug('Marqué comme lu');
            });
        },
        error: function(xhr, status, error) {
            debug('Erreur AJAX:', error);
            $('#quoteDetails').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Erreur lors du chargement des détails: ${error}
                </div>
            `);
        }
    });
});

// Auto-dismiss alerts
setTimeout(function() {
    $('.alert').alert('close');
}, 5000);
</script>
@endsection