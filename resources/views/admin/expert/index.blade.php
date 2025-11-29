@extends('layouts.admin')

@section('title', 'Gestion de l\'Équipe - Expert')

@section('content')
<div class="space-y-6" x-data="{
    leaderFormOpen: {{ $teamLeader ? 'false' : 'true' }},
    addMemberModal: false,
    editMemberModal: false,
    editingMemberId: null
}">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Gestion de l'Équipe Expert</h1>
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

    <!-- Team Leader Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Leader d'Équipe</h3>
        </div>
        <div class="card-body">
            <!-- Leader Form -->
            <div x-show="leaderFormOpen" x-collapse>
                <form action="{{ route('dashboard.expert.update-leader') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">Nom *</label>
                            <input type="text" name="name" class="form-input" value="{{ $teamLeader->name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Poste *</label>
                            <input type="text" name="position" class="form-input" value="{{ $teamLeader->position ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description *</label>
                        <textarea name="description" class="form-textarea" rows="6" required>{{ $teamLeader->description ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-input" accept="image/*">
                        @if(isset($teamLeader->image) && $teamLeader->image)
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-muted mb-2">Image actuelle: {{ basename($teamLeader->image) }}</p>
                                <img src="{{ asset($teamLeader->image) }}" alt="Current leader image"
                                     class="max-h-40 object-cover rounded shadow-sm">
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-3">
                        <button type="submit" class="btn-primary">Enregistrer le Leader</button>
                        @if($teamLeader)
                            <button type="button" class="btn-secondary" @click="leaderFormOpen = false">Annuler</button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Leader Display -->
            @if($teamLeader)
                <div x-show="!leaderFormOpen" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-1">
                        @if($teamLeader->image)
                            <img src="{{ asset($teamLeader->image) }}" alt="{{ $teamLeader->name }}"
                                 class="w-full h-48 object-cover rounded shadow-sm">
                        @else
                            <div class="w-full h-48 bg-gray-100 rounded flex items-center justify-center">
                                <span class="text-muted">Aucune image</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-3">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $teamLeader->name }}</h4>
                        <h5 class="text-lg text-primary mb-3">{{ $teamLeader->position }}</h5>
                        <p class="text-gray-600 mb-4">{{ Str::limit($teamLeader->description, 200) }}</p>
                        <button class="btn-primary btn-sm" @click="leaderFormOpen = true">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier le Leader
                        </button>
                    </div>
                </div>
            @else
                <div x-show="!leaderFormOpen" class="bg-yellow-50 border border-yellow-200 rounded p-4">
                    <p class="text-yellow-800 mb-3">Aucun leader d'équipe défini.</p>
                    <button class="btn-primary btn-sm" @click="leaderFormOpen = true">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter le Leader
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Team Members Section -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="card-title">Membres de l'Équipe</h3>
            <button @click="addMemberModal = true; editMemberModal = false" class="btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un Membre
            </button>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="data-table">
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
                                        <img src="{{ asset($member->image) }}"
                                             class="w-12 h-12 object-cover rounded"
                                             alt="{{ $member->name }}">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td class="font-medium">{{ $member->name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>
                                    @if($member->link)
                                        <a href="{{ $member->link }}" target="_blank" class="text-primary hover:text-primary-dark">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-muted">Aucun lien</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <button @click="editMemberModal = true; editingMemberId = {{ $member->id }}; addMemberModal = false"
                                                class="btn-warning btn-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <form method="POST" action="{{ route('dashboard.expert.delete-member', $member->id) }}"
                                              style="display: inline;"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
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
                                <td colspan="5" class="text-center text-muted">Aucun membre d'équipe trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div x-show="addMemberModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="addMemberModal = false"></div>

            <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Ajouter un Membre</h3>
                    <button @click="addMemberModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('dashboard.expert.store-member') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Poste *</label>
                        <input type="text" name="position" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lien</label>
                        <input type="url" name="link" class="form-input" placeholder="https://exemple.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-input" accept="image/*">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" class="btn-secondary" @click="addMemberModal = false">Annuler</button>
                        <button type="submit" class="btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Member Modals -->
    @foreach($teamMembers as $member)
        <div x-show="editMemberModal && editingMemberId === {{ $member->id }}"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="editMemberModal = false"></div>

                <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Modifier le Membre</h3>
                        <button @click="editMemberModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('dashboard.expert.update-member', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Nom *</label>
                            <input type="text" name="name" class="form-input" value="{{ $member->name }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Poste *</label>
                            <input type="text" name="position" class="form-input" value="{{ $member->position }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Lien</label>
                            <input type="url" name="link" class="form-input" value="{{ $member->link }}" placeholder="https://exemple.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-input" accept="image/*">
                            @if($member->image)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-muted mb-2">Image actuelle: {{ basename($member->image) }}</p>
                                    <img src="{{ asset($member->image) }}"
                                         class="max-h-24 object-cover rounded shadow-sm"
                                         alt="{{ $member->name }}">
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" class="btn-secondary" @click="editMemberModal = false">Annuler</button>
                            <button type="submit" class="btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
