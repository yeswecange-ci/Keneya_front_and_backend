<!-- Add Country Modal -->
<div x-show="countryModal && !editMode" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
    @open-add-country-modal.window="countryModal = true; editMode = false">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm" @click="countryModal = false"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
            <!-- Header avec dégradé -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Ajouter un pays</h3>
                    </div>
                    <button @click="countryModal = false" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body du modal -->

            <form action="{{ route('activities.store-country') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            <span>Code pays (ISO 2) *</span>
                        </label>
                        <input type="text" name="country_code" class="form-input text-lg font-mono uppercase" required maxlength="2"
                            placeholder="Ex: BF" style="text-transform: uppercase;">
                        <p class="text-xs text-gray-500 mt-1.5 flex items-center space-x-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Code ISO à 2 lettres (ex: BF, CI, SN)</span>
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="form-label flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                            <span>Nom du pays *</span>
                        </label>
                        <input type="text" name="country_name" class="form-input" required
                            placeholder="Ex: Burkina Faso">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        <span>Couleur sur la carte</span>
                    </label>
                    <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <input type="color" name="color" id="addColorPicker" class="h-14 w-24 rounded-lg border-2 border-gray-300 cursor-pointer shadow-sm"
                            value="#FFD700">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">Couleur sélectionnée</p>
                            <p class="text-lg font-mono font-bold text-gray-900" id="addColorDisplay">#FFD700</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" rows="4"
                        placeholder="Description des activités dans ce pays"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Activités</label>
                    <div id="country-activities-add">
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="text" name="activities[]" class="form-input flex-1"
                                placeholder="Ex: Formation de 500 agents de santé">
                            <button type="button" class="btn-success text-xs py-2 px-3"
                                onclick="addCountryActivity('add')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
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

                <!-- Footer avec actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                    <button type="button" class="btn-secondary" @click="countryModal = false">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Annuler
                    </button>
                    <button type="submit" class="btn-success">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Ajouter le pays
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Country Modal -->
<div x-show="countryModal && editMode" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
    @open-country-modal.window="countryModal = true; editMode = true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm" @click="countryModal = false; editMode = false"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
            <!-- Header avec dégradé -->
            <div class="bg-gradient-to-r from-orange-600 to-red-600 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Modifier le pays</h3>
                    </div>
                    <button @click="countryModal = false; editMode = false" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body du modal -->

            <form id="editCountryForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            <span>Code pays (ISO 2) *</span>
                        </label>
                        <input type="text" name="country_code" id="edit_country_code" class="form-input text-lg font-mono uppercase" required
                            maxlength="2" style="text-transform: uppercase;">
                        <p class="text-xs text-gray-500 mt-1.5 flex items-center space-x-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Code ISO à 2 lettres</span>
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="form-label flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                            <span>Nom du pays *</span>
                        </label>
                        <input type="text" name="country_name" id="edit_country_name" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        <span>Couleur sur la carte</span>
                    </label>
                    <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <input type="color" name="color" id="edit_country_color" class="h-14 w-24 rounded-lg border-2 border-gray-300 cursor-pointer shadow-sm">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">Couleur sélectionnée</p>
                            <p class="text-lg font-mono font-bold text-gray-900" id="editColorDisplay">#FFD700</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="edit_country_description" class="form-textarea"
                        rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Activités</label>
                    <div id="country-activities-edit">
                        <!-- Les activités seront chargées via JavaScript -->
                    </div>
                    <button type="button" class="btn-success btn-sm mt-2" onclick="addCountryActivity('edit')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
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
                            <input type="checkbox" name="is_active" value="1" id="edit_country_is_active"
                                class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Actif</span>
                        </label>
                    </div>
                </div>

                <!-- Footer avec actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                    <button type="button" class="btn-secondary"
                        @click="countryModal = false; editMode = false">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Annuler
                    </button>
                    <button type="submit" class="btn-success">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Mise à jour de l'affichage de la couleur pour le modal d'ajout
    document.addEventListener('DOMContentLoaded', function() {
        const addColorPicker = document.getElementById('addColorPicker');
        const addColorDisplay = document.getElementById('addColorDisplay');

        if (addColorPicker && addColorDisplay) {
            addColorPicker.addEventListener('input', function(e) {
                addColorDisplay.textContent = e.target.value.toUpperCase();
            });
        }

        const editColorPicker = document.getElementById('edit_country_color');
        const editColorDisplay = document.getElementById('editColorDisplay');

        if (editColorPicker && editColorDisplay) {
            editColorPicker.addEventListener('input', function(e) {
                editColorDisplay.textContent = e.target.value.toUpperCase();
            });
        }
    });
</script>

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
    window.editCountry = function (id) {
        fetch(`/dashboard/activities/countries/${id}/edit`)
            .then(response => response.json())
            .then(country => {
                document.getElementById('edit_country_code').value = country.country_code;
                document.getElementById('edit_country_name').value = country.country_name;

                const editColorPicker = document.getElementById('edit_country_color');
                const editColorDisplay = document.getElementById('editColorDisplay');
                editColorPicker.value = country.color || '#FFD700';
                editColorDisplay.textContent = (country.color || '#FFD700').toUpperCase();

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