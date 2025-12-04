@extends('layouts.admin')

@section('title', 'Modifier un Article')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Modifier l'article</h1>
        <a href="{{ route('dashboard.actualities') }}" class="btn-secondary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour
        </a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Modification de l'article</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('news.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="editArticleForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label class="form-label">Titre *</label>
                        <input type="text" name="news_title" class="form-input" required
                               value="{{ old('news_title', $article->news_title) }}" placeholder="Titre de l'article">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slug (URL)</label>
                        <input type="text" name="news_slug" class="form-input"
                               value="{{ old('news_slug', $article->news_slug) }}" placeholder="Généré automatiquement si vide">
                        <p class="text-xs text-muted mt-1">Laisser vide pour générer automatiquement depuis le titre</p>
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Description courte</label>
                    <textarea name="news_description" class="form-textarea" rows="3"
                              placeholder="Description courte affichée dans la liste">{{ old('news_description', $article->news_description) }}</textarea>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Contenu complet</label>
                    <textarea name="news_full_content" class="form-textarea" rows="8"
                              placeholder="Contenu détaillé de l'article (affiché sur la page de détails)">{{ old('news_full_content', $article->news_full_content) }}</textarea>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Ordre d'affichage</label>
                    <input type="number" name="news_order" class="form-input"
                           value="{{ old('news_order', $article->news_order) }}" min="0">
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Lien</label>
                    <input type="url" name="news_link" class="form-input"
                           value="{{ old('news_link', $article->news_link) }}" placeholder="https://exemple.com">
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Type *</label>
                    <select name="news_type" class="form-select" required>
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('news_type', $article->news_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="news_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</p>

                    @if($article->news_image)
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 mb-2">Image actuelle:</p>
                            <img src="{{ asset($article->news_image) }}" alt="Image actuelle"
                                 class="max-w-xs h-auto border border-gray-300 rounded shadow-sm">
                            <p class="text-xs text-muted mt-2">{{ basename($article->news_image) }}</p>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="news_is_active" value="1" class="form-checkbox"
                               {{ old('news_is_active', $article->news_is_active) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Article actif</span>
                    </label>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" class="btn-primary" id="submitButton">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Mettre à jour
                    </button>
                    <a href="{{ route('dashboard.actualities') }}" class="btn-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Annuler
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
    const form = document.getElementById('editArticleForm');
    const submitButton = document.getElementById('submitButton');

    if (form) {
        form.addEventListener('submit', function(e) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mise à jour...';
        });
    }
});
</script>
@endsection
