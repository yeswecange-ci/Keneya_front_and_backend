@extends('layouts.admin')

@section('title', 'Ajouter un Article')

@section('content')
<div class="space-y-6" x-data="{
    articleType: '{{ request('type', 'blog') }}',
    typeLabels: {
        'blog': 'Article de blog',
        'event': 'Événement',
        'publication': 'Publication',
        'press_release': 'Communiqué de presse'
    },
    getTitle() {
        return 'Ajouter un ' + (this.typeLabels[this.articleType] || 'Article');
    }
}">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900" x-text="getTitle()">Ajouter un article</h1>
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
            <h3 class="card-title" x-text="'Nouveau ' + (typeLabels[articleType] || 'Article')">Nouvel article</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="createArticleForm">
                @csrf

                <input type="hidden" name="news_type" x-model="articleType">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label class="form-label">Titre *</label>
                        <input type="text" name="news_title" class="form-input" required
                               value="{{ old('news_title') }}" placeholder="Titre de l'article">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" name="news_order" class="form-input"
                               value="{{ old('news_order', 0) }}" min="0">
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Description</label>
                    <textarea name="news_description" class="form-textarea" rows="4"
                              placeholder="Description de l'article">{{ old('news_description') }}</textarea>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Lien</label>
                    <input type="url" name="news_link" class="form-input"
                           value="{{ old('news_link') }}" placeholder="https://exemple.com">
                </div>

                <div class="form-group mb-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="news_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Formats acceptés: jpeg, png, jpg, gif (max: 2MB)</p>
                </div>

                <div class="form-group mb-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="news_is_active" value="1" class="form-checkbox"
                               {{ old('news_is_active', true) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Article actif</span>
                    </label>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" class="btn-primary" id="submitButton">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Créer l'article
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
    const form = document.getElementById('createArticleForm');
    const submitButton = document.getElementById('submitButton');

    if (form) {
        form.addEventListener('submit', function(e) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Création...';
        });
    }
});
</script>
@endsection
