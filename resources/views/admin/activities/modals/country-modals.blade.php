<!-- Add Country Modal -->
<div x-show="countryModal && !editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-country-modal.window="countryModal = true; editMode = false">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="countryModal = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Ajouter un pays</h3>
                <button @click="countryModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('activities.store-country') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Code pays (ISO 2) *</label>
                        <input type="text" name="country_code" class="form-input" required maxlength="2" placeholder="Ex: BF, CI, SN">
                        <p class="text-xs text-muted mt-1">Code ISO à 2 lettres (ex: BF pour Burkina Faso)</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nom du pays *</label>
                        <input type="text" name="country_name" class="form-input" required placeholder="Ex: Burkina Faso">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" rows="4" placeholder="Description des activités dans ce pays"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Activités</label>
                    <div id="country-activities-add">
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="text" name="activities[]" class="form-input flex-1" placeholder="Ex: Formation de 500 agents de santé">
                            <button type="button" class="btn-success text-xs py-2 px-3" onclick="addCountryActivity('add')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Image représentative du pays (max: 2MB)</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" name="order" class="form-input" value="0" min="0">
                    </div>

                    <div class="form-group">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="form-checkbox" checked>
                            <span class="text-sm font-medium text-gray-700">Actif</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="countryModal = false">Annuler</button>
                    <button type="submit" class="btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Country Modal -->
<div x-show="countryModal && editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-country-modal.window="countryModal = true; editMode = true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="countryModal = false; editMode = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Modifier le pays</h3>
                <button @click="countryModal = false; editMode = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editCountryForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Code pays (ISO 2) *</label>
                        <input type="text" name="country_code" id="edit_country_code" class="form-input" required maxlength="2">
                        <p class="text-xs text-muted mt-1">Code ISO à 2 lettres</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nom du pays *</label>
                        <input type="text" name="country_name" id="edit_country_name" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="edit_country_description" class="form-textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Activités</label>
                    <div id="country-activities-edit">
                        <!-- Les activités seront chargées via JavaScript -->
                    </div>
                    <button type="button" class="btn-success btn-sm mt-2" onclick="addCountryActivity('edit')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter une activité
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'image actuelle</p>
                    <div id="current_country_image" class="mt-2"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Ordre d'affichage</label>
                        <input type="number" name="order" id="edit_country_order" class="form-input" min="0">
                    </div>

                    <div class="form-group">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" id="edit_country_is_active" class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Actif</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="countryModal = false; editMode = false">Annuler</button>
                    <button type="submit" class="btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addCountryActivity(mode) {
    const container = document.getElementById(`country-activities-${mode}`);
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="activities[]" class="form-input flex-1" placeholder="Ex: Formation de 500 agents de santé">
        <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeCountryActivity(this)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeCountryActivity(button) {
    button.parentElement.remove();
}

// Fonction pour éditer un pays
window.editCountry = function(id) {
    fetch(`/dashboard/activities/countries/${id}/edit`)
        .then(response => response.json())
        .then(country => {
            document.getElementById('edit_country_code').value = country.country_code;
            document.getElementById('edit_country_name').value = country.country_name;
            document.getElementById('edit_country_description').value = country.description || '';
            document.getElementById('edit_country_order').value = country.order;
            document.getElementById('edit_country_is_active').checked = country.is_active;

            // Charger les activités
            const activitiesContainer = document.getElementById('country-activities-edit');
            activitiesContainer.innerHTML = '';

            if (country.activities && country.activities.length > 0) {
                country.activities.forEach(activity => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center space-x-2 mb-2';
                    div.innerHTML = `
                        <input type="text" name="activities[]" class="form-input flex-1" value="${activity}">
                        <button type="button" class="btn-danger text-xs py-2 px-3" onclick="removeCountryActivity(this)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                    activitiesContainer.appendChild(div);
                });
            }

            // Afficher l'image actuelle
            const imageContainer = document.getElementById('current_country_image');
            if (country.image) {
                imageContainer.innerHTML = `
                    <p class="text-sm text-muted mb-1">Image actuelle:</p>
                    <img src="{{ asset('') }}${country.image}" class="w-32 h-32 object-cover rounded">
                `;
            } else {
                imageContainer.innerHTML = '';
            }

            // Mettre à jour l'action du formulaire
            document.getElementById('editCountryForm').action = `/dashboard/activities/countries/${id}`;

            // Ouvrir le modal en mode édition
            window.dispatchEvent(new CustomEvent('open-country-modal'));
        });
};
</script>
