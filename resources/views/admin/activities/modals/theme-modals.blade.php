<!-- Add Theme Modal -->
<div x-show="themeModal && !editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-theme-modal.window="themeModal = true; editMode = false">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="themeModal = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Ajouter un thème</h3>
                <button @click="themeModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('activities.store-theme') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="activities_theme_title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_theme_description" class="form-textarea" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Icône</label>
                    <input type="file" name="activities_theme_icon" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Formats acceptés: SVG, PNG, JPG. Max: 2MB</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="activities_theme_order" class="form-input" value="0" min="0">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="themeModal = false">Annuler</button>
                    <button type="submit" class="btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Theme Modal -->
<div x-show="themeModal && editMode"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @open-theme-modal.window="themeModal = true; editMode = true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" @click="themeModal = false; editMode = false"></div>

        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Modifier le thème</h3>
                <button @click="themeModal = false; editMode = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editThemeForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="activities_theme_title" id="edit_theme_title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="activities_theme_description" id="edit_theme_description" class="form-textarea" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Icône</label>
                    <input type="file" name="activities_theme_icon" class="form-input" accept="image/*">
                    <p class="text-xs text-muted mt-1">Laisser vide pour conserver l'icône actuelle</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Ordre</label>
                    <input type="number" name="activities_theme_order" id="edit_theme_order" class="form-input" value="0" min="0">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="btn-secondary" @click="themeModal = false; editMode = false">Annuler</button>
                    <button type="submit" class="btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
