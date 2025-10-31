@extends('layouts.backend.app')

@section('title', 'Gestion de l\'Équipe - Expert')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion de l'Équipe Expert</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Team Leader Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Leader d'Équipe</h6>
        </div>
        <div class="card-body">
            <div class="collapse {{ !$teamLeader ? 'show' : '' }}" id="teamLeaderForm">
                <form action="{{ route('dashboard.expert.update-leader') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom *</label>
                                <input type="text" name="name" class="form-control" value="{{ $teamLeader->name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Poste *</label>
                                <input type="text" name="position" class="form-control" value="{{ $teamLeader->position ?? '' }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description *</label>
                        <textarea name="description" class="form-control" rows="6" required>{{ $teamLeader->description ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
                        @if(isset($teamLeader->image) && $teamLeader->image)
                            <small class="text-muted">Image actuelle: {{ basename($teamLeader->image) }}</small>
                            <div class="mt-2">
                                <img src="{{ asset($teamLeader->image) }}" alt="Current leader image" style="max-height: 150px; object-fit: cover;" class="rounded">
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer le Leader</button>
                    @if($teamLeader)
                        <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#teamLeaderForm">Annuler</button>
                    @endif
                </form>
            </div>

            @if($teamLeader)
                <div class="row">
                    <div class="col-md-3">
                        @if($teamLeader->image)
                            <img src="{{ asset($teamLeader->image) }}" alt="{{ $teamLeader->name }}" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">Aucune image</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $teamLeader->name }}</h4>
                        <h5 class="text-primary">{{ $teamLeader->position }}</h5>
                        <p>{{ Str::limit($teamLeader->description, 200) }}</p>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#teamLeaderForm">
                                <i class="fas fa-edit"></i> Modifier le Leader
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <p>Aucun leader d'équipe défini.</p>
                    <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#teamLeaderForm">
                        <i class="fas fa-plus"></i> Ajouter le Leader
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Team Members Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Membres de l'Équipe</h6>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTeamMemberModal">
                <i class="fas fa-plus"></i> Ajouter un Membre
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Poste</th>
                            <th>Lien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teamMembers as $member)
                            <tr>
                                <td>
                                    @if($member->image)
                                        <img src="{{ asset($member->image) }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>
                                    @if($member->link)
                                        <a href="{{ $member->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">Aucun lien</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editTeamMemberModal{{ $member->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('dashboard.expert.delete-member', $member->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal d'édition pour chaque membre -->
                            <div class="modal fade" id="editTeamMemberModal{{ $member->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier le Membre</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('dashboard.expert.update-member', $member->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nom *</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Poste *</label>
                                                    <input type="text" name="position" class="form-control" value="{{ $member->position }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Lien</label>
                                                    <input type="url" name="link" class="form-control" value="{{ $member->link }}" placeholder="https://exemple.com">
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control-file">
                                                    @if($member->image)
                                                        <small class="text-muted">Image actuelle: {{ basename($member->image) }}</small>
                                                        <div class="mt-2">
                                                            <img src="{{ asset($member->image) }}" style="max-height: 100px; object-fit: cover;" class="rounded">
                                                        </div>
                                                    @endif
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
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun membre d'équipe trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'ajout de membre -->
<div class="modal fade" id="addTeamMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Membre</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.expert.store-member') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Poste *</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Lien</label>
                        <input type="url" name="link" class="form-control" placeholder="https://exemple.com">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
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
@endsection

@section('scripts')
<script>
// Auto-dismiss alerts
setTimeout(function() {
    $('.alert').alert('close');
}, 5000);
</script>
@endsection