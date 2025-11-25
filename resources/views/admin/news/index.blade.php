@extends('layouts.admin')

@section('title', 'Gestion des Actualités')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Gestion des actualités</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
            <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Blog Articles Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Articles de blog</h3>
            <a href="{{ route('news.create') }}?type=blog" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un article
            </a>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
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
                                             alt="Image"
                                             class="w-16 h-10 object-cover rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $article->news_title }}</td>
                                <td class="text-muted">{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('news.edit', $article->id) }}" class="btn-warning btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm"
                                                    title="{{ $article->news_is_active ? 'Désactiver' : 'Activer' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($article->news_is_active)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    @endif
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun article de blog trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Event Articles Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Événements</h3>
            <a href="{{ route('news.create') }}?type=event" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un événement
            </a>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
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
                                             alt="Image"
                                             class="w-16 h-10 object-cover rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $article->news_title }}</td>
                                <td class="text-muted">{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('news.edit', $article->id) }}" class="btn-warning btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm"
                                                    title="{{ $article->news_is_active ? 'Désactiver' : 'Activer' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($article->news_is_active)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    @endif
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun événement trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Publication Articles Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Publications</h3>
            <a href="{{ route('news.create') }}?type=publication" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter une publication
            </a>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
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
                                             alt="Image"
                                             class="w-16 h-10 object-cover rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $article->news_title }}</td>
                                <td class="text-muted">{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('news.edit', $article->id) }}" class="btn-warning btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm"
                                                    title="{{ $article->news_is_active ? 'Désactiver' : 'Activer' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($article->news_is_active)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    @endif
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')">
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune publication trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Press Release Articles Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Communiqués de presse</h3>
            <a href="{{ route('news.create') }}?type=press_release" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un communiqué
            </a>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
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
                                             alt="Image"
                                             class="w-16 h-10 object-cover rounded">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $article->news_title }}</td>
                                <td class="text-muted">{{ Str::limit($article->news_description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $article->news_is_active ? 'success' : 'secondary' }}">
                                        {{ $article->news_is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('news.edit', $article->id) }}" class="btn-warning btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('news.toggle-status', $article->id) }}"
                                              style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-{{ $article->news_is_active ? 'secondary' : 'success' }} btn-sm"
                                                    title="{{ $article->news_is_active ? 'Désactiver' : 'Activer' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($article->news_is_active)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    @endif
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('news.destroy', $article->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce communiqué ?')">
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun communiqué de presse trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
