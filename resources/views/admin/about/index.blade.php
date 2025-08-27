@extends('layouts.backend.app')

@section('title', 'Gestion de la page À Propos')

@section('styles')
<style>
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.section-card {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    border: 1px solid #e2e8f0;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f1f5f9;
}

.section-header h2 {
    margin: 0;
    color: #1e293b;
    font-size: 1.75rem;
    font-weight: 600;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-primary { background: #3b82f6; color: white; }
.btn-primary:hover { background: #2563eb; }

.btn-success { background: #10b981; color: white; }
.btn-success:hover { background: #059669; }

.btn-danger { background: #ef4444; color: white; }
.btn-danger:hover { background: #dc2626; }

.btn-sm { padding: 6px 12px; font-size: 14px; }

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control textarea {
    resize: vertical;
    min-height: 100px;
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-success {
    background: #f0fdf4;
    border-left-color: #10b981;
    color: #065f46;
}

.alert-danger {
    background: #fef2f2;
    border-left-color: #ef4444;
    color: #991b1b;
}

.preview-image {
    max-width: 200px;
    max-height: 150px;
    border-radius: 8px;
    margin-top: 10px;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.item-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}

.item-title {
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
}

.item-content {
    color: #64748b;
    line-height: 1.5;
}

.item-actions {
    display: flex;
    gap: 8px;
}

.team-member-card {
    display: flex;
    align-items: center;
    gap: 20px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
}

.team-member-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
}

.team-member-info {
    flex: 1;
}

.team-member-name {
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 5px 0;
}

.team-member-position {
    color: #64748b;
    margin: 0 0 8px 0;
}

.team-member-link {
    color: #3b82f6;
    text-decoration: none;
    font-size: 14px;
}

.dynamic-list {
    margin-bottom: 20px;
}

.list-item {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
    align-items: center;
}

.list-item input {
    flex: 1;
}

.add-item-btn {
    background: #10b981;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.remove-item-btn {
    background: #ef4444;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    backdrop-filter: blur(2px);
}

.modal-content {
    background-color: #fff;
    margin: 3% auto;
    padding: 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.modal-title {
    margin: 0;
    color: #1e293b;
    font-size: 1.5rem;
    font-weight: 600;
}

.close {
    color: #9ca3af;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    line-height: 1;
    padding: 0;
    background: none;
    border: none;
}

.close:hover {
    color: #374151;
}

.modal-footer {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .section-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }

    .team-member-card {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection

@section('content')
<div class="admin-container">
    <h1 style="color: #1e293b; margin-bottom: 30px;">Gestion de la page À Propos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Section Principale -->
    <div class="section-card">
        <div class="section-header">
            <h2>Section Principale</h2>
        </div>

        <form action="{{ route('dashboard.about.main-section.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="about_title">Titre principal</label>
                <input type="text" class="form-control" id="about_title" name="about_title"
                       value="{{ $mainSection->about_title ?? '' }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="about_description_1">Description 1 *</label>
                    <textarea class="form-control" id="about_description_1" name="about_description_1"
                              rows="4" required>{{ $mainSection->about_description_1 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="about_description_2">Description 2</label>
                    <textarea class="form-control" id="about_description_2" name="about_description_2"
                              rows="4">{{ $mainSection->about_description_2 ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="about_description_3">Description 3</label>
                    <textarea class="form-control" id="about_description_3" name="about_description_3"
                              rows="4">{{ $mainSection->about_description_3 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="about_description_4">Description 4</label>
                    <textarea class="form-control" id="about_description_4" name="about_description_4"
                              rows="4">{{ $mainSection->about_description_4 ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="about_button_text">Texte du bouton *</label>
                    <input type="text" class="form-control" id="about_button_text" name="about_button_text"
                           value="{{ $mainSection->about_button_text ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="about_button_link">Lien du bouton *</label>
                    <input type="text" class="form-control" id="about_button_link" name="about_button_link"
                           value="{{ $mainSection->about_button_link ?? '' }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="about_image">Image</label>
                <input type="file" class="form-control" id="about_image" name="about_image" accept="image/*">
                @if($mainSection && $mainSection->about_image_path)
                    <img src="{{ Storage::url($mainSection->about_image_path) }}" alt="Image actuelle" class="preview-image">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour la section</button>
        </form>
    </div>

    <!-- Éléments d'Accordéon -->
    <div class="section-card">
        <div class="section-header">
            <h2>Éléments d'Accordéon</h2>
            <button type="button" class="btn btn-success" onclick="openAccordionModal()">
                + Ajouter un élément
            </button>
        </div>

        @if($accordionItems && $accordionItems->count() > 0)
            @foreach($accordionItems as $item)
            <div class="item-card">
                <div class="item-header">
                    <div>
                        <h3 class="item-title">{{ $item->about_accordion_title }}</h3>
                        <p class="item-content">{{ Str::limit(strip_tags($item->about_accordion_content), 150) }}</p>
                    </div>
                    <div class="item-actions">
                        <button type="button" class="btn btn-primary btn-sm" onclick="editAccordionItem({{ $item->id }})">
                            Modifier
                        </button>
                        <form action="{{ route('dashboard.about.accordion.delete', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p style="color: #64748b; text-align: center; padding: 40px;">Aucun élément d'accordéon trouvé.</p>
        @endif
    </div>

    <!-- Section Transition -->
    <div class="section-card">
        <div class="section-header">
            <h2>Section Transition</h2>
        </div>

        <form action="{{ route('dashboard.about.transition-section.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="about_transition_title">Titre de la section *</label>
                <input type="text" class="form-control" id="about_transition_title" name="about_transition_title"
                       value="{{ $transitionSection->about_transition_title ?? '' }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="about_transition_description_1">Description 1 *</label>
                    <textarea class="form-control" id="about_transition_description_1" name="about_transition_description_1"
                              rows="4" required>{{ $transitionSection->about_transition_description_1 ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="about_transition_description_2">Description 2</label>
                    <textarea class="form-control" id="about_transition_description_2" name="about_transition_description_2"
                              rows="4">{{ $transitionSection->about_transition_description_2 ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label>Éléments de liste</label>
                <div class="dynamic-list" id="list-items">
                    @if($transitionSection && $transitionSection->aboutTransitionListItems && $transitionSection->aboutTransitionListItems->count() > 0)
                        @foreach($transitionSection->aboutTransitionListItems as $listItem)
                        <div class="list-item">
                            <input type="text" class="form-control" name="list_items[]"
                                   value="{{ $listItem->about_transition_list_content }}" placeholder="Élément de liste">
                            <button type="button" class="remove-item-btn" onclick="removeListItem(this)">Supprimer</button>
                        </div>
                        @endforeach
                    @else
                        <div class="list-item">
                            <input type="text" class="form-control" name="list_items[]" placeholder="Élément de liste">
                            <button type="button" class="remove-item-btn" onclick="removeListItem(this)">Supprimer</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="add-item-btn" onclick="addListItem()">+ Ajouter un élément</button>
            </div>

            <div class="form-group">
                <label for="about_transition_image">Image</label>
                <input type="file" class="form-control" id="about_transition_image" name="about_transition_image" accept="image/*">
                @if($transitionSection && $transitionSection->about_transition_image_path)
                    <img src="{{ Storage::url($transitionSection->about_transition_image_path) }}" alt="Image actuelle" class="preview-image">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour la section</button>
        </form>
    </div>

    <!-- Membres de l'équipe -->
    <div class="section-card">
        <div class="section-header">
            <h2>Membres de l'équipe</h2>
            <button type="button" class="btn btn-success" onclick="openTeamModal()">
                + Ajouter un membre
            </button>
        </div>

        @if($teamMembers && $teamMembers->count() > 0)
            @foreach($teamMembers as $member)
            <div class="team-member-card">
                @if($member->about_team_image_path)
                    <img src="{{ Storage::url($member->about_team_image_path) }}" alt="{{ $member->about_team_name }}" class="team-member-image">
                @endif
                <div class="team-member-info">
                    <h3 class="team-member-name">{{ $member->about_team_name }}</h3>
                    <p class="team-member-position">{{ $member->about_team_position }}</p>
                    <a href="{{ $member->about_team_detail_link }}" target="_blank" class="team-member-link">Voir le profil →</a>
                </div>
                <div class="item-actions">
                    <button type="button" class="btn btn-primary btn-sm" onclick="editTeamMember({{ $member->id }})">
                        Modifier
                    </button>
                    <form action="{{ route('dashboard.about.team.delete', $member->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <p style="color: #64748b; text-align: center; padding: 40px;">Aucun membre d'équipe trouvé.</p>
        @endif
    </div>
</div>

<!-- Modal Accordéon -->
<div id="accordionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="accordionModalTitle">Ajouter un élément d'accordéon</h2>
            <button class="close" onclick="closeModal('accordionModal')">&times;</button>
        </div>

        <form id="accordionForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="modal_accordion_title">Titre *</label>
                <input type="text" class="form-control" id="modal_accordion_title" name="about_accordion_title" required>
            </div>

            <div class="form-group">
                <label for="modal_accordion_content">Contenu *</label>
                <textarea class="form-control" id="modal_accordion_content" name="about_accordion_content" rows="6" required></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeModal('accordionModal')">Annuler</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Team Member -->
<div id="teamModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="teamModalTitle">Ajouter un membre d'équipe</h2>
            <button class="close" onclick="closeModal('teamModal')">&times;</button>
        </div>

        <form id="teamForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="modal_team_name">Nom *</label>
                <input type="text" class="form-control" id="modal_team_name" name="about_team_name" required>
            </div>

            <div class="form-group">
                <label for="modal_team_position">Poste *</label>
                <input type="text" class="form-control" id="modal_team_position" name="about_team_position" required>
            </div>

            <div class="form-group">
                <label for="modal_team_link">Lien vers le profil *</label>
                <input type="text" class="form-control" id="modal_team_link" name="about_team_detail_link" required>
            </div>

            <div class="form-group">
                <label for="modal_team_image">Photo</label>
                <input type="file" class="form-control" id="modal_team_image" name="about_team_image" accept="image/*">
                <img id="team_image_preview" src="" alt="Aperçu" class="preview-image" style="display: none;">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeModal('teamModal')">Annuler</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// === GESTION DES MODALS ===
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Fermer modal en cliquant à l'extérieur
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

// === GESTION DES ÉLÉMENTS DE LISTE ===
function addListItem() {
    const container = document.getElementById('list-items');
    const div = document.createElement('div');
    div.className = 'list-item';
    div.innerHTML = `
        <input type="text" class="form-control" name="list_items[]" placeholder="Élément de liste">
        <button type="button" class="remove-item-btn" onclick="removeListItem(this)">Supprimer</button>
    `;
    container.appendChild(div);
}

function removeListItem(button) {
    const container = document.getElementById('list-items');
    if (container.children.length > 1) {
        button.parentElement.remove();
    } else {
        // S'il ne reste qu'un élément, on le vide plutôt que de le supprimer
        button.previousElementSibling.value = '';
    }
}

// === GESTION ACCORDION ===
function openAccordionModal() {
    document.getElementById('accordionModalTitle').textContent = 'Ajouter un élément d\'accordéon';
    document.getElementById('accordionForm').action = '{{ route("dashboard.about.accordion.store") }}';
    document.getElementById('accordionForm').method = 'POST';

    // Reset form
    document.getElementById('modal_accordion_title').value = '';
    document.getElementById('modal_accordion_content').value = '';

    // Mettre à jour le formulaire pour l'ajout
    const form = document.getElementById('accordionForm');
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }

    openModal('accordionModal');
}

function editAccordionItem(id) {
    fetch(`{{ url('/dashboard/about/accordion') }}/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('accordionModalTitle').textContent = 'Modifier l\'élément d\'accordéon';
            document.getElementById('accordionForm').action = `{{ url('/dashboard/about/accordion') }}/${id}`;

            // Ajouter la méthode PUT
            const form = document.getElementById('accordionForm');
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Remplir les champs
            document.getElementById('modal_accordion_title').value = data.about_accordion_title;
            document.getElementById('modal_accordion_content').value = data.about_accordion_content;

            openModal('accordionModal');
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données');
        });
}

// === GESTION TEAM ===
function openTeamModal() {
    document.getElementById('teamModalTitle').textContent = 'Ajouter un membre d\'équipe';
    document.getElementById('teamForm').action = '{{ route("dashboard.about.team.store") }}';

    // Reset form
    document.getElementById('modal_team_name').value = '';
    document.getElementById('modal_team_position').value = '';
    document.getElementById('modal_team_link').value = '';
    document.getElementById('modal_team_image').value = '';
    document.getElementById('team_image_preview').style.display = 'none';

    // Mettre à jour le formulaire pour l'ajout
    const form = document.getElementById('teamForm');
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }

    // L'image est requise pour l'ajout
    document.getElementById('modal_team_image').required = true;

    openModal('teamModal');
}

function editTeamMember(id) {
    fetch(`{{ url('/dashboard/about/team') }}/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('teamModalTitle').textContent = 'Modifier le membre d\'équipe';
            document.getElementById('teamForm').action = `{{ url('/dashboard/about/team') }}/${id}`;

            // Ajouter la méthode PUT
            const form = document.getElementById('teamForm');
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Remplir les champs
            document.getElementById('modal_team_name').value = data.about_team_name;
            document.getElementById('modal_team_position').value = data.about_team_position;
            document.getElementById('modal_team_link').value = data.about_team_detail_link;

            // L'image n'est pas requise pour la modification
            document.getElementById('modal_team_image').required = false;

            // Afficher l'image actuelle
            const preview = document.getElementById('team_image_preview');
            if (data.about_team_image_path) {
                preview.src = `{{ Storage::url('') }}${data.about_team_image_path}`;
                preview.style.display = 'block';
            }

            openModal('teamModal');
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données');
        });
}

// === APERÇU DES IMAGES ===
document.addEventListener('change', function(e) {
    if (e.target.type === 'file' && e.target.accept && e.target.accept.includes('image')) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Trouver l'élément d'aperçu correspondant
                let preview = null;

                if (e.target.result) {
                    // Pour le modal team
                    if (file.name && document.getElementById('team_image_preview')) {
                        preview = document.getElementById('team_image_preview');
                    } else {
                        // Pour les autres formulaires, chercher dans le même groupe
                        const formGroup = e.target.closest('.form-group');
                        if (formGroup) {
                            preview = formGroup.querySelector('.preview-image');
                        }
                    }

                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                }
            };
            reader.readAsDataURL(file);
        }
    }
});

// === VALIDATION DES FORMULAIRES ===
document.addEventListener('DOMContentLoaded', function() {
    // Validation en temps réel pour les champs requis
    const requiredFields = document.querySelectorAll('input[required], textarea[required]');

    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#10b981';
            }
        });

        field.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(239, 68, 68)' && this.value.trim() !== '') {
                this.style.borderColor = '#e5e7eb';
            }
        });
    });
});

// === CONFIRMATION DE SUPPRESSION ===
function confirmDelete(message = 'Êtes-vous sûr de vouloir supprimer cet élément ?') {
    return confirm(message);
}
</script>
@endsection
