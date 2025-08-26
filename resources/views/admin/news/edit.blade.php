@extends('layouts.backend.app')

@section('title', 'Modifier un Article')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier l'article</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Modification de l'article</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('news.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="editArticleForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="news_title">Titre *</label>
                            <input type="text" name="news_title" id="news_title" class="form-control" required
                                   value="{{ old('news_title', $article->news_title) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="news_order">Ordre d'affichage</label>
                            <input type="number" name="news_order" id="news_order" class="form-control"
                                   value="{{ old('news_order', $article->news_order) }}" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="news_description">Description</label>
                    <textarea name="news_description" id="news_description" class="form-control" rows="4">{{ old('news_description', $article->news_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="news_link">Lien</label>
                    <input type="url" name="news_link" id="news_link" class="form-control"
                           value="{{ old('news_link', $article->news_link) }}" placeholder="https://exemple.com">
                </div>

                <div class="form-group">
                    <label for="news_type">Type *</label>
                    <select name="news_type" id="news_type" class="form-control" required>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('news_type', $article->news_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="news_image">Image</label>
                    <input type="file" name="news_image" id="news_image" class="form-control-file">
                    <small class="text-muted">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</small>

                    @if($article->news_image)
                        <div class="mt-2">
                            <p class="text-muted">Image actuelle:</p>
                            <img src="{{ asset($article->news_image) }}" alt="Image actuelle"
                                 style="max-width: 200px; height: auto; border: 1px solid #ddd; padding: 5px;">
                            <p class="text-muted small">{{ basename($article->news_image) }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="news_is_active" id="news_is_active" class="form-check-input" value="1"
                               {{ old('news_is_active', $article->news_is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="news_is_active">Article actif</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        <i class="fas fa-save"></i> Mettre à jour
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
    console.log('Page d\'édition chargée');
    console.log('ID de l\'article:', '{{ $article->id }}');
    console.log('Type actuel:', '{{ $article->news_type }}');

    const form = document.getElementById('editArticleForm');
    const submitButton = document.getElementById('submitButton');

    if (form) {
        console.log('Action du formulaire:', form.action);
        console.log('Méthode du formulaire:', form.method);

        form.addEventListener('submit', function(e) {
            console.log('Formulaire en cours de soumission...');

            // Afficher les données du formulaire
            const formData = new FormData(form);
            console.log('Données du formulaire:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';
        });
    }

    // Vérifier les valeurs des champs
    console.log('Titre:', document.getElementById('news_title').value);
    console.log('Ordre:', document.getElementById('news_order').value);
    console.log('Type sélectionné:', document.getElementById('news_type').value);
    console.log('Statut actif:', document.getElementById('news_is_active').checked);
});
</script>
@endsection
