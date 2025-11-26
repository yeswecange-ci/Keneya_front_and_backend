<!-- Add Service Modal -->
<div x-show="serviceModal && !editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-service-modal.window="serviceModal = true; editMode = false">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="serviceModal = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-3xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Ajouter un service</h3>
                <button @click="serviceModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('activities.store-service') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Titre *</label>
                        <input type="text" name="activities_service_title" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="activities_service_order" class="form-input" value="0" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_service_description" class="form-textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="activities_service_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Formats acceptés: JPEG, PNG, JPG, GIF. Max: 2MB</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" name="activities_service_pdf" class="form-input" accept="application/pdf">
                    <p class="text-xs text-muted mt-1">Format accepté: PDF. Max: 10MB</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Caractéristiques du service</label>
                    <div id="service-features">
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="text" name="activities_service_features[]" class="form-input flex-1" placeholder="Caractéristique du service">
                            <button type="button" class="btn-success text-xs py-2 px-3" onclick="addServiceFeature()">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="serviceModal = false">Annuler</button>
                    <button type="submit" class="btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div x-show="serviceModal && editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-service-modal.window="serviceModal = true; editMode = true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="serviceModal = false; editMode = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-3xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Modifier le service</h3>
                <button @click="serviceModal = false; editMode = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editServiceForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Titre *</label>
                        <input type="text" name="activities_service_title" id="edit_service_title" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="activities_service_order" id="edit_service_order" class="form-input" value="0" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_service_description" id="edit_service_description" class="form-textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="activities_service_image" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'image actuelle</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" name="activities_service_pdf" class="form-input" accept="application/pdf">
                    <p class="text-xs text-muted mt-1">Format accepté: PDF. Max: 10MB. Laisser vide pour conserver le PDF actuel</p>
                    <p id="current_pdf_info" class="text-xs text-gray-600 mt-1"></p>
                </div>

                <div class="form-group">
                    <label class="form-label">Caractéristiques du service</label>
                    <div id="edit-service-features">
                        <!-- Features will be populated by JavaScript -->
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="serviceModal = false; editMode = false">Annuler</button>
                    <button type="submit" class="btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
