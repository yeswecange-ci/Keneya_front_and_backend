@extends('layouts.backend.app')

@section('title', 'Ajouter un Article')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajouter un article</h1>
        <a href="{{ route('dashboard.actualities') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nouvel article</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="createArticleForm">
                @csrf

                <input type="hidden" name="news_type" id="news_type" value="{{ request('type', 'blog') }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="news_title">Titre *</label>
                            <input type="text" name="news_title" id="news_title" class="form-control" required
                                   value="{{ old('news_title') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="news_order">Ordre d'affichage</label>
                            <input type="number" name="news_order" id="news_order" class="form-control"
                                   value="{{ old('news_order', 0) }}" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="news_description">Description</label>
                    <textarea name="news_description" id="news_description" class="form-control" rows="4">{{ old('news_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="news_link">Lien</label>
                    <input type="url" name="news_link" id="news_link" class="form-control"
                           value="{{ old('news_link') }}" placeholder="https://exemple.com">
                </div>

                <div class="form-group">
                    <label for="news_image">Image</label>
                    <input type="file" name="news_image" id="news_image" class="form-control-file">
                    <small class="text-muted">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</small>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="news_is_active" id="news_is_active" class="form-check-input" value="1"
                               {{ old('news_is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="news_is_active">Article actif</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        <i class="fas fa-save"></i> Créer l'article
                    </button>
                    <a href="{{ route('dashboard.actualities') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page de création chargée');

    const form = document.getElementById('createArticleForm');
    const submitButton = document.getElementById('submitButton');
    const typeInput = document.getElementById('news_type');

    console.log('Type d\'article:', typeInput ? typeInput.value : 'non trouvé');

    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Formulaire en cours de soumission...');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Création...';
        });
    }

    // Afficher le type d'article dans le titre
    const type = "{{ request('type', 'blog') }}";
    const typeLabels = {
        'blog': 'Article de blog',
        'event': 'Événement',
        'publication': 'Publication',
        'press_release': 'Communiqué de presse'
    };

    if (typeLabels[type]) {
        document.querySelector('h1').textContent = 'Ajouter un ' + typeLabels[type];
        document.querySelector('.card-header h6').textContent = 'Nouveau ' + typeLabels[type];
    }
});
</script>
@endsection
