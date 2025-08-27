@extends('layouts.backend.app')

@section('title', 'Gestion des Actualités')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des actualités</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Blog Articles Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Articles de blog</h6>
            <a href="{{ route('news.create') }}?type=blog" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Ajouter un article
            </a>
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
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogArticles as $article)
                            <tr>
                                <td>{{ $article->news_order }}</td>
                                <td>
                                    @if($article->news_image)
                                        <img src="{{ asset($article->news_image) }}"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $article->news_title }}</td>
                                <td>{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm">
                                            <i class="fas fa-{{ $article->news_is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun article de blog trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Event Articles Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Événements</h6>
            <a href="{{ route('news.create') }}?type=event" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Ajouter un événement
            </a>
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
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eventArticles as $article)
                            <tr>
                                <td>{{ $article->news_order }}</td>
                                <td>
                                    @if($article->news_image)
                                        <img src="{{ asset($article->news_image) }}"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $article->news_title }}</td>
                                <td>{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm">
                                            <i class="fas fa-{{ $article->news_is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun événement trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Publication Articles Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Publications</h6>
            <a href="{{ route('news.create') }}?type=publication" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Ajouter une publication
            </a>
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
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($publicationArticles as $article)
                            <tr>
                                <td>{{ $article->news_order }}</td>
                                <td>
                                    @if($article->news_image)
                                        <img src="{{ asset($article->news_image) }}"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $article->news_title }}</td>
                                <td>{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm">
                                            <i class="fas fa-{{ $article->news_is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune publication trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Press Release Articles Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Communiqués de presse</h6>
            <a href="{{ route('news.create') }}?type=press_release" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Ajouter un communiqué
            </a>
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
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pressReleaseArticles as $article)
                            <tr>
                                <td>{{ $article->news_order }}</td>
                                <td>
                                    @if($article->news_image)
                                        <img src="{{ asset($article->news_image) }}"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $article->news_title }}</td>
                                <td>{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                          style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm">
                                            <i class="fas fa-{{ $article->news_is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun communiqué de presse trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
