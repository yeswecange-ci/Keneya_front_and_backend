@extends('layouts.admin')

@section('title', 'Gestion de la page À Propos')
@section('page-title', 'Gestion de la page À Propos')

@section('content')
<div class="space-y-6"
     x-data="{ accordionModal: false, teamModal: false, editMode: false, editId: null }"
     @open-accordion-modal.window="accordionModal = true"
     @open-team-modal.window="teamModal = true">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion de la page À Propos</h1>
        <p class="page-description">Gérez tous les contenus de votre page à propos</p>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Section Principale -->
    <div class="dashboard-card">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Section Principale</h2>

        <form action="{{ route('dashboard.about.main-section.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Titre principal</label>
                <input type="text" class="form-input" name="about_title"
                       value="{{ $mainSection->about_title ?? '' }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Description 1 *</label>
                    <textarea class="form-textarea" name="about_description_1" rows="4" required>{{ $mainSection->about_description_1 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description 2</label>
                    <textarea class="form-textarea" name="about_description_2" rows="4">{{ $mainSection->about_description_2 ?? '' }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Description 3</label>
                    <textarea class="form-textarea" name="about_description_3" rows="4">{{ $mainSection->about_description_3 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description 4</label>
                    <textarea class="form-textarea" name="about_description_4" rows="4">{{ $mainSection->about_description_4 ?? '' }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Texte du bouton *</label>
                    <input type="text" class="form-input" name="about_button_text"
                           value="{{ $mainSection->about_button_text ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Lien du bouton *</label>
                    <input type="text" class="form-input" name="about_button_link"
                           value="{{ $mainSection->about_button_link ?? '' }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Image</label>
                <input type="file" class="form-input" name="about_image" accept="image/*">
                @if($mainSection && $mainSection->about_image_path)
                    <div class="mt-3">
                        <img src="{{ Storage::url($mainSection->about_image_path) }}" alt="Image actuelle" class="h-32 w-auto rounded border border-gray-200">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-success">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Mettre à jour la section
            </button>
        </form>
    </div>

    <!-- Éléments d'Accordéon -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Éléments d'Accordéon</h2>
            <button type="button" class="btn-primary" @click="accordionModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un élément
            </button>
        </div>

        @if($accordionItems && $accordionItems->count() > 0)
            <div class="space-y-3">
                @foreach($accordionItems as $item)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $item->about_accordion_title }}</h3>
                            <p class="text-sm text-muted">{{ Str::limit(strip_tags($item->about_accordion_content), 150) }}</p>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button type="button" class="btn-secondary text-xs py-1 px-2"
                                onclick="editAccordionItem({{ $item->id }})">
                                Modifier
                            </button>
                            <form action="{{ route('dashboard.about.accordion.delete', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger text-xs py-1 px-2"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="empty-state-title">Aucun élément d'accordéon</h3>
                <p class="empty-state-description">Ajoutez votre premier élément</p>
            </div>
        @endif
    </div>

    <!-- Section Transition -->
    <div class="dashboard-card">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Section Transition</h2>

        <form action="{{ route('dashboard.about.transition-section.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Titre de la section *</label>
                <input type="text" class="form-input" name="about_transition_title"
                       value="{{ $transitionSection->about_transition_title ?? '' }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label">Description 1 *</label>
                    <textarea class="form-textarea" name="about_transition_description_1" rows="4" required>{{ $transitionSection->about_transition_description_1 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description 2</label>
                    <textarea class="form-textarea" name="about_transition_description_2" rows="4">{{ $transitionSection->about_transition_description_2 ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Éléments de liste</label>
                <div class="space-y-2" id="list-items">
                    @if($transitionSection && $transitionSection->aboutTransitionListItems && $transitionSection->aboutTransitionListItems->count() > 0)
                        @foreach($transitionSection->aboutTransitionListItems as $listItem)
                        <div class="flex items-center space-x-2">
                            <input type="text" class="form-input flex-1" name="list_items[]"
                                   value="{{ $listItem->about_transition_list_content }}" placeholder="Élément de liste">
                            <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeListItem(this)">
                                Supprimer
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="flex items-center space-x-2">
                            <input type="text" class="form-input flex-1" name="list_items[]" placeholder="Élément de liste">
                            <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeListItem(this)">
                                Supprimer
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn-success text-sm mt-2" onclick="addListItem()">
                    + Ajouter un élément
                </button>
            </div>

            <div class="form-group">
                <label class="form-label">Image</label>
                <input type="file" class="form-input" name="about_transition_image" accept="image/*">
                @if($transitionSection && $transitionSection->about_transition_image_path)
                    <div class="mt-3">
                        <img src="{{ Storage::url($transitionSection->about_transition_image_path) }}" alt="Image actuelle" class="h-32 w-auto rounded border border-gray-200">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-success">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Mettre à jour la section
            </button>
        </form>
    </div>

    <!-- Membres de l'équipe -->
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-900">Membres de l'équipe</h2>
            <button type="button" class="btn-primary" @click="teamModal = true; editMode = false">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un membre
            </button>
        </div>

        @if($teamMembers && $teamMembers->count() > 0)
            <div class="space-y-3" id="team-members-sortable">
                @foreach($teamMembers as $member)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center team-member-item" data-id="{{ $member->id }}">
                    <div class="cursor-move mr-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                    </div>
                    @if($member->about_team_image_path)
                        <img src="{{ Storage::url($member->about_team_image_path) }}" alt="{{ $member->about_team_name }}"
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 ml-4">
                        <h3 class="font-semibold text-gray-900">{{ $member->about_team_name }}</h3>
                        <p class="text-sm text-muted">{{ $member->about_team_position }}</p>
                        @if($member->about_team_description)
                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($member->about_team_description, 100) }}</p>
                        @endif
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="btn-secondary text-xs py-1 px-2"
                            onclick="editTeamMember({{ $member->id }})">
                            Modifier
                        </button>
                        <form action="{{ route('dashboard.about.team.delete', $member->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger text-xs py-1 px-2"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="empty-state-title">Aucun membre d'équipe</h3>
                <p class="empty-state-description">Ajoutez votre premier membre</p>
            </div>
        @endif
    </div>

    <!-- Modal Accordéon -->
    <div x-show="accordionModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="accordionModal = false"></div>

            <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900" id="accordionModalTitle">
                        Ajouter un élément d'accordéon
                    </h3>
                    <button @click="accordionModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="accordionForm" action="{{ route('dashboard.about.accordion.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Titre *</label>
                        <input type="text" class="form-input" id="modal_accordion_title" name="about_accordion_title" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contenu *</label>
                        <textarea class="form-textarea" id="modal_accordion_content" name="about_accordion_content" rows="6" required></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" class="btn-secondary" @click="accordionModal = false">Annuler</button>
                        <button type="submit" class="btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Team Member -->
    <div x-show="teamModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="teamModal = false"></div>

            <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900" id="teamModalTitle">
                        Ajouter un membre d'équipe
                    </h3>
                    <button @click="teamModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="teamForm" action="{{ route('dashboard.about.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Nom *</label>
                            <input type="text" class="form-input" id="modal_team_name" name="about_team_name" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Poste *</label>
                            <input type="text" class="form-input" id="modal_team_position" name="about_team_position" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-textarea" id="modal_team_description" name="about_team_description" rows="3" placeholder="Décrivez brièvement le membre de l'équipe"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-input" id="modal_team_image" name="about_team_image" accept="image/*">
                        <img id="team_image_preview" src="" alt="Aperçu" class="mt-3 h-32 w-auto rounded border border-gray-200" style="display: none;">
                    </div>

                    <div class="form-group">
                        <label class="form-label font-semibold text-gray-700">Réseaux sociaux</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                            <div>
                                <label class="text-xs text-gray-600">Facebook</label>
                                <input type="url" class="form-input text-sm" id="modal_team_facebook" name="about_team_facebook" placeholder="https://facebook.com/...">
                            </div>
                            <div>
                                <label class="text-xs text-gray-600">Twitter/X</label>
                                <input type="url" class="form-input text-sm" id="modal_team_twitter" name="about_team_twitter" placeholder="https://twitter.com/...">
                            </div>
                            <div>
                                <label class="text-xs text-gray-600">LinkedIn</label>
                                <input type="url" class="form-input text-sm" id="modal_team_linkedin" name="about_team_linkedin" placeholder="https://linkedin.com/in/...">
                            </div>
                            <div>
                                <label class="text-xs text-gray-600">Instagram</label>
                                <input type="url" class="form-input text-sm" id="modal_team_instagram" name="about_team_instagram" placeholder="https://instagram.com/...">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" class="btn-secondary" @click="teamModal = false">Annuler</button>
                        <button type="submit" class="btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// === GESTION DES ÉLÉMENTS DE LISTE ===
function addListItem() {
    const container = document.getElementById('list-items');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" class="form-input flex-1" name="list_items[]" placeholder="Élément de liste">
        <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeListItem(this)">Supprimer</button>
    `;
    container.appendChild(div);
}

function removeListItem(button) {
    const container = document.getElementById('list-items');
    if (container.children.length > 1) {
        button.parentElement.remove();
    } else {
        button.previousElementSibling.value = '';
    }
}

// === GESTION ACCORDION ===
function editAccordionItem(id) {
    fetch(`{{ url('/dashboard/about/accordion') }}/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('accordionModalTitle').textContent = 'Modifier l\'élément d\'accordéon';
            document.getElementById('accordionForm').action = `{{ url('/dashboard/about/accordion') }}/${id}/update`;

            const form = document.getElementById('accordionForm');
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            document.getElementById('modal_accordion_title').value = data.about_accordion_title;
            document.getElementById('modal_accordion_content').value = data.about_accordion_content;

            window.dispatchEvent(new CustomEvent('open-accordion-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}

// === GESTION TEAM ===
function editTeamMember(id) {
    fetch(`{{ url('/dashboard/about/team') }}/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('teamModalTitle').textContent = 'Modifier le membre d\'équipe';
            document.getElementById('teamForm').action = `{{ url('/dashboard/about/team') }}/${id}/update`;

            const form = document.getElementById('teamForm');
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            document.getElementById('modal_team_name').value = data.about_team_name;
            document.getElementById('modal_team_position').value = data.about_team_position;
            document.getElementById('modal_team_description').value = data.about_team_description || '';
            document.getElementById('modal_team_facebook').value = data.about_team_facebook || '';
            document.getElementById('modal_team_twitter').value = data.about_team_twitter || '';
            document.getElementById('modal_team_linkedin').value = data.about_team_linkedin || '';
            document.getElementById('modal_team_instagram').value = data.about_team_instagram || '';

            document.getElementById('modal_team_image').required = false;

            const preview = document.getElementById('team_image_preview');
            if (data.about_team_image_path) {
                preview.src = `/storage/${data.about_team_image_path}`;
                preview.style.display = 'block';
            }

            window.dispatchEvent(new CustomEvent('open-team-modal'));
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données: ' + error.message);
        });
}

// === APERÇU DES IMAGES ===
document.getElementById('modal_team_image')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('team_image_preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// === DRAG & DROP POUR RÉORDONNANCEMENT ===
document.addEventListener('DOMContentLoaded', function() {
    const sortableElement = document.getElementById('team-members-sortable');

    if (sortableElement) {
        let draggedElement = null;
        let draggedIndex = null;

        sortableElement.addEventListener('dragstart', function(e) {
            if (e.target.classList.contains('team-member-item')) {
                draggedElement = e.target;
                draggedIndex = Array.from(sortableElement.children).indexOf(draggedElement);
                e.target.style.opacity = '0.4';
            }
        });

        sortableElement.addEventListener('dragend', function(e) {
            if (e.target.classList.contains('team-member-item')) {
                e.target.style.opacity = '1';

                // Récupérer le nouvel ordre
                const items = sortableElement.querySelectorAll('.team-member-item');
                const orders = Array.from(items).map((item, index) => ({
                    id: parseInt(item.getAttribute('data-id')),
                    order: index + 1
                }));

                // Envoyer au serveur
                fetch('{{ route('dashboard.about.team.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ orders: orders })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Ordre mis à jour:', data);
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour de l\'ordre:', error);
                    alert('Erreur lors de la mise à jour de l\'ordre');
                });
            }
        });

        sortableElement.addEventListener('dragover', function(e) {
            e.preventDefault();
            const afterElement = getDragAfterElement(sortableElement, e.clientY);
            if (afterElement == null) {
                sortableElement.appendChild(draggedElement);
            } else {
                sortableElement.insertBefore(draggedElement, afterElement);
            }
        });

        // Rendre les items draggables
        const items = sortableElement.querySelectorAll('.team-member-item');
        items.forEach(item => {
            item.setAttribute('draggable', 'true');
        });

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.team-member-item:not(.dragging)')];

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;

                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }
    }
});
</script>
@endpush
@endsection
